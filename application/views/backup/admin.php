<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
<head>
	<title>WorldWealth - Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<link rel="icon" href="<?php echo base_url(); ?>css/img/favico.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/homepage.css" />	
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="<?php base_url(); ?>../js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
		});
	</script>
</head>
<body>
	<div id="loadingwrap"></div>
	<div id="container">
		<div id="header">
			<div id="tophdr">
				<div class="home-img-cont">
					<a href="<?php echo base_url(); ?>portal/homepage" class="home-img"><img class="wwicon" src="<?php echo base_url(); ?>css/img/wwicon2-dark.jpg" height=50px title="Homepage World Wealth"></a>
					<div class="home-img-text">
						<p>World Wealth</p>
						<p>Properties and Leisures</p>
					</div>
				</div>
				<div id="bothdrcontainer">
					<div id="paymenttab">
						<a href="<?php echo base_url(); ?>admin/#">
							<i class="fa fa-user" aria-hidden="true"></i>						
							<div class="hdrlinks" <?php if($profiledir != '') echo "style=\"color:#333;\""; ?>>PAYMENT APPLICATION</div>
						</a>
					</div>
					<div id="reportstab">
						<a href="<?php echo base_url(); ?>admin/#">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<div class="hdrupdate links" <?php if($walletdir != '') echo "style=\"color:#333;\""; ?>>REPORTS</div>
						</a>
					</div>
					<div id="encashmentstab">
						<a href="<?php echo base_url(); ?>admin/#">
							<i class="fa fa-desktop" aria-hidden="true"></i>
							<div class="hdrlinks" <?php if($trxdir != '') echo "style=\"color:#333;\""; ?>>ENCASHMENT</div>
						</a>
					</div>
					<div id="setuptab">
						<a href="<?php echo base_url(); ?>admin/#">
							<i class="fa fa-trophy" aria-hidden="true"></i>
							<div class="hdrlinks" <?php if($incentivesdir != '') echo "style=\"color:#333;\""; ?>>SETUP</div>
						</a>
					</div>
					<div id="logoutmod">
						<a href="<?php echo base_url(); ?>admin/logout">
							<i class="fa fa-sign-out" aria-hidden="true"></i>
							<div class="hdrlinks">LOGOUT</div>
						</a>
					</div>					
				</div>
			</div>
		</div>