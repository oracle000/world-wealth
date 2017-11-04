		<div id="contentprofile">
			<div id="wrapperwcmsg">
				<span style='font-size:20px;display:block;color:#074f8e;font-weight:500;'>Welcome <?php echo $this->session->userdata('fullname');?></span>
				<span style='font-size:20px;display:block;color:#074f8e;font-weight:500;margin-bottom:10px;'>Your Level  <?php echo "<strong>".$leveldetails."</strong>" ;?></span>
				
				<span style='display:block;font-weight:400;height:17px;'>User ID: <strong><?php echo $this->session->userdata('PK_users'); ?></strong></span>
				<span style='display:block;font-weight:400;height:17px;'>Last Logon: <strong><?php echo $lastlogin; ?></strong></span>
				<span style='display:block;font-weight:400;height:17px;'>Email Address: <strong><?php echo $personaldata['email']; ?></strong></span>
				<span style='display:inline-block;font-weight:400;height:17px;float:left;'>Next Level:</span>
					<?php 
					
						$total2 = $total-$params['min'];
						$string = $total."/".$params['max'];
						$max = $params['max']-$params['min'];
						$width = number_format(($total2 / $max) * 100,2);
						$width = $width."%";
					?>
					<div id="levelbarcon">
						<div id="nxtlevelbar">
							<div id="currentbar" style="height:10px;width:<?php echo $width; ?>;float:left;background-color:#79cdfa;font-size:10px;line-height:10px;"></div>
							<span style='position:relative;margin-top:-10px;text-align:center;width:200px;font-size:10px;line-height:10px;height:10px;float:left;'><?php echo $string; ?></span>
						</div>
					</div>
				<span style='display:block;font-weight:400;height:17px;'>Last Change Password: <strong><?php echo $lastchangepass; ?></strong></span>
			</div>
			<div id="summarywrapper">
				<div id="summarycontainer">
					<div id="icon">
						<span style='float:left;'><img src="<?php echo base_url(); ?>css/img/summaryico.png" height="30px;"></span>
						<span style='height:30px;line-height:30px;font-size:20px;margin-left:10px;'>Summary</span>
					</div>
					<div id="summarytext">
						<span style='display:block;'>Membership Equivalent Amount: <?php echo number_format($memberamount,2,'.',','); ?></span>
						<span style='display:block;'>Service Income Amount: <?php echo number_format($serviceamount,2,'.',','); ?></span>
						<span style='display:block;'>Total No of Members: <a style="text-decoration:none;color:blue;" target="_blank" href="<?php echo base_url(); ?>home/pyramidview?PK=<?php echo $this->session->userdata('PK_users'); ?>"><?php echo $total; ?></a></span>
					</div>
				</div>
				<div id="detailedcontainer">
					<div id="icon">
						<span style='float:left;'><img src="<?php echo base_url(); ?>css/img/summaryico.png" height="30px;"></span>
						<span style='height:30px;line-height:30px;font-size:20px;margin-left:10px;'>Detailed - Direct Upline</span>
					</div>
					<div id="summarytext">
						<table id="detailedlvldtls">
							<tr style='background-color:skyblue;'>
								<th>No</th>
								<th>Full Name</th>
								<th>Upline ID</th>
								<th>No of Member</th>
								<th>Level</th>
							</tr>
							<?php
								$count = 0;
								if($upline !== FALSE)
								{
									foreach($upline as $rows)
									{
										$count++;
										$styling = $count%2;
										if($styling == 0)
										{
											$style = "style='background-color:#e2f5ff;'";
										}
										else
										{
											$style = "style='background-color:none;'";
										}
										$string = base_url()."home/pyramidview?PK=".$rows['FK_users'];
										echo "<tr id='tblresult'><a href=\"$string\">";
										echo "<td><a href=\"$string\" target=\"_blank\">".$count."</a></td>";
										echo "<td><a href=\"$string\" target=\"_blank\">".$rows['fullname']."</a></td>";
										echo "<td><a href=\"$string\" target=\"_blank\">".$rows['FK_users']."</a></td>";
										echo "<td><a href=\"$string\" target=\"_blank\">".$rows['noofmember']."</a></td>";
										echo "<td><a href=\"$string\" target=\"_blank\">".$rows['lvldesc']."</a></td>";
										echo "</a></tr>";
									}
								}
								else
								{
									echo "<tr id='tblresult'>";
									echo "<td colspan=5 align='center'>No Members Yet</td>";
									echo "</tr>";
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>