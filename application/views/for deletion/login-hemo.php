<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<title>Manilamed Hemo - Login</title>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/login.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function username()
			{
				$("#username").focus(function(){
				var username = $("#username").val();
					if(username.length == 0 || username == "username" || password == "")
					{
						$(this).val("");
					}
				});
				$("#username").focusout(function(){
					var username = $("#username").val();
					if(username.length == 0 || username == "username" || password == "")
					{
						$(this).val("username");
					}
				});
			}
			function password(){
				$("#fakepassword").focus(function(){
					$(this).hide();
					$("#password").show();
					$("#password").focus();
				});
				$("#password").focusout(function(){
					var password = $(this).val();
					if(password.length == 0 || password == "" || password == " ")
					{
						$("#password").hide();
						$("#fakepassword").show();
					}
				});
			}
			username();
			password();
			$("#checklogin").submit(function(){
				var password = $("#password").val();
				if(password.length == 0 || password == "" || password == " ")
				{
					return false;
				}
			});
			window.onbeforeunload = function() {
				alert("test");
			}
		});
		
	</script>
</head>
<body>
	<div id="container">
		<div id="wrapperlogin">
			<div id="conlogin">
				<div id="logintbl">
					<div id="leftmargin">
						<div id="topindent"></div>
						<div id="colorindent"></div>
					</div>
					<div id="content">
						<div id="topindent"></div>
						<div id="lblsignin">SIGN IN</div>
						<div id="inputusername">
							<?php echo form_open("home/checklogin","id='checklogin'"); ?>
							<?php echo form_input("username","username","id='username'")?>
						</div>
						<div id="inputpassword">
							
							<?php echo form_password("password","","id='password'")?>
							<?php echo form_input("fakepassword","password","id='fakepassword'")?>
						</div>
						<div id="inputsubmit"><?php echo form_submit("login","SIGN IN","id='login'")?></div>
						<div id="lblbottom">
							<div id="forget">Forget your password?</div>
							<div id="create">Create an account.</div>
						</div>
					</div>
					<div id="rightmargin">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>