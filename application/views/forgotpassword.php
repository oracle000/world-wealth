<div id="loginwrapper">
	<div id="forgotcontainer">
		<div id="forgotmsgwrap">
			<div id="msgalert">
				<div id="msgalertwrapper">
					<div class="loginimgwrap"><img src="<?php echo base_url(); ?>css/img/exclamationico.png" width="20px" /></div>
					<label for="msgalert" class="msglogin">
						
					</label>
				</div>
			</div>
			<div id="forgotbanner">
				<div id="forgotmargin">					
					<label for="bannertitle" class="bannertitle">Forgot Password</label>
					<label for="bannertitle" class="forgotcredentials">
                        <p>Enter your current email address</p>
                        <?php echo form_input('username',set_value('username','Email Address'),'id="username" class="inputlogin" label="Email Here"'); ?>
                    </label>
                    <div class="submit-cont">
                        <?php echo form_submit('submitbtn','Submit','id=forgotbtn') ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>