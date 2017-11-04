<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registermodel extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 public function getfullname($FK_users)
	 {
		$this->db->select("CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->where('PK_userdata',"$FK_users");
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row("fullname");
		}
	 }
	 public function registernew($email,$firstname,$lastname,$address,$contactno,$sponsorid,$uplineid,$bdate,$gender)
	 {
		$fullnameupline = $this->getfullname($uplineid);
		$fullnamesponsor = $this->getfullname($sponsorid);
		$password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
		$users = array(
			'password'=>md5($password),
			
		);
		$this->db->insert('users',$users);
		$userskey = $this->db->insert_id();
		$update = array(
			'FK_userdata'=>$userskey
		);
		$this->db->where('PK_users',$userskey);
		$this->db->update('users',$update);
		$userdata = array(
			'PK_userdata'=>$userskey,
			'email'=>$email,
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'address'=>$address,
			'contactno'=>$contactno,
			'gender'=>$gender,
			'bdate'=>$bdate,
		);
		$this->db->insert('userdata',$userdata);
		$regdetails = array(
			'FK_users'=>$userskey,
			'sponsorid'=>$sponsorid,
			'uplineid'=>$uplineid,
			'datetime'=>date("Y-m-d H:i:s")
		);
		if($this->db->insert('regdetails',$regdetails))
		{
			
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = "emmanarrazola@gmail.com"; 
			$config['smtp_pass'] = "110112Juliebee";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";

			
			$emailbdate = date('M d, Y', strtotime($bdate));
			$image = base_url().'css/img/wwicon2.jpg';
			$url1 = base_url().'task/contact';
			$url2 = base_url().'task/about';
			$url3 = base_url().'task/login';
			// Read image path, convert to base64 encoding
			$imageData = base64_encode(file_get_contents($image));
			//echo $imageData;
			// Format the image SRC:  data:{mime};base64,{data};


			// Echo out a sample image
			$data = "<img  height=\"70px\" src=\"".$image."\">";
			$message = "
				<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">
				<html>
				<head>
				</head>
				<body style=\"margin:0;padding:0;\">
					<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" style='background-color:white;width:100%;height:*;padding-bottom:20px;'>
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
			$this->load->library('email');
			$this->email->initialize($config);
			$this->email->from('no-reply@harryman.com'); // change it to yours
			$this->email->to("$email");// change it to yours
			$this->email->subject('Thank you for registering our Network Business');
			$this->email->message($message);
			if($this->email->send())
			{
				$data = array(
					'firstname'=>$firstname
				);
				return $data;
			}
			else
			{
				show_error($this->email->print_debugger());
				return FALSE;
			}
		}	
	}
	public function checksponsor($sponsorid)
	{
		$this->db->select("PK_userdata,CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->like('PK_userdata',"$sponsorid");
		$this->db->limit(4);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
					'PK_userdata'=>$rows->PK_userdata,
					'fullname'=>$rows->fullname
				);
			}	
		}
		else
		{
			$data = FALSE;
		}
		return $data;
	}
	public function checkupline($uplineid)
	{
		$this->db->select("PK_userdata,CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->like('PK_userdata',"$uplineid");
		$this->db->limit(4);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
					'PK_userdata'=>$rows->PK_userdata,
					'fullname'=>$rows->fullname
				);
			}	
		}
		else
		{
			$data = FALSE;
		}
		return $data;
	}
	public function checkfields($columnname,$id)
	{
		$this->db->select("PK_userdata,CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->where('PK_userdata',"$id");
		$this->db->limit(4);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$this->db->select('*');
			$this->db->from('regdetails');
			$this->db->where("$columnname","$id");
			$query1 = $this->db->get();
			if($query1->num_rows() >= 4 )
			{
				$data = "3";
			}
			else
			{
				$data = TRUE;
			}
		}
		else
		{
			$data = FALSE;
		}
		return $data;
	}
	public function uplineidcheck($string)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('PK_users',"$string");
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			$this->db->select('*');
			$this->db->from('regdetails');
			$this->db->where('uplineid',"$string");
			$query1 = $this->db->get();
			if($query1->num_rows() >= 4 )
			{
				$data = 1;
			}
			else
			{
				$data = 2;
			}
		}
		else
		{
			$data = 0;
		}
		return $data;
	}
	public function sponsoridcheck($string)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('PK_users',"$string");
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function emailtesting()
	{
		
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "emmanarrazola@gmail.com"; 
		$config['smtp_pass'] = "110112Juliebee";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$image = 'http://worldwealth.xp3.biz/css/img/wwicon2.jpg';
		$url1 = base_url().'task/contact';
		$url2 = base_url().'task/about';
		$url3 = base_url().'task/login';
		// Read image path, convert to base64 encoding
		$imageData = base64_encode(file_get_contents($image));
		//echo $imageData;
		// Format the image SRC:  data:{mime};base64,{data};


		// Echo out a sample image
		$data = "<img style=\"margin-left:-13px\" hspace=\"-13px\" height=\"70px\" src=\"".$image."\">";
		$emailmsg = "
				<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">
				<html>
				<head>
				</head>
				<body style=\"margin:0;padding:0;\">
					<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" style='background-color:white;width:100%;height:*;padding-bottom:20px;'>
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
		$this->load->library('email');
		$this->email->initialize($config);		
		$this->email->from('no-reply@worldwealth.com', 'Accounts WorldWealth');
		$list = array('esarrazola@manilamed.com');
		$this->email->to($list);
		$this->email->reply_to('no-reply@worldwealth.com', 'Accounts WorldWealth');
		$this->email->subject('Activate Your Account');
		$this->email->message($emailmsg);
		$this->email->send();
		
		show_error($this->email->print_debugger());
	}
		
}