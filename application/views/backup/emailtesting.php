<?php
	$image = base_url().'css/img/wwicon2.jpg';
	$url1 = base_url().'task/contact';
	$url2 = base_url().'task/about';
	$url3 = base_url().'task/login';
	// Read image path, convert to base64 encoding
	$imageData = base64_encode(file_get_contents($image));
	//echo $imageData;
	// Format the image SRC:  data:{mime};base64,{data};


	// Echo out a sample image
	$data = "<img style=\"margin-left:-13px\" height=\"70px\" src=\"".$image."\">";
	$emailmsg = "
				<html>
				<head>
				</head>
				<body style='margin:50px 150px 50px 150px;padding;0;'>
					<table cellspacing=\"0\" cellpadding=\"0\" style='background-color:white;width:100%;height:*;padding-bottom:20px;'>
						<tr>
							<td>
								<table style=\"width:80%;margin:auto\">
									<tr>
										<td>$data</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table style=\"background-color:#f2f2f2; box-shadow:0px 0px 10px 0px; width:80%;margin:auto;\" cellpadding=\"0\" cellspacing=\"0\">
									<tr>
										<td>
											<table style='text-indent:5%;width:100%;font-family:\"Arial Narrow\";color:white;line-height:120px;font-size:30px;background-color:#024972;height:100px;border-bottom:1px solid silver;margin:auto;'>
												<tr>
													<td>Just One More Step</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table cellspacing=\"0\" cellpadding=\"0\" style='width:100%;margin:auto;text-align:left;font-family:\"Segoe UI\";color:black;font-size:13px;'>
												<tr>
													<td>
														<table style=\"padding:20px 50px 0px 50px;width:100%;font-size:13px;\">
															<tr>
																<td style=\"line-height:25px;\">
																	<strong>Mr. Emman Arrazola,</strong>
																	<br/>
																	Just one more step to activate your account.<br />
																	Use this <a href=\"http://facebook.com/eman.invok.05\">link</a	> to pay in order for your account to be active.<br />
																	Kindly validate your data before proceeding to the next step.
																	<br/><br/>
																	<strong>Personal Information</strong><br/>
																	Firstname: Emman <br/>
																	Lastname: Arrazola <br/>
																	Address: Bldg 22-101 Vitas, Tondo, Manila<br/>
																	Sponsor: 10001 - Juan Dela Cruz<br/>
																	Upline: 10001 - Juan Dela Cruz<br/>
																	Contact No: 09175340308<br/><br/>
																	You can use below temporary password to login on our <a style=\"color:#008fe1;\" href=\"$url3\" title=\"Contact Us\">Portal.</a><br/>
																	Username: <strong>emmanarrazola@gmail.com</strong><br/>
																	Password: <strong>abcde12345</strong><br/><br/>
																	Best,<br/>
																	Worldwealth Dev Team
																</td>
															</tr>
														</table>
														<table style=\"padding:30px 50px 50px 50px; width:100%; font-family:'Segoe UI';font-size:10px;color:gray;\">
															<tr>
																<td>
																	This email cant receive replies. If you want to contact us <a style=\"color:#008fe1;\" href=\"$url1\" title=\"Contact Us\">click here.</a><br/>
																	For more information about WorldWealth <a style=\"color:#008fe1;\" href=\"$url2\">click here.</a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</body>
				</html>";
				
	echo $emailmsg;
?>


