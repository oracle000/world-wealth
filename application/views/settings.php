<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($personaldata))
{
	$firstname = $personaldata["firstname"];
	$lastname = $personaldata["lastname"];
	$email = $personaldata["email"];
	$contactno = $personaldata["contactno"];
	$address = $personaldata["address"];
	$bdate = $personaldata["bdate"];
	$monthval = date("n",strtotime($bdate));
	$dayval = date("j",strtotime($bdate));
	$yearval = date("Y",strtotime($bdate));
	$genderval = $personaldata["gender"];
}
else
{
	$firstname = "";
	$lastname = "";
	$email = "";
	$contactno = "";
	$address = "";
	$bdate = "";
	$monthval = "";
	$dayval = "";
	$yearval = "";
	$genderval = "";
}

?>
		<?php echo form_open("portal/updateregdetails","autocomplete=\"off\" name=\"formupdate\" id=\"formupdate\"");?>
		<div id="lblprosettings"><i class="fa fa-pencil" aria-hidden="true"></i> UPDATE PROFILE</div>
		<div id="profilesettings">
			<div id="wrapperprofile">
				
				<div id="fldwrapper">
					<div class="personaldata">&nbsp;</div>
					<div class="inputwrapper">
						
						<div class="lblinput">First Name</div>
						<div class="lbltxtfld"><?php echo form_input("firstname",set_value('firstname',$firstname),"id=\"firstname\"");?></div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Last Name</div>
						<div class="lbltxtfld"><?php echo form_input("lastname",set_value('lastname',$lastname),"id=\"lastname\"");?></div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Email Address</div>
						<div class="lbltxtfld"><?php echo form_input("email",set_value('email',$email),"id=\"email\"");?></div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Contact No</div>
						<div class="lbltxtfld"><?php echo form_input("contactno",set_value('contactno',$contactno),"id  =\"contactno\"");?></div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Address</div>
						<div class="lbltxtfld"><?php echo form_input("address",set_value('address',$address),"id=\"address\"");?></div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Birthdate</div>
						<div class="lbltxtfld">
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
							echo form_dropdown("month",$month,set_value('month',$monthval),"id=\"month\"");
							echo form_dropdown("day",$day,set_value('day',$dayval),"id=\"day\"");
							echo form_input("year",set_value('year',$yearval),"id=\"year\"");
						?>
						</div>
					</div>
					<div class="inputwrapper">
						<div class="lblinput">Gender</div>
						<div class="lbltxtfld">
							<?php 
								$gender = array(
									'M'=>"Male",
									'F'=>"Female",
								);
								echo form_dropdown("gender",$gender,set_value('gender',$genderval),"id=\"gender\""); 
							?>
						</div>
					</div>
					
					<?php
						$url = base_url()."css/img/addico.png";
						$url1 = base_url()."css/img/crossico.png";
						if($bankaccounts !== FALSE)
						{
							$count = 1;
							foreach($bankaccounts as $rows)
							{
								if($count==1) $description = "Bank"; 
								else $description = "";
								$bankname = $rows['accountname'];
								$accountno = $rows['accountno'];
								$array = array(
									'type'=>'hidden',
									'name'=>'hiddenval[]',
									'value'=>$rows['PK_bankaccounts']
								);
								
								echo "
								<div class=\"inputwrapper bankcont\">
									<div class=\"lblinput\">$description</div>
									<div class=\"lbltxtfld\">".form_input("buildbank[]","$bankname","id=\"bankname\"")."".form_input("buildaccountno[]","$accountno","id=\"accountno\"")."</div>
									<div class=\"lbltxtfld3\">
										<div style=\"width:20px;display:inline-block;float:right\"><img title =\"Delete Bank Account Details\" id=\"deletebankaccount\" src=\"$url1\" style=\"height:20px\"></div>
										<div style=\"width:20px;display:inline-block;float:left\"><img title =\"Add Bank Account Details\" id=\"addbankaccount\" src=\"$url\" style=\"height:20px\"></div>
									</div>".form_input($array)."
								</div>
								";
								
								
								$count++;
							}
						}
						else
						{
							echo "
							<div class=\"inputwrapper bankcont\">
								<div class=\"lblinput\">Bank</div>
								<div class=\"lbltxtfld2\">".form_input("bankname[]","Name","id=\"bankname\"")."".form_input("accountno[]","Account No","id=\"accountno\"")."</div>
								<div class=\"lbltxtfld3\">
									<div style=\"width:20px;display:inline-block;float:right\"><img title =\"Delete Bank Account Details\" id=\"deletebankaccount\" src=\"$url1\" style=\"height:20px\"></div>
									<div style=\"width:20px;display:inline-block;float:left\"><img title =\"Add Bank Account Details\" id=\"addbankaccount\" src=\"$url\" style=\"height:20px\"></div>
								</div>
							</div>
							";
						}
					?>
					
					
					<div class="additional">
						
					</div>
					
					<div class="inputwrapper">
						<div class="lblinput">&nbsp;</div>
						<div class="lbltxtfld update-cont">
							<?php echo form_submit("submit","Save","id=\"saveregdetails\""); ?>
							<a href="<?php echo base_url()."portal/updateprofile"; ?>" class="discard-link"><?php echo form_button("submit","Discard","id=\"discardregdetails\""); ?></a>
							<?php 
								if(isset($msg))
								{
									if($msg !== FALSE)
									{
										echo "<span style=\"float:left;color:#009174;font-style:italic;font-family:tahoma;\">Profile Updated!</span>";
									}
									else
									{
										echo "<span style=\"float:left;color:#ff7c7c;font-style:italic;font-family:tahoma;\">Something went wrong.</span>";
									}
								}
							?>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>