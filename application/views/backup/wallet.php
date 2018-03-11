		<div id="walletcontent">
			<div id="wcleft">
				<div id="wcleftwrapper">
					<div id="userpicwrapper">
						<div id="userpic"><img id="imguserpic" src="<?php echo $profilepic; ?>"></div>
					</div>
					<div id="accountinfo">
						<div id="acctcol">
							<span id="acctstrong">ID No:</span>
							<span id="acctrslt"><?php echo $PK; ?></span>
						</div>
						<div id="acctcol">
							<span id="acctstrong">Level:</span>
							<span id="acctrslt"><?php print_r($userdata['0']['memberdesc']['description']);?></span>
						</div>
						<div id="acctcol">
							<span id="acctstrong">Cash Amount:</span>
							<span id="acctrslt" class="cashamount"><?php echo number_format($summary[0]['cashallocation'] + $commision[0]['cashamount'] - $totencashments,2); ?></span>
						</div>
						<div id="forex">
							<select id="forexconvert">
								<option value="PHP">PHP - Philippine Peso</option>
								<option value="USD">USD - US Dollar</option>
							</select>
						</div>
						<div id="encashcol" >
							<span id="acctstrong">Encashment Amount:</span>
						</div>
						<div id="encashcol">
							<span id="acctstrong"><input type="text" id="encashamount" /></span>
						</div>
						<div id="encashcol">
							<?php echo form_dropdown('forextype',$encashtype,'','id="forextype"');?>
						</div>
						<div id="encashcol" class="wallet-submit">
							<input type="button" value="Encash" id="encashbtn">
						</div>
						
					</div>
				</div>
			</div>
			<div id="wcright">
				<div id="wcrightwrapper">
					<div id="wctitle">*Encashment History</div>
					<div id="wctblwrapper">
						<table id="encashhistory">
							<tr>
								<td class="ehheader" style="width:20%;">Transaction No</td>
								<td class="ehheader" style="width:20%;">Date</td>
								<td class="ehheader" style="width:10%;">Type</td>
								<td class="ehheader" style="width:10%;">Status</td>
								<td class="ehheader" style="width:20%;">Currency</td>
								<td class="ehheader" style="width:20%;">Amount</td>
							</tr>
							<?php 
								if($encashments !== FALSE):
									foreach($encashments as $rows):
										echo "<tr class=\"ehresulttr\">";
										echo "	<td class=\"ehresult\">".$rows['PK_encashments']."</td>";
										echo "	<td class=\"ehresult\">".date("Y-m-d",strtotime($rows['datetime']))."</td>";
										echo "	<td class=\"ehresult\">".$rows['type']."</td>";
										echo "	<td class=\"ehresult\">".$rows['status']."</td>";
										echo "	<td class=\"ehresult\">".$rows['FK_forexcode']."</td>";
										echo "	<td class=\"ehresult\">".$rows['amount']."</td>";
										echo "</tr>";
									endforeach;
								else:
									echo "<tr class=\"ehresulttr\">";
									echo "	<td class=\"ehresult\" colspan='6' style=\"text-align:center\">No Previous Record</td>";
									echo "</tr>";
								endif;
								
							?>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>