<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>

<html lang="en">
<title></title>
<head>
	<link rel="stylesheet" href="<?php echo base_url();?>css/stylereg.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryui.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var errors = 
			<?php
				if(validation_errors() !== FALSE && isset($allerrors))
				{
					$errors = validation_errors()."".$allerrors;
					$errors = json_encode($errors);
				}
				else
				{
					$errors = "0";
				}
				echo $errors;
			?>;
			if(errors != "0")
			{
				alert(errors);
			}
			$("#sponsorid").focus(function(){
				$(".acsponsor").css("height","32px");
				$(".siselect").css("margin-top","37px");
			});
			$("#sponsorid").focusout(function(){
				setTimeout(function(){$(".acsponsor").css("height","32px"); },500);
			});
			$("#sponsorid").keyup(function(){
				var sponsorid = $(this).val();
				$(".acsponsor").css("height","*");
				$.ajax({
					data:{'sponsorid':sponsorid},
					url:"<?php echo base_url(); ?>task/checksponsor",
					type:"POST",
					success:function(e){
						$(".siselect").html(e);
					}
				});
			});
			$(".siselect").on('click',"div[class=lblselectname]",function(){
				var id = $(this).attr("id");
				$("#sponsorid").val(id);
				$(".acsponsor").css("height","32px");
			});
			
			$("#uplineid").focus(function(){
				$(".acupline").css("height","32px");
				$(".uiselect").css("margin-top","37px");
			});
		
			$("#uplineid").focusout(function(){
				setTimeout(function(){$(".acupline").css("height","32px"); },500);
			});
	
			$("#uplineid").keyup(function(){
				var uplineid = $(this).val();
				$(".acupline").css("height","*");
				$.ajax({
					data:{'uplineid':uplineid},
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
				$(".acupline").css("height","32px");
			});
		});
		
		
		
	</script>
	</head>
<body>
	<div id="containerreg">
		<div id="headerreg">
			<div id="headerwrapreg">
				<div class="webnamewrapreg">
					<div class="webnamereg"><img src="<?php echo base_url(); ?>css/img/companylogo2.png" height="70px"></div>
				</div>
				<div class="headerlinksreg">
					<div class="hdrlinkswrapreg">
						<div class="home"><?php echo anchor("","HOME","title=\"Home\""); ?></div>
						<div class="aboutus"><?php echo anchor("?style=aboutus","ABOUT US","title=\"About Us\""); ?></div>
						<div class="contactus"><?php echo anchor("?style=contactus","CONTACT US","title=\"Contact Us\""); ?></div>
						<div class="login"><?php echo anchor("?style=login","LOGIN","title=\"Home\""); ?></div>
					</div>
				</div>
			</div>
		</div>
		<div id="registrationwrap">
			<div id="registrationcon">
				<div class="regtitle">Create Your Account</div>
				<div class="regdtls">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod, sem quis tempus vehicula, massa lacus fringilla metus, non varius lorem velit in ante.
				Already have an account? <?php echo anchor("task/","Log In","title=\"Login\""); ?>
				</div>
				<div class="reglblinputwrap">
					<div class="reglbl">Email Address</div>
					<div class="reginput">
					<?php echo form_open("task/checkregistration","autocomplete=\"off\""); ?>
					<?php echo form_input("email",set_value('email'),"id=\"email\"")?>
					</div>
				</div>
				<div class="reglblinputwrap">
					<div class="halfregleft">
						<div class="reglbl">First Name</div>
						<div class="reginput"><?php echo form_input("firstname",set_value('firstname'),"id=\"firstname\"")?></div>
					</div>
					<div class="halfregright">
						<div class="reglbl">Last Name</div>
						<div class="reginput"><?php echo form_input("lastname",set_value('lastname'),"id=\"lastname\"")?></div>
					</div>
				</div>
				<div class="reglblinputwrap">
					<div class="reglbl">Full Address</div>
					<div class="reginput"><?php echo form_input("address",set_value('address'),"id=\"address\"")?></div>
				</div>
				<div class="reglblinputwrap">
					<div class="reglbl">Contact No</div>
					<div class="reginput"><?php echo form_input("contact",set_value('contact'),"id=\"contact\"")?></div>
				</div>
				<div class="reglblinputwrap" style='height:50px'>
					<div class="halfregleft">
						<div class="reglbl">Sponsor ID</div>
						<div class="reginput">
							<div class='acsponsor'>
								<div class='curselect'><?php echo form_input("sponsorid",set_value('sponsorid'),"id=\"sponsorid\""); ?></div>
								<div class='siselect'></div>
								<div id="clear" style="clear:both;"></div>
							</div>
						</div>
					</div>
					<div class="halfregright">
						<div class="reglbl">Upline ID</div>
						<div class="reginput">
							<div class='acupline'>
								<div class='curselect'><?php echo form_input("uplineid",set_value('uplineid'),"id=\"uplineid\""); ?></div>
								<div class='uiselect'></div>
								<div id="clear" style="clear:both;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="reglblinputwrap">
					<div class="halfregleft">
						<div class="reglbl">Birthdate</div>
						<div class="reginput">
							<?php
								$month = array(
									'0'=>"Month",
									'1'=>"Jan",
									'2'=>"Feb",
									'3'=>"Mar",
									'4'=>"Apr",
									'5'=>"May",
									'6'=>"Jun",
									'7'=>"Jul",
									'8'=>"Aug",
									'9'=>"Sep",
									'10'=>"Oct",
									'11'=>"Nov",
									'12'=>"Dec"
								);
								$day = array_combine(range(0,31),range(0,31));
								$day = array_replace($day,array(0=>"Day"));
								if(isset($monthval)) echo form_dropdown("month",$month,$monthval,"id=\"month\"");
								else echo form_dropdown("month",$month,"0","id=\"month\"");
								if(isset($dayval)) echo form_dropdown("day",$day,$dayval,"id=\"day\"");
								else echo form_dropdown("day",$day,'0',"id=\"day\"");
								if(isset($yearval)) echo form_input("year",$yearval,"id=\"year\"");
								else echo form_input("year","Year","id=\"year\"");
								
								
							?>
						</div>
					</div>
					<div class="halfregright">
						<div class="reglbl">Gender</div>
						<div class="reginput">
							<?php
								$gender = array(
									"0"=>"Gender",
									"M"=>"Male",
									"F"=>"Female",
								);
								if(isset($yearval)) echo form_dropdown("gender",$gender,$genderval,"id=\"gender\"");
								else echo form_dropdown("gender",$gender,"0","id=\"gender\"");
								
							?>
						</div>
					</div>
				</div>
				<div class="reglblinputwrap">
					<div class="halfregleft">
						<div class="reglbl">&nbsp;</div>
						<div class="reginput">
							<div class="chkbox"><?php echo form_checkbox('terms', '1', FALSE,"id=\"terms\""); ?></div>
							<div class="terms">I have read and accept the World Wealth Terms & Conditions</div>
						</div>
					</div>
					<div class="halfregright">
						<div class="reglbl">&nbsp;</div>
						<div class="reginput">
						<?php echo form_submit("register","Register","id=\"register\"")?>
						<?php echo form_close()?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- Copyright Harry & Emman -->
</html>
		