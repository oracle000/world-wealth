<?php
	if($result !== FALSE):
		foreach($result as $rows):
			echo "	<div id=\"slreswrapper\">";
			echo "		<span class=\"slname\">".$rows['firstname']." ".$rows['lastname']."&nbsp;</span>";
			echo "		<span class=\"slid\">- ".$rows['PK_users']."</span>";
			echo "	</div>";
		endforeach;
	else:
		echo "<div id=\"slreswrapper\" style=\"text-align:center\">No Result</div>";
	endif;
?>