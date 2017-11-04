<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html>
<title>Thank You - Harryman</title>
<head>
	

<style>
	body
	{
		padding:0;
		margin:0;
		width:100%;
		height:100%;
	}
	div#containerty
	{
		height:600px;
		width:100%;
	}
	div#wrapperty
	{
		height:400px;
		width:700px;
		margin:auto;
		margin-top:20px;
	}
	div.tytitle
	{
		padding-top:50px;
		padding-bottom:20px;
		text-align:center;
		font-family:"Segoe UI";
		font-size:40px;
		font-weight:100;
	}
	div.tydesc
	{
		text-align:center;
		font-family:"Segoe UI";
		font-size:20px;
		font-weight:100;
	}
	div.tydesc1
	{
		text-align:center;
		font-family:"Segoe UI";
		font-size:20px;
		font-weight:100;
		
	}
	div.tydesc2
	{
		text-align:center;
		font-family:"Segoe UI";
		font-size:16px;
		font-weight:100;
	}
	div#footer
	{
		border:1px solid black;
		bottom:0px;
	}
	div.webnamereg
	{
		font-size:25px;
		font-family:arial;
		border:5px solid white;
		padding:10px 50px 10px 50px;
		border:5px solid black;
	}
	div#headerwrapreg
	{
		color:#000000;
		height:100px;
		border:0;
	}
	div#headerreg
	{
		background-color:#ededed;
		height:100px;
		box-shadow:0px -5px 2px 5px;
	}
	div.webnamewrapreg
	{
		float:left;
		margin-top:20px;
		margin-left:40px;
		background-color:#FFFFFF;
	}
	div.headerlinkswrapreg
	{
		margin-top:40px;
	}
	div#containerreg
	{
		width:100%;
		height:100%;
	}
	div.hdrlinkswrapreg
	{
		float:left;
		margin-top:42px;
		font-family:"Arial";
		font-size:14px;
		letter-spacing:2px;
		width:900px;
	}
	div#headerwrapreg
	{
		height:150px;
		width:100%;
		margin:auto;
	}
	div.home,div.aboutus,div.contactus,div.login
	{
		float:right;
		width:120px;
		text-align:center;
	}
	div.home:hover,div.aboutus:hover,div.contactus:hover,div.login:hover
	{
		cursor:pointer;
		font-weight:bold;
	}
	div.logincon
	{
		width:100%;
		margin:auto;
	}
	div.loginwrap
	{
		width:400px;
		margin:auto;
		text-align:left;
	}
	div.tydesc3
	{
		text-align:left;
		font-family:"Segoe UI";
		font-size:16px;
		font-weight:100;
	}
	table#info
	{
		font-family:"Segoe UI";
		font-weight:100;
	}
	.strong
	{
		font-weight:400;
	}
	b{
		font-weight:400;
	}
</style>
</head>
<body>
<?php
	$bdate = "1994-01-13";
	echo date("M d, Y",strtotime($bdate));
?>
	<div id="containerty">
		<div id="headerreg">
			<div id="headerwrapreg">
				<div class="webnamewrapreg">
					<div class="webnamereg">HARRYMAN</div>
				</div>
				
			</div>
		</div>
		<div id="wrapperty">
			<div class="tytitle">Thank You! Emman</div>
			<div class="tydesc">Kindly pay using this link in order for your account to be active. </div>
			<div class="tydesc1">User Login</div>
			<div class="logincon">
				<div class="loginwrap">
					<div class="tydesc3">Usercode : <b>123456</b></div>
					<div class="tydesc3">Password : <b>90f2c9c53f66540e67349e0ab83d8cd0</b></div>
				</div>
			</div>
			<div class="tydesc1">User Information</div>
			<div class="logincon">
				<div class="loginwrap">
					<table id="info">
						<tr>
							<td>First Name</td>
							<td class="strong">: Emman</td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td class="strong">: Arrazola</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td class="strong">: 09175340308</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td class="strong">: 09175340308</td>
						</tr>
						<tr>
							<td>Address</td>
							<td class="strong">: 09175340308</td>
						</tr>
						<tr>
							<td>Birthdate</td>
							<td class="strong">: <?php echo date("M d, Y")?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>