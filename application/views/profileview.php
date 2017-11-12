		<div id="content">
			
			<div id="leftcontent">
				<div id="userpicwrapper">
					<div id="userpic"><img id="imguserpic" src="<?php echo $profilepic; ?>"></div>
				</div>
				<div id="accountinfo">
					<div id="acctcol">
						<span id="acctstrong">Level:</span>
						<span id="acctrslt" title="<?php echo $userdata['0']['memberdesc']['description']; ?>"><?php echo $userdata['0']['memberdesc']['description']; ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">ID No:</span>
						<span id="acctrslt" title="<?php echo strtoupper($userdata['0']['FK_users']); ?>"><?php echo $userdata['0']['FK_users']; ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Name:</span>
						<span id="acctrslt" title="<?php echo strtoupper($userdata['0']['membername']); ?>"><?php echo strtoupper($userdata['0']['membername']); ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Sponsor ID No.:</span>
						<span id="acctrslt" title="<?php echo $userdata['0']['sponsorid']; ?>"><?php echo $userdata['0']['sponsorid']; ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Sponsor Name:</span>
						<span id="acctrslt" title="<?php echo strtoupper($userdata['0']['sponsorname']); ?>"><?php echo strtoupper($userdata['0']['sponsorname']); ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Upline ID No.:</span>
						<span id="acctrslt" title="<?php echo $userdata['0']['uplineid']; ?>"><?php echo $userdata['0']['uplineid']; ?></span>
					</div>
					<div id="acctcol">
						<span id="acctstrong">Upline Name:</span>
						<span id="acctrslt" title="echo strtoupper($userdata['0']['uplinename'])"><?php echo strtoupper($userdata['0']['uplinename']); ?></span>
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
			<div id="rightcontent">
				<div id="rcwrapper">
					<div id="rctitle">
						<div class="tabreg">
							<i class="fa fa-list" aria-hidden="true"></i>
							<span>Registration</span>
						</div>
						<div class="tabcom">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<span>Commission</span>
						</div>
					</div>
					<div id="rccolhdr">
						<div class="rccollbldeschdr">Description</div>
						<div class="rccollbltothdr">Total</div>
					</div>
					<div class="rcreg">
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Direct Member(s)</span>
								<span class="rcdescbot">Total No of Members that you direct recruit</span>
							</div>
							<div class="rccollbltotres"><?php echo $total ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Total Member(s)</span>
								<span class="rcdescbot">Total No of Members on your network</span>
							</div>
							<div class="rccollbltotres"><?php echo $totalmembers; ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Property Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Property</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['property'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Cash Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Cash</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['cash'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Holiday Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Holiday</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['holiday'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Charity Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Property</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['charity'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Car Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Car</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['car'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Others Allocation</span>
								<span class="rcdescbot">Total Allocated Amount for Others</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['others'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Membership Amount</span>
								<span class="rcdescbot">Your Membership Amount</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($userdata['0']['memberdesc']['equivamount'],2); ?></div>
						</div>	
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Service Income Amount</span>
								<span class="rcdescbot">Your Service Income Amount</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($userdata['0']['memberdesc']['equivamount1'],2); ?></div>
						</div>
					</div>
					<div class="rccomm">
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Cash Allocation (40%)</span>
								<span class="rcdescbot">Total Allocated Amount for Cash</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['percent1'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Holiday Allocation (30%)</span>
								<span class="rcdescbot">Total Allocated Amount for Holiday</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['percent2'],2); ?></div>
						</div>
						<div id="rccolres">
							<div class="rccollbldeschdr">
								<span class="rcdesctop">Car Allocation (30%)</span>
								<span class="rcdescbot">Total Allocated Amount for Car</span>
							</div>
							<div class="rccollbltotres"><?php echo number_format($summary['percent3'],2); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>