<div id="loginwrapper">
	<div id="logincontainer">
		<div id="loginmsgwrap">
			<div id="msgalert">
				<div id="msgalertwrapper">
					<div class="loginimgwrap"><img src="<?php echo base_url(); ?>css/img/exclamationico.png" width="20px" /></div>
					<label for="msgalert" class="msglogin">
						<?php 
							if(validation_errors()) echo "All fields are mandatory";
							else if($loginattemp) echo "Incorrect Username or Password";
						?>
					</label>
				</div>
			</div>
			<div id="loginbanner">
				<div id="loginmargin">
					<?php echo form_open('task/checklogin'); ?>
					<label for="bannertitle" class="bannertitle">Login now to continue</label>
					<label for="bannertitle" class="bannersubtitle">or <a href="<?php echo base_url(); ?>task/register" class="res-url">Signup here</a></label>
					<label for="bannertitle" class="logincredentials">
						<?php echo form_input('username',set_value('username','Usercode'),'id="username" class="inputlogin" label="Usercode"'); ?>
					</label>
					<label for="bannertitle" class="logincredentials">
						<?php echo form_input('fakepassword','Password','id="fakepassword" class="inputlogin" label="Password"'); ?>
						<?php echo form_password('password','','id="password" class="inputlogin" label="realpass"'); ?>
					</label>
					<label for="bannertitle" class="logincredentials">
						<?php echo form_submit('loginbtn','Log In','id=loginbtn') ?>
					</label>
					<label for="bannertitle" class="forgotpassword">Forgot your password? <a href="<?php echo base_url(); ?>task/forgot" class="res-url">Click here!</a></label>
					<label for="bannertitle" class="termsandcons">By signing in, you agree to our Terms & Conditions</label>
				</div>
			</div>
		</div>
	</div>
</div>