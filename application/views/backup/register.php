<div id="registrationwrapper">
	<div id="registrationcon">
		<label for="registrationtitle" class="registrationtitle">Registration Form</label>
		<label for="registrationsubtitle" class="registrationsubtitle">Please fill the form to register.</label>
		<div id="firststep">
			<div id="formwrapper">
				<?php echo form_open('task/secondstep','autocomplete="off"'); ?>
				<label for="lblemail" class="lblform">Email</label>
				<label for="inputform" class="inputform"><?php echo form_input('email',set_value('email'),'id="email" class="registerinput"'); ?></label>
				<?php echo form_error('email','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>')?>
				
			</div>	
			<div id="formwrapper">
				<label for="lblemail" class="lblform" style='float:left;line-height:30px;'>Upline Id</label>
				<label for="inputform" class="inputform">
					<div class='acupline'>
						<div class='curselect'><?php echo form_input("uplineid",set_value('uplineid'),'id="uplineid" class="registerinput"'); ?></div>
						<div class='uiselect'></div>
						<div id="clear" style="clear:both;"></div>
					</div>
				<?php //echo form_input('uplineid',set_value('uplineid'),'id="uplineid" class="registerinput"'); ?>
				</label>
				<?php echo form_error('uplineid','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>')?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform" style='float:left;line-height:30px;'>Sponsor Id</label>
				<label for="inputform" class="inputform">
					<div class='acsponsor'>
						<div class='curselect'><?php echo form_input("sponsorid",set_value('sponsorid'),'id="sponsorid", class="registerinput"'); ?></div>
						<div class='siselect'></div>
						<div id="clear" style="clear:both;"></div>
					</div>
				</label>
				<?php echo form_error('sponsorid','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>')?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform"></label>
				<label for="inputform" class="inputform"><?php echo form_submit('firststep','Next Step','id="nextstep" style="float:right"'); ?></label>
			</div>
		</div>
		<div id="secondstep">
			<div id="formwrapper">
				<label for="lblemail" class="lblform">First Name</label>
				<label for="inputform" class="inputform"><?php echo form_input('firstname',set_value('firstname'),'id="firstname" class="registerinput"'); ?></label>
				<?php echo form_error('firstname','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>')?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform">Last Name</label>
				<label for="inputform" class="inputform"><?php echo form_input('lastname',set_value('lastname'),'id="lastname" class="registerinput"'); ?></label>
				<?php echo form_error('lastname','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>')?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform">Address</label>
				<label for="inputform" class="inputform"><?php echo form_input('address',set_value('address'),'id="address" class="registerinput"'); ?></label>
			</div>
			
			<div id="formwrapper">
				<label for="lblemail" class="lblform">Contact No</label>
				<label for="inputform" class="inputform"><?php echo form_input('contactno',set_value('contactno'),'id="address" class="registerinput"'); ?></label>
			</div>		
			<div id="formwrapper">
				<label for="lblemail" class="lblform">Birthdate</label>
				<label for="inputform" class="inputform">
					<?php 
						$arraymonth = array(
							'0'=>'Month',
							'1'=>'Jan',
							'2'=>'Feb',
							'3'=>'Mar',
							'4'=>'Apr',
							'5'=>'May',
							'6'=>'Jun',
							'7'=>'Jul',
							'8'=>'Aug',
							'9'=>'Sep',
							'10'=>'Oct',
							'11'=>'Nov',
							'12'=>'Dec',
						);
						$arrayday = array_combine(range(0,31),range(0,31));
						$arrayday = array_replace($arrayday,array(0=>"Day"));
						echo form_dropdown('month',$arraymonth,set_value('month'),'id="monthdropdown"');
						echo form_dropdown('day',$arrayday,set_value('day'),'id="daydropdown"');
						echo form_input('year',set_value('year','Year'),'id="year"');
					?>
				</label>
				<?php  
					if(form_error('day'))
					{
						echo form_error('day','<div class="errormsgreg" ><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>');
					}
					else if(form_error('month'))
					{
						echo form_error('month','<div class="errormsgreg" ><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>');
					}
					else if(form_error('year'))
					{
						echo form_error('year','<div class="errormsgreg" ><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>');
					}
				?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform">I Am</label>
				<label for="inputform" class="inputform">
					<?php
						$arraygender = array(
							'0'=>'Gender',
							'M'=>'Male',
							'F'=>'Female'
						);
						echo form_dropdown('gender',$arraygender,set_value('gender','0'),'id="genderdropdown"');
					?>
				</label>
				<?php echo form_error('gender','<div class="errormsgreg"><div class="imgwarning">&nbsp;</div><div class="errormsglbl">','</div></div>'); ?>
			</div>
			<div id="formwrapper">
				<label for="lblemail" class="lblform"></label>
				<label for="inputform" class="inputform"><?php echo form_submit('firststep','Finish','id="nextstep"'); ?></label>
				
			</div>
		</div>
	</div>
</div>