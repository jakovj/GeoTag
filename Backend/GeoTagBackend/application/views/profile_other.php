
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">

            <div class="jumbotron" style="background-size:cover; background-image: url('<?php echo base_url() ?>img/brown-gradient.png');">					
                <div class="media">
                    <img src="<?php echo $profile_pic;?>" class="rounded_circle" width="120px" style="margin-right:20px">
                    <br>
                    <div class="media-body">
                        <h2 class="mt-2"><strong><?php echo $firstname." ".$lastname ?></strong></h2>
                        <hr>
                        <h6>Username:								<span id="username_info"><?php echo $username?></span> </h6>
                        <h6>Gender:								 	<span id="gender_info"><?php echo $gender?></span> </h6>
                        <h6>Number of reviews:						<span id="num_reviews_info"><?php  echo $review_count ?></span> </h6>	
                        <h6>Added places:							<span id="num_added_places_info"><?php echo $places_count ?></span> </h6>
                        <h6>Upvote/Downvote rate:					<span id="up_down_info"><?php echo $up_count.'/'.$down_count ?></span> </h6>										
                        <div class="progress" style="width:190px; height:20px;">
                            <?php if (($up_count+$down_count)==0)
                            {
                                echo "  <div class=\"progress-bar-striped progress-bar-success progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"90\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"text-align:center; background-color: #ff9900;width: 100%\">
                                        <h6 style=\"color:white;font-weight: 600;\">No votes</h6>
                                        </div>";
                            }else
                            {
                                echo "  <div class=\"progress-bar-striped progress-bar-success progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"90\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"text-align:center; background-color: #339933;width: ".(($up_count*1.0/($up_count+$down_count))*100.0)."%\">
                                        <h6 style=\"color:white;font-weight: 600;\">".$up_count."</h6>
                                        </div>
                                        <div class=\"progress-bar-striped progress-bar-danger progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"90\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"text-align:center; background-color: #b30000;width: ".(($down_count*1.0/($up_count+$down_count))*100.0)."%\">
                                                <h6 style=\"color:white;font-weight: 600;\">".$down_count."</h6>
                                        </div>";
                            }
                            ?>                  
                        </div>
                    </div>
                </div>
             
        </div>

    </div>


