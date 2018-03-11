		<div id="opacitywrapper">
		</div>
		<div id="content">
			<div id="leftcontent">
				<div id="userpicwrapper">
					<div id="userpic"><img id="imguserpic" src="<?php echo $profilepic; ?>"></div>
				</div>
				<div id="accountinfo">
					
					<div id="acctcol">
						<span id="acctstrong">ID No:</span>
						<span id="acctrslt">10000</span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Name:</span>
						<span id="acctrslt">Emman Arrazola</span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Access Type:</span>
						<span id="acctrslt">System Administrator</span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Country:</span>
						<span id="acctrslt">Philippines</span>
					</div>
				</div>
				<div id="accountupdatewrap">
					<span class="auwtitle">ACCOUNT SETTINGS</span>
					<div id="auwcol">					
						<a href="<?php echo base_url(); ?>portal/updateprofile">
							<span class="auwcollinks">
								<i class="fa fa-pencil" aria-hidden="true"></i>Update Profile
							</span>						
							<span class="auwcoldesc">Update your profile information</span>
						</a>	
					</div>
					<div id="auwcol">						
						<a href="<?php echo base_url(); ?>portal/updatepicture">
							<span class="auwcollinks">
								<i class="fa fa-camera" aria-hidden="true"></i>Change Profile Picture
							</span>
							<span class="auwcoldesc">Update your profile picture</span>
						</a>
					</div>
					<div id="auwcol">						
						<a href="<?php echo base_url(); ?>portal/updatepassword">
							<span class="auwcollinks">
								<i class="fa fa-key" aria-hidden="true"></i>Change Password
							</span>
							<span class="auwcoldesc">Update your password</span>
						</a>
					</div>
				</div>
			</div>
			