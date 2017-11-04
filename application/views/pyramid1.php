
<div id="wrapperpyramid">
<div id="pyramidview"><?php print_r($test); ?></div>
</div>
<div id="tblwrapper">
	<table id="pyramidtbl">
		<tr>
			<td class="borderthick">No.</td>
			<td class="borderthick">Country</td>
			<td class="borderthick">ID No</td>
			<td class="borderthick">Level</td>
			<td class="borderthick">Full Name</td>
			<td class="borderthick">Sponsor Name</td>
		</tr>
	<?php 
		$counter = 1;
		foreach($leveling as $rows)
		{
			$FK_users = $rows['FK_users'];
			
			if($rows['FK_users'] != '----') $country = "PHL";
			else $country = "----";
			
			if($counter != 1) $style="color:#007aff";
			else $style = "";
			
			
			echo "<tr class=\"$FK_users\">";
			echo "<td class=\"tblresult\" style=\"text-align:right;direction: rtl;text-indent:20px;height:35px\">$counter</td>";
			echo "<td class=\"tblresult\" style=\"width:100px;\">$country</td>";
			echo "<td class=\"tblresult\">".$rows['FK_users']."</td>";
			echo "<td class=\"tblresult\">".$rows['level']."</td>";
			if($counter != 1) echo "<td class=\"tblresult\" style=\"width:200px;$style;\" ref=\"$FK_users\" id=\"reloadpyramid\">".$rows['fullname']."</td>";
			else echo "<td class=\"tblresult\" style=\"width:200px;$style;\" ref=\"$FK_users\">".$rows['fullname']."</td>";
			
			
			echo "<td class=\"tblresult\">".$rows['sponsorname']."</td>";
			echo "</tr>";
			$counter++;
		}
	?>
		
	</table>
</div>
