<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
<title>Home - World Wealth</title>

<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/home.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btnsummary").click(function(){
				$("#summarydtls").show();
				$("#tbllvldtls").hide();
				$("#containerty").focus();
			});
			$("#btnlvldtls").click(function(){
				$("#tbllvldtls").show();
				$("#summarydtls").hide();
				$("#containerty").focus();
			});
			var errors = 
			<?php 
				if(isset($errors))
				{
					if($errors != "")
					{
						
						$errors = validation_errors()."".$errors;
						$errors = json_encode($errors);
						echo $errors;
					}
					else
					{
						echo json_encode(validation_errors());
					}
				}
				else
				{
					echo json_encode(validation_errors()); 
				}
			?>;
			if(errors != "")
			{
				alert(errors);
			}
			$("input").focus(function(){
				$(this).css("color","#000000");
			});
			$("input").focusout(function(){
				$(this).css("color","gray");
			});
			$('body').on('click',"#addbankaccount",function(){
				$("#formupdate .additional").append("<div class='inputwrapper'><div class='lblinput'></div><div class='lbltxtfld'><input type='text' name='bankname[]' value='Name' id='bankname' />&nbsp;<input type='text' name='accountno[]' value='Account No'  id='accountno' /></div><div style='float:right;width:20px;margin-right:20px;' id='test'><img id='deletebankaccount' src='<?php echo base_url(); ?>css/img/crossico.png' style='height:20px;margin-top:10px;'></div><div style='float:right;width:20px;margin-right:10px;'><img title = 'Add Bank Account Details' id='addbankaccount' src='<?php echo base_url(); ?>css/img/addico.png' style='height:20px;margin-top:10px;'></div></div>");
			});
			
			$('body').on('click',"img#deletebankaccount",function(){
				$(this).parent("div").parent("div.inputwrapper").remove();
				//$("#testingkoto.inputwrapper").remove();
			});
			/*
			$("#imagedeletebankaccount").parent(" .inputwrapper").each(function(){
				$(".inputwrapper").last().remove();
			});
			*/
		});
	</script>
</head>
<body>
	<div id="containerty">
		<div id="headerreg">
			<div id="headerwrapreg">
				<div class="webnamewrapreg">
					<div class="webnamereg"><img src="<?php echo base_url(); ?>css/img/companylogo2.png" height="50px"></div>
				</div>
			</div>
		</div>
		<div id="memberlinks">
			<div id="memberwrapper">
				<div class="logout"><?php echo anchor("task/logout","LOGOUT","title=\"LOGOUT\""); ?></div>
				<div class="profile"><?php echo anchor("home/?style=password","PASSWORD","title=\"PASSWORD\""); ?></div>
				<div class="settings"><?php echo anchor("home/?style=settings","PROFILE","title=\"PROFILE\""); ?></div>
				<div class="profile"><?php echo anchor("home/?style=profile","HOME","title=\"HOME\""); ?></div>
			</div>
		</div>
		
		
		
	