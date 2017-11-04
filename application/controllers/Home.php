<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
	
	public function index()
	{
		$style = $this->input->get('style',TRUE);
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		if($this->session->userdata("loginnet") == TRUE)
		{
			$PK = $this->session->userdata("PK_users");
			//print_r($this->session->userdata());
			$this->load->model("Homemodel");
			$var["personaldata"] = $this->Homemodel->getpersonaldata($PK);
			
			//print_r($var["personaldata"]);
			//$this->Homemodel->getalluserdata($this->session->userdata("PK_users"));
			//$this->Homemodel->getuplinebyuser('10000000001');
			$this->load->view('member');
			if ($this->Homemodel->getlastchangepass("$PK") !== FALSE) $var['lastchangepass'] = date("d M Y h:i A",strtotime($this->Homemodel->getlastchangepass("$PK")));
			else $var['lastchangepass'] = "Password Never Change";
			
			
			if($this->Homemodel->getlastlogin("$PK") == '0000-00-00 00:00:00')
			{
				$var['lastlogin'] = "No Previous Login";
			}
			else
			{
				$var['lastlogin'] = date("d M Y h:i A",strtotime($this->Homemodel->getlastlogin("$PK")));
			}
			$var['total'] = $this->Homemodel->gettotalupline($PK); //- $var['total']."<br />";
			$var['params'] = $this->Homemodel->getnextlevelstats($var['total']);
			//echo $var['maxlevel'];
			//echo $var['total']."<br />";
			$var['upline'] = $this->Homemodel->getcount("uplineid",$PK,$var['total']);
			//print_r($var['upline']);
			
			//$var['total'] = $this->session->userdata('count');
			
			//$var['sponsor'] = $this->Homemodel->getcount("sponsorid",$PK);
			//echo "<br />".$this->Homemodel->getrecursivebyPK();
			$summary = $this->Homemodel->allcount($var['total'],$PK);
			$var['leveldetails'] = $summary['description'];
			$var['memberamount'] = $summary['memberamount'];
			$var['serviceamount'] = $summary['serviceamount'];
			//$this->Homemodel->getallbankaccounts($PK);
			if($style == "settings")
			{
				$var["bankaccounts"] = $this->Homemodel->bankaccounts($PK);
				$this->load->view('settings',$var);
			}
			else if($style == "profile")
			{
				$this->load->view('profile',$var);
			}
			else if($style == "password")
			{
				$this->load->view('password',$var);
			}
			else if($style == NULL)
			{
				$this->load->view('profile',$var);
				$this->load->view('footer');
			}
			else
			{
				redirect('404');
			}
			//print_r($var["personaldata"]);
			
		}
		else
		{
			redirect("");
		}
	}
	public function pyramidview()
	{
		$PK = $this->input->get('PK');
		$this->load->database();
		$this->load->model('Homemodel');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$data['test'] = "<div class=\"tree\"><ul>";
		$data['test'] .= $this->Homemodel->nestedviewbyPK($PK,"",$this->Homemodel->getfullname($PK));
		$data['test'] .= "</ul></div>";
		//echo $data['test'];
		//echo $this->Homemodel->nestedviewtest('10000000001',0,"");
		$this->load->view('pyramid1',$data);
		//echo $this->Homemodel->getnextlevelstats(79);
		//echo $this->Homemodel->repeatgetupline('10000000000',0,0);
	}
	public function reloadpyramid()
	{
		$PK = $this->input->get('PK');
		$this->load->database();
		$this->load->model('Homemodel');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$data['test'] = "<div class=\"tree\"><ul>";
		$data['test'] .= $this->Homemodel->nestedviewtest($PK,"",$this->Homemodel->getfullname($PK));
		$data['test'] .= "</ul></div>";
		//echo $data['test'];
		//echo $this->Homemodel->nestedviewtest('10000000001',0,"");
		$this->load->view('pyramid',$data);
	}
	public function updateregdetails()
	{
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Homemodel');
		
		$this->load->database();
		$PK = $this->session->userdata("PK_users");	
		$var["personaldata"] = $this->Homemodel->getpersonaldata($PK);
		$email = $this->input->post("email",TRUE);
		$firstname = $this->input->post("firstname",TRUE);
		$lastname = $this->input->post("lastname",TRUE);
		$address = $this->input->post("address",TRUE);
		$contactno = $this->input->post("contactno",TRUE);
		$gender = $this->input->post("gender",TRUE);
		//$sponsorid = $this->input->post("sponsorid",TRUE);
		//$uplineid = $this->input->post("uplineid",TRUE);
		$month = $this->input->post("month",TRUE);
		$day = $this->input->post("day",TRUE);
		$year = $this->input->post("year",TRUE);
		$bdate = $year."-".$month."-".$day;
		$bdate = date("Y-m-d",strtotime($bdate));
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		//$this->form_validation->set_rules('bankname', 'Bank Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		//$this->form_validation->set_rules('accountno', 'Bank Account No', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_error_delimiters('','');
		if($this->form_validation->run() !== FALSE)
		{
			$var["bankaccounts"] = $this->Homemodel->bankaccounts($PK);
			$isvalidemail = $this->Homemodel->checkemail($PK,$email);
			if($isvalidemail == FALSE)
			{
				$var["errors"] = "Existing Email Address\n";
				$this->load->view("member",$var);
				$this->load->view("settings",$var);
			}
			else
			{
				$bankname = $this->input->post('bankname[]',FALSE);
				$accountno = $this->input->post('accountno[]',FALSE);
				$hidden = $this->input->post('hiddenval');
				$buildbank = $this->input->post('buildbank[]',FALSE);
				$buildaccountno = $this->input->post('buildaccountno[]',FALSE);
				//print_r($buildaccountno);
				echo $this->Homemodel->updatebankaccount($PK,$buildbank,$buildaccountno,$hidden);
				$isupdate = $this->Homemodel->updatedata($PK,$email,$firstname,$lastname,$address,$contactno,$bdate,$gender,$bankname,$accountno);
				//$count = 0;
				//print_r( $this->input->post('bankname[]',FALSE) );
				//print_r( $this->input->post('accountno[]',FALSE) );
				
				if($isupdate !== FALSE)
				{
					$var["bankaccounts"] = $this->Homemodel->bankaccounts($PK);
					$var["msg"] = TRUE;
					$this->load->view("member",$var);
					$this->load->view("settings",$var);
				}
				else
				{
					$var["bankaccounts"] = $this->Homemodel->bankaccounts($PK);
					$var["msg"] = FALSE;
					$this->load->view("member",$var);
					$this->load->view("settings",$var);
				}
				
			}
		}
		else
		{
			$isvalidemail = $this->Homemodel->checkemail($PK,$email);
			if($isvalidemail == FALSE)
			{
				$var["errors"] = "Existing Email Address\n";
			}
			else
			{
				$var["errors"] = "";
			}
			$this->load->view("member",$var);
			$this->load->view("settings",$var);
		}
	}
	public function updatepass()
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$oldpass = $this->input->post("oldpass");
		$newpass = $this->input->post("newpass");
		$retypepass = $this->input->post("retypepass");
		$this->load->model('Homemodel');
		$PK = $this->session->userdata("PK_users");
		$this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('newpass', 'New Password', 'trim|required|min_length[6]|xss_clean|matches[retypepass]');
		$this->form_validation->set_rules('retypepass', 'Retype Password', 'trim|required|xss_clean');
		$this->form_validation->set_message('matches','Password doesnt match');
		$this->form_validation->set_message('min_length','%s must be at least %s characters');
		$this->form_validation->set_error_delimiters('','');
		if($this->form_validation->run() !== FALSE)
		{	
			
			$isoldpassmatch = $this->Homemodel->getpass($PK,$oldpass);
			if($isoldpassmatch == TRUE)
			{
				
				$ispassupdate = $this->Homemodel->updatepass($PK,$oldpass,$newpass);
				if($ispassupdate == TRUE)
				{
					$var['msg'] = TRUE;
				}
				else
				{
					$var['msg'] = FALSE;
				}
				
				$this->load->view('member');
				$this->load->view('password',$var);
			}
			else
			{
				$var["errors"] = "Incorrect Old Password";
				$var['msg'] = FALSE;
				$this->load->view('member',$var);
				$this->load->view('password',$var);
			}
		}	
		else
		{
			$var['msg'] = FALSE;
			$this->load->view('member');
			$this->load->view('password',$var);
		}
	}
	public function testingcount()
	{
		$this->load->database();
		$this->load->model('Homemodel');
		$this->load->library('session');
		$this->Homemodel->getuplinebyuser('10000000004');
		echo $this->session->userdata('count');
	}
	public function reservedview()
	{
		$this->load->view('member');
	}
	public function nestedview()
	{
		
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$var['title'] = 'test';
		
		$this->load->library('form_validation'); 
		//$this->load->view('member',$var);
		$this->load->database();
		$this->load->model('Homemodel');	
		//$this->output->append_output(
		//$this->Homemodel->nestedviewtest('10000000007',0,array());
		$data['test'] = $this->Homemodel->nestedviewtest('10000000000',0,'');
		//$data2= $this->Homemodel->nestedviewtest('10000000000',0,'');
		//echo $data2;
		
		$this->load->view('nested',$data);
		//echo $data['test'];
		//$this->output->set_output($data);
		/*
		$data =array(
			'10000000000'=>'10000000000',
			'10000000001'=>'10000000001',
			'10000000002'=>'10000000002',
			'10000000003'=>array('10000000005'=>'10000000005'),
		
		);
		print "<pre>";
		print_r($data);
		print "</pre>";
		*/
	}
	public function viewtree()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');
		$PK = $this->input->get('PK');
		$this->load->database();
		$this->load->model('Homemodel');
		$data['PK'] = $PK;
		$data['test'] = $this->Homemodel->nestedviewtest($PK,0,'');
		//$data['test']
		$this->load->view('member');
		$this->load->view('nested',$data);
	}
	public function search(){
		$keywords = $this->input->post('keywords');
		$this->load->database();
		$this->load->model('Homemodel');
		//echo $keywords;
		$var['result'] = $this->Homemodel->searchquery($keywords);
		$this->load->view('result',$var);
		//echo $keywords;
	}
	public function emaildesign()
	{
		$this->load->view('emaildesign');
	}
	public function testingkoto()
	{
		$firstname = "Emman";
		$lastname = "Arrazola";
		$userskey = "10";
		$password = "aSlion";
		$contactno = "";
		$sponsorid = "123456";
		$uplineid = "123456";
		$address = "";
		$emailbdate = "";
		$fullnamesponsor = "Arrazola";
		$fullnameupline = "Arrazola";
		$this->load->database();
		$this->load->model("Registermodel");
		$echo = "<html>
			<head>
			</head>
			<body style='margin:0;padding;0'>
				<div id='containerty' style='height:600px;width:100%;'>
					<div id='headerreg' style='background-color:#ededed;height:100px;box-shadow:0px -5px 2px 5px;'>
						<div id='headerwrapreg' style='height:100px;width:100%;margin:auto;'>
							<div class='webnamewrapreg' style='float:left;'>
								<div style=\"height:100px;width:600px\">
									<img src=\"http://worldwealth.xp3.biz/css/img/companylogo-email.png\" height=\"75px\">
								</div>
							</div>
						</div>
					</div>
					<div id='wrapperty' style='height:400px;width:700px;margin:auto;margin-top:20px;'>
						<div class='tytitle' style=\"padding-top:50px;padding-bottom:20px;text-align:center;font-family:'Segoe UI';font-size:40px;font-weight:100;\">Thank You! $firstname</div>
						<div class='tydesc' style=\"text-align:center;font-family:'Segoe UI';font-size:20px;font-weight:100;\">Kindly pay using this link in order for your account to be active. </div>
						<div class='tydesc1' style=\"text-align:center;font-family:'Segoe UI';font-size:20px;font-weight:100;\">User Login</div>
						<div class='logincon'>
							<div class='loginwrap' style='width:400px;margin:auto;text-align:left;'>
								<div class='tydesc3' style=\"text-align:left;font-family:'Segoe UI';font-size:16px;font-weight:100;\">Usercode : <strong>$userskey</strong></div>
								<div class='tydesc3' style=\"text-align:left;font-family:'Segoe UI';font-size:16px;font-weight:100;\">Password : <strong>$password</strong></div>
							</div>
						</div>
						<div class='tydesc1' style=\"text-align:center;font-family:'Segoe UI';font-size:20px;font-weight:100;margin-top:20px\">User Information</div>
						<div class='logincon' style='width:100%;margin:auto;'>
							<div class='loginwrap' style='width:400px;margin:auto;text-align:left;'>
								<table id='info' style=\"font-family:'Segoe UI';font-weight:100;\">
									<tr>
										<td>First Name</td>
										<td class='strong' style='font-weight:400;'>: $firstname</td>
									</tr>
									<tr>
										<td>Last Name</td>
										<td class='strong' style='font-weight:400;'>: $lastname</td>
									</tr>
									<tr>
										<td>Contact No</td>
										<td class='strong' style='font-weight:400;'>: $contactno</td>
									</tr>
									<tr>
										<td>Sponsor ID</td>
										<td class='strong' style='font-weight:400;'>: $sponsorid - $fullnamesponsor</td>
									</tr>
									<tr>
										<td>Upline ID</td>
										<td class='strong' style='font-weight:400;'>: $uplineid - $fullnameupline</td>
									</tr>
									<tr>
										<td>Address</td>
										<td class='strong' style='font-weight:400;'>: $address</td>
									</tr>
									<tr>
										<td>Birthdate</td>
										<td class='strong' style='font-weight:400;'>: $emailbdate </td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</body>
			</html>";
			echo $echo;
	}
}