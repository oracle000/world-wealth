<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<title><?php echo $title; ?></title>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/index.css" />
	<!-- <link rel="stylesheet" type="text/css" href="css/index.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/header.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<!--<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
	<script type="text/javascript">
		$(document).ready(function(){
			<!-- LOGIN FUNCTION -->
			$("input.inputlogin").focus(function(){
				var value = $(this).val();
				var label = $(this).attr('label');
				if(label == "Usercode" && value == "Usercode" || value == "" || value == " ")
				{
					$(this).val("");
				}
				else if(label == "Password")
				{
					$(this).hide();
					$("#password").show();
					$("#password").focus();
				}
			});
			$("input.inputlogin").focusout(function(){
				var value = $(this).val();
				var label = $(this).attr('label');
				if(label == "Usercode" && value == "" || value == " ")
				{
					$(this).val(label);
				}
				else if(label == "realpass" && value == "" || value == " ")
				{
					$(this).hide();
					$("#fakepassword").show();
				}
			});
			function msgalert()
			{
				var alert = "<?php if(validation_errors()) echo "1"; else echo "0"; ?>";
				var alert2 = "<?php if(isset($loginattemp) && $loginattemp != '0') echo "1"; else echo "0"; ?>";
				if(alert == "1")
				{
					$("#msgalert").show();
				}
				else if(alert2 == "1")
				{
					$("#msgalert").show();
				}
			}
			msgalert();
			<!-- END OF LOGIN FUNCTION -->
			<!-- REGISTRATION FUNCTION 
			//Sponsor ID
			$("#sponsorid").keyup(function(){
				var id = $(this).val();
				$(".acsponsor").css("height","*");
				$.ajax({
					data:{'sponsorid':id},
					url:"<?php echo base_url(); ?>task/checksponsor",
					type:"POST",
					success:function(e){
						$(".siselect").html(e);
					}
				});
			});
			$("#sponsorid").focus(function(){
				$(".acsponsor").css("height","36px");
				$(".siselect").css("margin-top","36px");
			});
			$("#sponsorid").focusout(function(){
				setTimeout(function(){$(".acsponsor").css("height","36px"); },500);
			});
			$(".siselect").on('click',"div[class=lblselectname]",function(){
				var id = $(this).attr("id");
				$("#sponsorid").val(id);
				$(".acsponsor").css("height","30px");
			});
			//End of Sponsor ID
			//Upline ID
			$("#uplineid").keyup(function(){
				var id = $(this).val();
				$(".acupline").css("height","*");
				$.ajax({
					data:{'uplineid':id},
					url:"<?php echo base_url(); ?>task/checkupline",
					type:"POST",
					success:function(e){
						$(".uiselect").html(e);
					}
				});
			});
			$(".uiselect").on('click',"div[class=lblselectnameu]",function(){
				var id = $(this).attr("id");
				$("#uplineid").val(id);
				$(".acupline").css("height","30px");
			});
			$("#uplineid").focus(function(){
				$(".acupline").css("height","36px");
				$(".uiselect").css("margin-top","36px");
			});
			$("#uplineid").focusout(function(){
				setTimeout(function(){$(".acupline").css("height","36px"); },500);
			});
			//End of Upline ID
			function issecondstep()
			{
				var secondstep = '<?php if(isset($secondstep)){ echo $secondstep; } else echo "0";?>';
				if(secondstep == '1')
				{
					$("#firststep").hide();
					$("#secondstep").show();
					
				}
			}
			issecondstep();
			
			<!-- END OF REGISTRATION FUNCTION-->
			var toggle = 0;
			$("div.menu").click(function(){
				if(toggle == 0)
				{
					//$(".leftmenu").css('opacity','1');
					$(".leftmenu").animate({'marginLeft':'0%'},1000);
					toggle = 1;
				}
				else
				{
					var margin = ($('.leftmenu').width() + 3) * -1;
					$(".leftmenu").animate({'marginLeft':margin},1000);
					toggle = 0;
				}
			});
			$(window).resize(function(){
				if($(this).width() >= 1024){
					$(".leftmenu").css('marginLeft','calc(-60% - 4px)');
					$(".leftmenu").animate({'opacity':'0','display':'none'},500);
					toggle = 0;
				}
				else
				{
					$(".leftmenu").css('opacity','1');
				}
			});
			$("body").swiperight(function(){
				$("div.menu").click();
			});
			$("body").swipeleft(function(){
				$("div.menu").click();
			});
			
		});
	</script>
</head>
<body>
	<div id="container">
		<div class="leftmenu">
			<div class="lmrowwrapper">
				<div class="lmrow">
					<div style="height:35px;margin-top:5px;float:left;">
						<img style="max-height:100%; max-width:100%" src="<?php echo base_url();?>css/img/wwhome.png">
					</div>
					<span style="float:left;margin-left:5px;">Home</span>
				</div>
				<div class="lmrow">
					<div style="height:35px;margin-top:5px;float:left;">
						<img style="max-height:100%; max-width:100%" src="<?php echo base_url();?>css/img/wwphone.png">
					</div>
					<span style="float:left;margin-left:5px;">Contact Us</span>
				</div>
				<div class="lmrow">
					<div style="height:35px;margin-top:5px;float:left;">
						<img style="max-height:100%; max-width:100%" src="<?php echo base_url();?>css/img/wwabout.png">
					</div>
					<span style="float:left;margin-left:5px;">About Us</span>
				</div>
				<div class="lmrow">
					<div style="height:35px;margin-top:5px;float:left;">
						<img style="max-height:100%; max-width:100%" src="<?php echo base_url();?>css/img/wwlogin.png">
					</div>
					<span style="float:left;margin-left:5px;">Login</span>
				</div>
				<div class="lmrow">
					<div style="height:35px;margin-top:5px;float:left;">
						<img style="max-height:100%; max-width:100%" src="<?php echo base_url();?>css/img/wwform.png">
					</div>
					<span style="float:left;margin-left:5px;">Sign Up</span>
				</div>
			</div>
		</div>
		<div id="header">
			<div class="outside-navigation">
				<div class="hdrlinks">
					<div class="out-nav-linkA">
					<div class="lbllinks"><a href="<?php echo base_url(); ?>">Home</a></div>
						<div class="lbllinks"><a href="<?php echo base_url(); ?>task/about">About</a></div>
						<div class="lbllinks"><a href="<?php echo base_url(); ?>task/contact">Contact</a></div>
					</div>
					<div class="out-nav-linkB">
						<div class="lbllinks"><a href="<?php echo base_url(); ?>task/login">Login</a></div>
						<span class="divider">|</span>
						<div class="lbllinks"><a href="<?php echo base_url(); ?>task/register">SIGN UP</a></div>					
					</div>
					<span class="clear"></span>
				</div>
			</div>
			<div id="hdrcontainer">
				<div class="menu"><img src="<?php echo base_url(); ?>css/img/menu1.png"></div>
				<div class="companylogo"><img src="<?php echo base_url(); ?>css/img/wwicon2.jpg" /></div>
				
				<span class="clear"></span>
				<div class="sub-header ">
					<div ><a href="" class="navigate-item-inside">Mission</a></div>
					<div ><a href="" class="navigate-item-inside">Vision</a></div>
					<div ><a href="" class="navigate-item-inside">Signing-Up Benefits</a></div>
					<div ><a href="" class="navigate-item-inside">Fast-Start Registration</a></div>				
				</div>
			</div>
		</div>
		