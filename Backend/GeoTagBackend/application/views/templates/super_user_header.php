
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="icon" href="./img/logo.png">
		<title>Home</title>


		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>css/mystyle.css" />
		<script src="<?php echo base_url()?>js/myjs.js"></script>
	</head>
	
	<body >
		
		<nav class="stroke navbar navbar-expand-md navbar-dark" style="background-image: url('<?php echo base_url()?>img/header.jpg'); margin:10px;margin-bottom:60px; border-radius: 3px">
			<!-- Logo -->
			<a class="navbar-brand" href="<?php echo base_url()?>index.php/super_user/load/guest_home" style="height:50px; margin-left:50px">
					<img src="<?php echo base_url()?>img/logo.png" alt="logo" align=left style="width:110px;">
			</a>
			<!-- /Logo -->
	
			<!-- kada se smanji prozor da se pojavi collapse button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<!-- likovi -->
			<div class="collapse navbar-collapse" style="text-align:right" id="collapsibleNavbar">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item active">
						<a class="nav-link" href="<?php echo base_url()?>index.php/super_user/load/guest_home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url()?>index.php/super_user/load/guest_statistics">View statistics</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url()?>index.php/super_user/load/super_user_add_destination">Add destination</a>
					</li> 
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url()?>index.php/super_user/load/guest_about">About</a>
					</li> 
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url()?>index.php/super_user/load/guest_help">Help</a>
					</li> 
				</ul>

				<a href="<?php echo base_url()?>index.php/super_user/load/profile"><span id="username_korisnika" style="color:white">my_name</span></a>
				&nbsp;
				<span id="tip_korisnika" class="badge badge-info">SuperUser</span>

				<a href="<?php echo base_url()?>index.php/super_user/load/profile"><img id="slika_korisnika" src="<?php echo base_url()?>img/avatar.png" style="width:50px; margin-left:20px;margin-right:10px"></a>
				<a href="<?php echo base_url()?>index.php/user/logout" class="btn btn-dark">logout</a>
			</div> 
		</nav>