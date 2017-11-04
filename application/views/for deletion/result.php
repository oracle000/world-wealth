<?php 
	if($result !== FALSE)
	{
		foreach($result as $rows){
			$id = $rows["PK_users"];
			$fullname = $rows["fullname"];
			echo "<div id=\"lblresult\" class=\"$id\" ref=\"$fullname\">";
			echo "<div class=\"idnum\">".$rows['PK_users']."</div>";
			echo "<div class=\"lblname\">".$rows['fullname']."</div>";
			echo "</div>";
			//echo "<div class=\"lblresult\">".$rows['fullname']."</div>";
		}
	}
	else
	{
		echo "<div style=\"text-align:center;color:white;\">No Result</div>";
	}
?>
