<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

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
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form'));
	}
	
	public function homepage()
	{
		$this->load->helper(array('url','form','security'));
		if($this->isloggedin() !== FALSE)
		{
			$homepage['profiledir'] = 'blue';
			$homepage['walletdir'] = '';
			$homepage['trxdir'] = '';
			$homepage['incentivesdir'] = '';
			$this->load->library('session');
			$PK = $this->session->userdata('PK_users');
			$this->load->database();
			$this->load->model('Portalmodel');
			$homepage['PK'] = $PK;
			$var['total'] = $this->Portalmodel->getalldirectupline($PK); 
			//$total = 5; //$var['total'];
			if(file_exists("css/uploads/$PK.jpg") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.jpg";
			else if(file_exists("css/uploads/$PK.png") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.png";
			else if(file_exists("css/uploads/$PK.gif") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.gif";
			else $var['profilepic'] = base_url()."css/img/userpic.png";
			$var['totalmembers'] = $this->Portalmodel->repeatgetupline($PK,0,0);
			$var['summary'] = $this->Portalmodel->allcount($var['totalmembers'],$PK);
			$var['userdata'] = $this->Portalmodel->getuserdata($PK);
			$var['userdata']['0']['membername'] = $this->Portalmodel->getfullname($var['userdata']['0']['FK_users']);
			$var['userdata']['0']['sponsorname'] = $this->Portalmodel->getfullname($var['userdata']['0']['sponsorid']);
			$var['userdata']['0']['uplinename'] = $this->Portalmodel->getfullname($var['userdata']['0']['uplineid']);
			$var['userdata']['0']['memberdesc'] = $this->Portalmodel->getleveldesc($var['total'],$var['totalmembers']);
			//print_r( $var['userdata']['0']['memberdesc'] );
			//print_r($var['totalmembers']);
			$this->load->view('homapage',$homepage);
			$this->load->view('profileview',$var);
		}
		else redirect('portal');
	}
	public function pretesting()
	{
		$this->load->database();
		$this->load->model('Portalmodel');
		$PK = '10001';
		print "<pre>";
		print_r($this->Portalmodel->nestedarraybyPK2($PK,'Juan Baby'));
		print "</pre>";
	}
	public function pretesting2()
	{
		$this->load->database();
		$this->load->model('Portalmodel');
		$FK_users = '10000';
		$total = $this->Portalmodel->getalldirectupline($FK_users); 
		$totalmembers = $this->Portalmodel->repeatgetupline($FK_users,0,0);
		$diff = $totalmembers;
		$desc = $this->Portalmodel->getleveldesc($total,$totalmembers);
		print "<pre>";
		print_r($totalmembers);
		$totalmembers = null;
		print "</pre>";
		echo $totalmembers;
	}
	public function transaction()
	{
		$this->load->helper(array('url','form','security'));
		if($this->isloggedin() !== FALSE)
		{
			$homepage['profiledir'] = '';
			$homepage['walletdir'] = '';
			$homepage['trxdir'] = 'blue';
			$homepage['incentivesdir'] = '';
			$this->load->library('session');
			$homepage['PK'] = $this->session->userdata('PK_users');
			$this->load->view('homapage',$homepage);
			$this->load->view('transaction');
		}
		else
		{
			redirect('portal');
		}
	}
	public function wallet()
	{
		$this->load->helper(array('url','form','security'));
		if($this->isloggedin() !== FALSE)
		{
			$this->load->database();
			$this->load->model('Portalmodel');
			$var['profiledir'] = '';
			$var['walletdir'] = 'blue';
			$var['trxdir'] = '';
			$var['incentivesdir'] = '';
			$this->load->library('session');
			$PK = $this->session->userdata('PK_users');
			if(file_exists("css/uploads/$PK.jpg") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.jpg";
			else if(file_exists("css/uploads/$PK.png") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.png";
			else if(file_exists("css/uploads/$PK.gif") !== false) $var['profilepic'] = base_url()."css/uploads/$PK.gif";
			else $var['profilepic'] = base_url()."css/img/userpic.png";
			$this->load->library('session');
			$var['PK'] = $this->session->userdata('PK_users');
			$var['total'] = $this->Portalmodel->getalldirectupline($PK); 
			$var['encashments'] = $this->Portalmodel->getallencashments($PK); 
			$var['totencashments'] = $this->Portalmodel->gettotalencashments($PK); 
			$var['totalmembers'] = $this->Portalmodel->repeatgetupline($PK,0,0);
			$var['summary'] = $this->Portalmodel->allcount($var['totalmembers'],$PK);
			$var['userdata']['0']['memberdesc'] = $this->Portalmodel->getleveldesc($var['total'],$var['totalmembers']);
			$var['encashtype'] = $this->Portalmodel->getallencashtype();
			//print_r($var['encashments']);
			$this->load->view('homapage',$var);
			$this->load->view('wallet',$var);
		}
		else
		{
			redirect('portal');
		}
	}
	public function encashments()
	{
		//ajax
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Portalmodel');
		$PK = $this->session->userdata('PK_users');
		$forexcode = $this->input->post('forexcode');
		$forextype = $this->input->post('forextype');
		$amount = $this->input->post('amount');
		$check = $this->Portalmodel->addencashment($forexcode,$forextype,$amount,$PK);
		if($check !== FALSE) echo "1";
		else echo "0";
	}
	public function getforex($codefrom,$codeto)
	{
		$code = $codefrom.$codeto;
		$url = str_getcsv(file_get_contents("http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=$code=X"));
		return $url[1];
	}
	public function converterapi()
	{
		$amount = str_replace(',','',$_POST['amount']) + 0;
		$codeto = $this->input->post('forexcode',TRUE); //$_POST['forexcode'];
		$total = $amount / $this->getforex($codeto,'PHP');
		echo number_format($total, 2);
	}
	public function pyramidview()
	{
		$PK = $this->input->get('PK');
		$this->load->database();
		$this->load->model('Portalmodel');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		
		//print_r( $data['leveling'] );
		$data['test'] = "<div class=\"tree\">";
		$data['test'] .= $this->Portalmodel->nestedviewbyPKemman($PK,$this->Portalmodel->getfullname($PK));
		$data['test'] .= "</div>";
		$data['leveling'] = $this->Portalmodel->nestedarraybyPK2($PK,$this->Portalmodel->getfullname($PK)); 
		//print_r($data['leveling']);
		$this->load->view('pyramid1',$data);

	}
	public function updateprofile()
	{
		$homepage['profiledir'] = 'blue';
		$homepage['walletdir'] = '';
		$homepage['trxdir'] = '';
		$homepage['incentivesdir'] = '';
		$this->load->helper(array('url','form'));
		$this->load->library('session');
		$this->load->database();
		$this->load->model('Portalmodel');
		$PK = $this->session->userdata('PK_users');
		$homepage['PK'] = $PK;
		$var["bankaccounts"] = $this->Portalmodel->bankaccounts($PK);
		$var["personaldata"] = $this->Portalmodel->getpersonaldata($PK);
		$this->load->view('homapage',$homepage);
		$this->load->view("settings",$var);
	}
	public function updateregdetails()
	{
		$var['profiledir'] = 'blue';
		$var['walletdir'] = '';
		$var['trxdir'] = '';
		$var['incentivesdir'] = '';
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Portalmodel');
		$this->load->database();
		$PK = $this->session->userdata("PK_users");	
		$var['PK'] = $PK;	
		$var["personaldata"] = $this->Portalmodel->getpersonaldata($PK);
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
		$var["bankaccounts"] = $this->Portalmodel->bankaccounts($PK);
		if($this->form_validation->run() !== FALSE)
		{
			
			$isvalidemail = $this->Portalmodel->checkemail($PK,$email);
			if($isvalidemail == FALSE)
			{
				$var["errors"] = "Existing Email Address\n";
				$this->load->view("homapage",$var);
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
				$this->Portalmodel->updatebankaccount($PK,$buildbank,$buildaccountno,$hidden);
				$isupdate = $this->Portalmodel->updatedata($PK,$email,$firstname,$lastname,$address,$contactno,$bdate,$gender,$bankname,$accountno);
				//$count = 0;
				//print_r( $this->input->post('bankname[]',FALSE) );
				//print_r( $this->input->post('accountno[]',FALSE) );
				
				if($isupdate !== FALSE)
				{
					$var["bankaccounts"] = $this->Portalmodel->bankaccounts($PK);
					$var["msg"] = TRUE;
					$this->load->view("homapage",$var);
					$this->load->view("settings",$var);
				}
				else
				{
					$var["bankaccounts"] = $this->Portalmodel->bankaccounts($PK);
					$var["msg"] = FALSE;
					$this->load->view("homapage",$var);
					$this->load->view("settings",$var);
				}
				
			}
		}
		else
		{
			$isvalidemail = $this->Portalmodel->checkemail($PK,$email);
			if($isvalidemail == FALSE)
			{
				$var["errors"] = "Existing Email Address\n";
			}
			else
			{
				$var["errors"] = "";
			}
			$this->load->view("homapage",$var);
			$this->load->view("settings",$var);
		}
	}
	public function updatepassword()
	{
		$this->load->helper(array('url','form'));
		$this->load->library('session');
		$var['PK'] = $this->session->userdata('PK_users');
		$var['profiledir'] = 'blue';
		$var['walletdir'] = '';
		$var['trxdir'] = '';
		$var['incentivesdir'] = '';
		$this->load->view('homapage',$var);
		$this->load->view('password');
	}
	public function updatepicture()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('session');
		$this->session->userdata('PK_users');
		$var['PK'] = $this->session->userdata('PK_users');
		$var['profiledir'] = 'blue';
		$var['walletdir'] = '';
		$var['trxdir'] = '';
		$var['incentivesdir'] = '';
		$this->load->view('homapage',$var);
		$this->load->view('uploader',array('error'=>' '));
	}
	public function uploader()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('session');
		if($this->isloggedin() !== FALSE)
		{
			$config['upload_path']          = 'css/uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 512;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['file_name']           = $this->session->userdata('PK_users');
			$config['overwrite']           = TRUE;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
					$error = array('error' => $this->upload->display_errors('',''));
					$var['profiledir'] = 'blue';
					$var['walletdir'] = '';
					$var['trxdir'] = '';
					$var['incentivesdir'] = '';
					$this->load->view('homapage',$var);
					$this->load->view('uploader', $error);
			}
			else
			{
					$data = array('upload_data' => $this->upload->data());
					redirect('portal/homepage','location',301);
					//$this->homepage();
			}
		}
		else $this->index();
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
		$homepage['profiledir'] = 'blue';
		$homepage['walletdir'] = '';
		$homepage['trxdir'] = '';
		$homepage['incentivesdir'] = '';
		$this->load->library('session');
		$homepage['PK'] = $this->session->userdata('PK_users');
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
				
				$this->load->view('homapage',$homepage);
				$this->load->view('password',$var);
			}
			else
			{
				$var["errors"] = "Incorrect Old Password";
				$var['msg'] = FALSE;
				$this->load->view('homapage',$homepage);
				$this->load->view('password',$var);
			}
		}	
		else
		{
			$var['msg'] = FALSE;
			$this->load->view('homapage',$homepage);
			$this->load->view('password',$var);
		}
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
		$this->form_validation->set_rules('uplineid', 'Upline ID', 'trim|required|min_length[11]|max_length[50]|xss_clean|callback_uplineidcheck');
		$this->form_validation->set_rules('sponsorid', 'Sponsor ID', 'trim|required|min_length[11]|max_length[50]|xss_clean|callback_sponsoridcheck');
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
	protected function isloggedin()
	{
		$this->load->library('session');
		if($this->session->userdata('PK_users')) return TRUE;
		else return FALSE;
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
		if ($this->form_validation->run() !== FALSE)
		{
			$var["loginattemp"] = 0;
			$this->load->database();
			$this->load->model('Loginmodel');
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$check = $this->Loginmodel->checklogin($username,$password);
			if($check !== FALSE)
			{
				$this->session->set_userdata($check);
				//print_r($check);
				redirect("home");
			}
			else
			{
				$var["loginattemp"] = 1;
				$this->load->view("header",$var);
				$this->load->view("login",$var);
				$this->load->view("footer");
			}
		}
		else
		{
			$var["loginattemp"] = 0;
			$this->load->view("header",$var);
			$this->load->view("login");
			$this->load->view("footer");
		}
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
	public function pretesting1()
	{
		$this->load->database();
		$this->load->model('Portalmodel');
		$url = base_url()."css/pyramidview.css";
		$PK = '10001';
		$fullname = $this->Portalmodel->getfullname($PK);
		$data['test'] = "<div class=\"tree\">";
		$data['test'] .= $this->Portalmodel->nestedviewbyPKemman($PK,$this->Portalmodel->getfullname($PK));
		$data['test'] .= "</div>";
		echo "<html>";
		echo "<head>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$url\" />";
		echo "</head>";
		$this->load->view('pyramid1',$data);
	}
	public function emailtesting()
	{
		$this->load->view('emailtesting');
	}
	public function searchusers()
	{
		$this->load->database();
		$this->load->model('Portalmodel');
		$string = $this->input->post('search',TRUE);
		$var['result'] = $this->Portalmodel->searchuser($string);
		$this->load->view('searchloader',$var);
	}
}