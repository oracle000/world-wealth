	<div id="passwordsettings">
		<div class="lblpassset">
			<i class="fa fa-key" aria-hidden="true"></i>	
			Password Settings</div>	
			
			<div class="inputwrapper">
				<?php echo form_open("portal/updatepass","autocomplete=\"off\"");?>
				<div class="lblinput">Old Password</div>
				<div class="lbltxtfld">
					<?php 
						if(form_error('oldpass')) echo form_password("oldpass","","id=\"oldpass\" style=\"box-shadow:0px 0px 2px 0px #fa554c\"");
						else echo form_password("oldpass","","id=\"oldpass\"");
					?>
				</div>
			</div>
			<div class="inputwrapper">
				
				<div class="lblinput">New Password</div>
				<div class="lbltxtfld">
					<?php 
						if(form_error('newpass')) echo form_password("newpass","","id=\"newpass\" style=\"box-shadow:0px 0px 2px 0px #fa554c\"");
						else echo form_password("newpass","","id=\"newpass\"");
					?>
				</div>
			</div>
			<div class="inputwrapper">
				
				<div class="lblinput">Retype Password</div>
				<div class="lbltxtfld">
					<?php 
						if(form_error('retypepass')) echo form_password("retypepass","","id=\"retypepass\" style=\"box-shadow:0px 0px 2px 0px #fa554c\"");
						else echo form_password("retypepass","","id=\"retypepass\"");
					?>
				</div>
			</div>
			<div class="inputwrapper" style="width:80%">
				
				<div class="lbltxtfld update-pass-cont" style="width:100%">
				<?php echo form_submit("firstname","Save","id=\"savepass\"");?>
				<?php 
					
					if(isset($msg))
					{
						if($msg == TRUE)
						{
							echo "<span style='font-style:italic;color:green;font-family:\"Segoe UI\";text-align:center;float:left;width:100%;margin-top:10px;'>Successfully Updated!</span>";
						}
						else
						{
							echo "<span style='font-style:italic;color:red;font-family:\"Segoe UI\";text-align:center;float:left;width:100%;margin-top:10px;'>Something went wrong!</span>";
						}
					}
				?>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>