<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

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
	
	
	public function homepage()
	{
		$this->load->helper(array('url'));
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Portal');
		$PK = $this->session->userdata('PK_users');
		$var['total'] = $this->Portal->gettotalupline($PK); 
		$var['totalmembers'] = $this->Portal->repeatgetupline($PK,0,0);
		$var['summary'] = $this->Portal->allcount($var['total'],$PK);
		$var['userdata'] = $this->Portal->getuserdata($PK);
		$var['userdata']['0']['membername'] = $this->Portal->getfullname($var['userdata']['0']['FK_users']);
		$var['userdata']['0']['sponsorname'] = $this->Portal->getfullname($var['userdata']['0']['sponsorid']);
		$var['userdata']['0']['uplinename'] = $this->Portal->getfullname($var['userdata']['0']['uplineid']);
		$var['userdata']['0']['memberdesc'] = $this->Portal->getleveldesc($var['total'],$var['totalmembers']);
		$this->load->view('homapage');
		$this->load->view('profileview',$var);
	}
	
	public function index()
	{
		//$config['db_debug'] = FALSE;
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		//$db_obj = $this->load->database($config,TRUE);
		//$connected = $db_obj->initialize();
	
		
		$var['title'] = "Home - World Wealth";
		$this->load->view('header.php', $var);
		$this->load->view('content.php');
		$this->load->view('footer.php');
	}
	public function register()
	{
		$var['title'] = 'Sign Up - World Wealth';
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->view("header",$var);
		$this->load->view("register");
		$this->load->view("footer");
		//$this->load->view('registration');
	}
	public function secondstep()
	{
		$var['title'] = 'Sign Up - World Wealth';
		$this->load->helper(array('form','url','security'));
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('Registermodel');
		//print_r(is_numeric(''));
		//print_r($this->uplineidcheck('10000000000'));
		//echo $this->input->post('day');
		$this->form_validation->set_message('valid_email','Not a valid Email Address');
		$this->form_validation->set_message('required','This field is required');
		$this->form_validation->set_message('is_unique','Existing Email Address');
		$this->form_validation->set_message('min_length','%s must be at least %s digit');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[userdata.email]');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('uplineid', 'Upline ID', 'trim|required|min_length[5]|max_length[50]|xss_clean|callback_uplineidcheck');
		$this->form_validation->set_rules('sponsorid', 'Sponsor ID', 'trim|required|min_length[5]|max_length[50]|xss_clean|callback_sponsoridcheck');
		$this->form_validation->set_rules('month', 'month', 'callback_checkifnotzero');
		$this->form_validation->set_rules('day', 'day', 'callback_checkifnotzero');
		$this->form_validation->set_rules('year', 'year', 'required|callback_checkbdayyear');
		$this->form_validation->set_rules('gender', 'gender', 'callback_checkgender');
		print_r($this->checkifnotzero('M'));
		if ($this->form_validation->run() !== FALSE)
		{
			$email = $this->input->post("email",TRUE);
			$firstname = $this->input->post("firstname",TRUE);
			$lastname = $this->input->post("lastname",TRUE);
			$address = $this->input->post("address",TRUE);
			$contactno = $this->input->post("contactno",TRUE);
			$sponsorid = $this->input->post("sponsorid",TRUE);
			$uplineid = $this->input->post("uplineid",TRUE);
			$month = $this->input->post("month",TRUE);
			$day = $this->input->post("day");
			$year = $this->input->post("year");
			$gender = $this->input->post("gender",TRUE);
			$bdate = $year."-".$month."-".$day;
			$var['title'] = 'Redirection - World Wealth';
			$registernew = $this->Registermodel->registernew($email,$firstname,$lastname,$address,$contactno,$sponsorid,$uplineid,$bdate,$gender);
			if($registernew !== FALSE)
			{
				$this->load->view('header',$var);
				$this->load->view('thankyou',$registernew);
			}
			else
			{
				$this->load->view("registration",$var);
			}
		}
		else
		{
			if(!form_error('email') && !form_error('uplineid') && !form_error('sponsorid'))
			{
				$var['secondstep'] = '1';
			}
			$this->load->view('header',$var);
			$this->load->view('register');
			$this->load->view('footer');
		}
	}
	public function checkbdayyear($string)
	{
		$yearprev = date('Y') - 150;
		if(is_numeric($string) == TRUE)
		{
			if($string >= $yearprev && $string < date('Y'))
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('checkbdayyear','Date is not valid');
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('checkbdayyear','Date is not valid');
			return FALSE;
		}
	}
	public function checkifnotzero($string){
		//$yearprev = date('Y') - 150;
		if($string == 0)
		{
			$this->form_validation->set_message('checkifnotzero','This field is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function checkgender($string){
		if($string == '0')
		{
			$this->form_validation->set_message('checkgender','This field is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function uplineidcheck($string)
	{
		
		$checkupline = $this->Registermodel->uplineidcheck($string);
		if($checkupline == 0)
		{
			$this->form_validation->set_message('uplineidcheck','Not a valid Upline ID');
			return false;
		}
		else if($checkupline == 1)
		{
			$this->form_validation->set_message('uplineidcheck','%s has reach its limit');
			return false;
		}
		else
		{
			return TRUE;
		}
	}
	public function sponsoridcheck($string)
	{
		
		$checksponsor = $this->Registermodel->sponsoridcheck($string);
		if($checksponsor == FALSE)
		{
			$this->form_validation->set_message('sponsoridcheck','Not a valid Sponsor ID');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function checkregistration()
	{
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$email = $this->input->post("email",TRUE);
		$firstname = $this->input->post("firstname",TRUE);
		$lastname = $this->input->post("lastname",TRUE);
		$address = $this->input->post("address",TRUE);
		$contactno = $this->input->post("contact",TRUE);
		$sponsorid = $this->input->post("sponsorid",TRUE);
		$uplineid = $this->input->post("uplineid",TRUE);
		$month = $this->input->post("month",TRUE);
		$day = $this->input->post("day");
		$year = $this->input->post("year");
		$gender = $this->input->post("gender",TRUE);
		$var["monthval"] = $month;
		$var["dayval"] = $day;
		$var["yearval"] = $year;
		$terms = $this->input->post("terms",TRUE);
		$var["genderval"] = $gender;
		$this->form_validation->set_message('is_unique',"Existing Email Address");
		$this->form_validation->set_message('required',"%s is Required");
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[userdata.email]');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[50]|xss_clean');
		//$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('contact', 'Contact No', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sponsorid', 'Sponsor ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('uplineid', 'Upline ID', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('uplineid', 'Upline ID', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('','');
		if($month !== 0 && $day !== 0 && ($year !== NULL || $year !== "" || $year !== "Year")): 
			  $monthv = TRUE;
			  $var["errorsbdate"] = FALSE;
		else: $var["errorsbdate"] = "Birth Date is required\n";
			  $monthv = FALSE;
		endif; 
		
		if($terms == 1): 
			  $termsv = TRUE;
			  $var["errorsterms"] = FALSE;
		else: $var["errorsterms"] = "Terms and Condition must be accepted\n";
			  $termsv = FALSE;
		endif;

		if($gender == "0"): 
				$genderv = FALSE;
				$var["errorsgender"] = "Gender is Required\n";
		else: 
			  $var["errorsgender"] = FALSE;
			  $genderv = TRUE;
		endif; 
		
		$var["allerrors"] = $var["errorsbdate"]."".$var["errorsterms"]."".$var["errorsgender"];
		if ($this->form_validation->run() !== FALSE)
		{
			if($termsv == 1 && $genderv == 1 && $monthv == 1)
			{
				$this->load->model("Registermodel");
				$bdate = $year."-".$month."-".$day;
				$checkupline = $this->Registermodel->checkfields("uplineid",$uplineid);
				if($checkupline == TRUE)
				{
					$registernew = $this->Registermodel->registernew($email,$firstname,$lastname,$address,$contactno,$sponsorid,$uplineid,$bdate,$gender);
					if($registernew !== FALSE)
					{
						$this->load->view('thankyou',$registernew);
					}
					else
					{
						$this->load->view("registration",$var);
					}
				}
				else if($checkupline == FALSE)
				{
					
					$var["allerrors"] .= ""."Not a valid Upline ID\n";
					$this->load->view("registration",$var);
				}
				else
				{
					$var["allerrors"] .= ""."Upline ID has reach its limit\n";
					$this->load->view("registration",$var);
				}
			}
			else
			{
				$this->load->model("Registermodel");
				$checkupline = $this->Registermodel->checkfields("uplineid",$uplineid);
				if($checkupline == TRUE)
				{
					$var["allerrors"] .= ""."";
				}
				else if($checkupline == FALSE)
				{
					$var["allerrors"] .= ""."Not a valid Upline ID\n";
				}
				else
				{
					$var["allerrors"] .= ""."Upline ID has reach its limit\n";
				}
				$this->load->view("registration",$var);
			}
		}
		else
		{
			$this->load->view("registration",$var);
		}
	}
	public function checklogin()
	{
		$var['title'] = 'Login - World Wealth';
		$helper = array('url','form','security');
		$this->load->helper($helper);
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('username', 'First Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('password', 'Last Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		if ($this->form_validation->run() !== FALSE):
			$var["loginattemp"] = 0;
			$this->load->database();
			$this->load->model('Loginmodel');
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$check = $this->Loginmodel->checklogin($username,$password);
			if($check !== FALSE):
				if(isset($check['oldpass']) !== TRUE):
					$this->session->set_userdata($check);
					redirect("portal/homepage");
				else:
					$this->load->view("header",$var);
					$this->load->view("login",$var);
					$this->load->view("footer");
					//print_r($check);	
				endif;
			else:
				$var["loginattemp"] = 1;
				$this->load->view("header",$var);
				$this->load->view("login",$var);
				$this->load->view("footer");
			endif;
		else:
			$var["loginattemp"] = 0;
			$this->load->view("header",$var);
			$this->load->view("login");
			$this->load->view("footer");
		endif;
	}
	public function checksponsor()
	{
		$sponsorid = $this->input->post("sponsorid",TRUE);
		$this->load->database();
		$this->load->model("Registermodel");
		$check = $this->Registermodel->checksponsor($sponsorid);
		if($check !== FALSE)
		{
			foreach($check as $rows)
			{
				$id = $rows["PK_userdata"];
				echo "<div class=\"lblselectname\" id=\"$id\">".$rows["fullname"]."</div>";
			}
		}
		else
		{
			echo "<div class=\"lblselectname\" id=\"0\">No Sponsor ID Found</div>";
		}
	}
	public function checkupline()
	{
		$uplineid = $this->input->post("uplineid",TRUE);
		$this->load->database();
		$this->load->model("Registermodel");
		$check = $this->Registermodel->checkupline($uplineid);
		if($check !== FALSE && $check != "3")
		{
			foreach($check as $rows)
			{
				$id = $rows["PK_userdata"];
				echo "<div class=\"lblselectnameu\" id=\"$id\">".$rows["fullname"]."</div>";
			}
		}
		else if($check == "3")
		{
			echo "<div class=\"lblselectnameu\" id=\"0\">This ID reach its limit</div>";
		}
		
		else
		{
			echo "<div class=\"lblselectnameu\" id=\"0\">No Upline ID Found</div>";
		}
	}
	public function contact()
	{
		$var['title'] = 'Contact Us - World Wealth';
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->view('header',$var);
		$this->load->view('contactus',$var);
		$this->load->view('footer');
	}
	public function logout()
	{
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Homemodel');
		$isupdate = $this->Homemodel->insertlastlogin($this->session->userdata("PK_users"));
		if($isupdate !== FALSE)
		{
			$this->session->sess_destroy();
			redirect("");
		}
	}
	public function testing()
	{
		$this->load->helper('url');
		$var['title'] = 'Thank You - World Wealth';
		$this->load->library('form_validation');
		$this->load->database();
		//$this->load->view('header',$var);
		//$this->load->view('thankyou');
		//$this->load->view('footer');
		$this->load->model('Loginmodel');
		$this->Loginmodel->checklogin($username,'emman');
	}
	public function login()
	{
		$var['title'] = 'Login - World Wealth';
		$var['loginattemp'] = '0';
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->view('header',$var);
		//echo validation_errors();
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function emailtesting()
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Registermodel');
		$this->Registermodel->emailtesting();
	}
}