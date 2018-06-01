<div class="container-fluid" >
<div class="row">
   <div class="col-sm-8">
      <div id="map" class="card" style="height:700px;">
         <div id="map"></div>
      </div>
      <script src="<?php echo base_url()?>js/map_styles.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGhsVpjnpP_alimoKSREfuSE8tJRA1v3U&callback=myMap"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

   </div>
   <div class="col-md-4">
      <div class="jumbotron" style="max-height:700px; padding:10px;padding-left:20px;padding-right:20px;background-size:cover; background-image: url('<?php echo base_url()?>img/brown-gradient.png');">
        
               <input class="form-control" name="search_text" id="search_text" type="text" placeholder="Search for destinations, people...">
         
          <div id="result"></div>
          <hr>
         <h5>Pending requests:</h5>
         <div id="last_reviews" style="overflow-y: scroll; height:450px; padding:10px">            
            <?php echo $last_pendings_html; ?>          
         </div>
      </div>
      <div class="alert alert-info" style="height:100px;">
         <h5>Biraj stil mape:[Test deo]</h5>
         <hr>
         <div class="radio">
            <form name="map_style_form" id="map_style_form">
               <input type="radio" name="r" value="desert" checked onClick="refresh()">Pustinja
               <input type="radio" name="r" value="night" onClick="refresh()">Noc
            </form>
         </div>
      </div>
   </div>
</div>
    <script>
$("#search_text").focus(function(){
       
	load_data();

	function load_data(query)
	{
		$.ajax({
                        <?php
                        if (($this->session->userdata('user')) != NULL) {
                        $user1 = $this->session->userdata('user')->status;
                        }
                        else
                            $user1 ="guest";
                        ?>
			url:"<?php echo base_url(); ?>index.php/<?php echo $user1;?>/search",
			method:"POST",
			data:{query:query},
			success:function(data){
				$('#result').html(data);
			}
		})
	}

	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();
		}
	});
});

</script>