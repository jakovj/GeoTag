<?php

/**
 * @author Dejan Ciric 570/15
 * 
 * Guest - class that handle all requests for guest
 * and for more privileged users if they use the same actions
 */
class Guest extends CI_Controller {

    // Creating new instance
    // @return void
    function __construct() {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->model("destination_model");
        $this->load->model("statistic_model");
        $this->load->model("review_model");
        
        // check if user is already logged in, or if unauthorized access through the link
        if ($this->session->userdata('user') != NULL && $this->session->userdata('remember') == true) {
            switch ($this->session->userdata('user')->status) {
                case "user":
                    redirect("user");
                    break;
                case "super_user":
                    redirect("super_user");
                    break;
                case "admin":
                    redirect("admin");
                    break;
            }
        }
        $phpArray = $this->get_all_destinations();
        ?>
        <script type="text/javascript">var jArray =<?php echo json_encode($phpArray); ?>;</script>
        <?php
        

    }

    // default function, load default view and can pass different messages to the view
    // @param string $message
    // @return void
    function index($message = null) {
        $data['page'] = 'index.php';
        if ($message)
            $data['message'] = $message;

        $this->load->view("index.php", $data);
    }

    // form validation check, and forwarding to corresponding model to insert new user 
    // @return void
    function register() {
        $this->form_validation->set_rules("username", "Username", "trim|required|min_length[4]|max_length[20]|is_unique[user.username]");
        $this->form_validation->set_rules("pwd_signup", "Password", "trim|required|min_length[4]|max_length[20]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|max_length[40]|is_unique[user.email]");
        $this->form_validation->set_rules("first_name", "Firstname", "required|max_length[20]");
        $this->form_validation->set_rules("last_name", "Lastname", "required|max_length[20]");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $data['gender'] = $this->input->post('gender');

        if ($this->form_validation->run()) {
            $data['username'] = $this->input->post('username');
            $data['email'] = $this->input->post('email');
            $data['status'] = "user";
            $data['password'] = $this->input->post('pwd_signup');
            $data['firstname'] = $this->input->post('first_name');
            $data['lastname'] = $this->input->post('last_name');


            if ($data['gender'] == "0")
                $this->index("Please select gender");
            else
                $this->User_model->insert_user($data);

            $this->index("Successfully registered, you can login");
            
            $to      = $this->input->post('email');
            $subject = 'GeoTag Registration';
            $code = rand(100, 10000);
            $message = 'You have successfully registered on GeoTag! Here is your code: '.$code.' Have fun :)';
            
            $headers = 'From: geotag.dp@gmail.com' . "\r\n" .
            'Reply-To: geotag.dp@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            //mail($to, $subject, $message, $headers);
            
            $this->statistic_model->updateStatistics('userCount');
        } else {
            if ($data['gender'] == "0")
                $this->index("Please select gender");
            else
                $this->index();
        }
    }

    // form validation check, and forwarding to corresponding model to check if user exist 
    // and redirecting when login based on status field of user
    // @return void
    function login() {
        $this->form_validation->set_rules("usernameSignin", "Username", "required");
        $this->form_validation->set_rules("pwd_signin", "Password", "required");
        if ($this->form_validation->run()) {
            if (!$this->User_model->getUser($this->input->post('usernameSignin'))) {
                $this->index("Wrong username");
            } else if (!$this->User_model->check_password($this->input->post('pwd_signin'), $this->input->post('usernameSignin'))) {
                $this->index("Wrong password");
            } else {
                $user = $this->User_model->user;
                if ($this->input->post("rememberme") == true)
                    $this->session->set_userdata('remember', true);
                else 
                    $this->session->set_userdata('remember', false);
                
                    $this->session->set_userdata('user', $user);
                switch ($user->status) {
                    case "user":
                        redirect("User");
                        break;
                    case "super_user":
                        redirect("Super_user");
                        break;
                    case "admin":
                        redirect("Admin");
                        break;
                }
            }
            $data['email'] = $this->input->post('emailSignin');
            $data['password'] = $this->input->post('pwd_signin');
        } else {
            $this->index();
        }
    }


    // @return void
    public function load($page,$data=null) {
        $data['last_reviews_html'] = $this->review_model->get_html_last_n_reviews();
        
        $info['page'] = $page;
        
        $this->load->view("templates/guest_header.php", $info);
        $this->load->view($page.".php",$data);
        $this->load->view("templates/footer.php");
    }
    
    public function getStatistics(){
        
        
        $statistics['userCount']=0;
        $statistics['reviewCount']=0;
        $statistics['destinationCount']=0;
        $statistics['positiveVoteCount']=0;
        $statistics['negativeVoteCount']=0;
        
        $statistics=$this->statistic_model->getStatistics();
        
        
        $data['date']=$statistics->date;;
        $data['userCount']=$statistics->userCount;;
        $data['reviewCount']=$statistics->reviewCount;
        $data['destinationCount']=$statistics->destinationCount;
        $data['positiveVoteCount']=$statistics->positiveVoteCount;
        $data['posReviews']=$statistics->posReviews;
        $this->load("guest_statistics",$data);
}
    public function search(){
       $output = '';
		$query = '';
		
		if($this->input->post('query'))
		{
			$query = $this->input->post('query');
		}
		$data = $this->destination_model->search_data($query);
		$output .= '
		<div class="table-responsive">
					<table class="table bg-light">

		';
		if($data->num_rows() > 0)
		{
			foreach($data->result() as $row)
			{
				$output .= '
						<tr>
							<td><a href="'.base_url().'index.php/guest/load_dest/'.$row->idDest.'">'.$row->name.'</a></td>
                                                        <td>'.$row->country.'</td>    
						</tr>
				';
			}
		}
		else
		{
			$output .= '<tr>
							
						</tr>';
		}
		$output .= '</table>';
		echo $output;
    }
    
    public function load_dest($id){
       $data['dest_name'] = $this->destination_model->get_name($id);
       $data['dest_country'] = $this->destination_model->get_country($id);
       $data['all_reviews_current_destination_html'] = $this->review_model->get_html_all_reviews($id);
       
       $this->load("destination_guest",$data);
    }
    
    public function get_all_destinations(){
        return $this->destination_model->get_all_destinations();
    }

}

