<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homemodel extends CI_Model {

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
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
	}
	public function getalluserdata($PK_users)
	{
		
		$this->db->select("PK_regdetails,FK_users");
		$this->db->from('regdetails');
		$this->db->where('uplineid',"$PK_users");
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			//$data["count"] = $query->num_rows();
			echo "<table border=1><tr>";
			foreach($query->result() as $rows)
			{
				$data[] = $rows->FK_users;
				echo "<td><b>".$rows->FK_users."</b></td>";
			}
			echo "</table><table border='1'>";
			foreach ($query->result() as $rows)
			{
				$this->db->select('FK_users');
				$this->db->from('regdetails');
				$this->db->where('FK_users',$rows->FK_users);
				$query2 = $this->db->get();
				if($query2->num_rows() >= 1)
				{
					foreach($query2->result() as $rows1)
					{
						echo $rows1->FK_users;
						$this->getuplinebyuser($rows1->FK_users);
					}
				}
			}
		}
	}
	public function getrecursivebyPK()
	{
		return $this->repeatgetupline('10000000000',0,0);
	}
	public function getcount($columnname, $PK,$total)
	{
		
		$this->db->select("$columnname, FK_users, (SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
		$this->db->from('regdetails');
		$this->db->where("$columnname","$PK");
		$query = $this->db->get();
		//echo $query->num_rows();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				if($total <> 0)
				{
					//echo $rows->FK_users."<br/>";
					//echo $this->repeatgetupline($rows->FK_users,NULL,0)."<br />";
					$difference = $this->repeatgetupline($rows->FK_users,NULL,0) - $total;
					$allcount = $this->allcount($difference,$rows->FK_users);
					//$allcount['description'];
					$counter=NULL;
					//echo $rows->FK_users;
					$data[] = array(
						"FK_users"=>$rows->FK_users,
						"fullname"=>$rows->fullname,
						"noofmember"=>$difference,
						"lvldesc"=>$allcount['description']
					);
					
					$last = $this->repeatgetupline($rows->FK_users,NULL,0);
					$total = 0;
				}
				else
				{
					
					$difference = $this->repeatgetupline($rows->FK_users,NULL,0) - $last;
					$allcount = $this->allcount($difference,$rows->FK_users);
					$data[] = array(
						"FK_users"=>$rows->FK_users,
						"fullname"=>$rows->fullname,
						"noofmember"=>$difference,
						"lvldesc"=>$allcount['description']
					);
					$last = $this->repeatgetupline($rows->FK_users,NULL,0);
				}
			}
		}
		else
		{
			$data = FALSE;
		}
		return $data;
	}
	public function getnextlevelstats($total)
	{
		$total = $this->db->escape($total); 
		$query = $this->db->query("SELECT `min`,`max` FROM `matrix` WHERE $total >= `min` AND $total <= `max`");
		if($query->num_rows() == 1)
		{
			$data["max"] = $query->row()->max;
			$data["min"] = $query->row()->min;
		}
		else
		{
			$data = FALSE;
		}
		return $data;
	}
	public function repeatgetupline($FK_users,$counter,$check)
	{
		static $counter = 0;
		$this->db->select("PK_regdetails,FK_users");
		$this->db->from('regdetails');
		$this->db->where('uplineid',"$FK_users");
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			
			foreach($query->result() as $rows)
			{
				$counter++;
				$this->db->select('PK_regdetails,FK_users');
				$this->db->from('regdetails');
				$this->db->where('uplineid',$rows->FK_users);
				$query2 = $this->db->get();
				if($query->num_rows() >= 1)
				{
					$this->repeatgetupline($rows->FK_users,$counter,0);
				}
			}
		}
		return $counter;
	}
	public function gettotalupline($FK_users)
	{
		$this->db->select('a.FK_users,count(b.FK_users) as directmember');
		$this->db->from('regdetails a');
		$this->db->join('regdetails b','a.FK_users = b.uplineid','inner');
		$this->db->where('a.FK_users',$FK_users);
		$query = $this->db->get();
		//echo $query->row('directmember');
		if($query->row('directmember') < 4)
		{
			return $query->row('directmember');
		}
		else
		{
			return $this->repeatgetupline($FK_users,0,0);
		}
		
	}
	public function getlastlogin($PK)
	{
		$this->db->select('lastlogin');
		$this->db->from('users');
		$this->db->where('PK_users',"$PK");
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->lastlogin;
		}
		else
		{
			return FALSE;
		}
	}
	public function getlastchangepass($PK)
	{
		$this->db->select('datetime');
		$this->db->from('oldpass');
		$this->db->where('FK_users',"$PK");
		$this->db->order_by('datetime','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() >= 1)
		{
			return $query->row()->datetime;
		}
		else
		{
			return FALSE;
		}
	}
	public function getpersonaldata($PK)
	{
		$this->db->select('*');
		$this->db->from('userdata');
		$this->db->where('PK_userdata',"$PK");
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			foreach($query->result() as $rows)
			{
				$data = array(
					"PK_userdata"=>$rows->PK_userdata,
					"firstname"=>$rows->firstname,
					"lastname"=>$rows->lastname,
					"email"=>$rows->email,
					"contactno"=>$rows->contactno,
					"address"=>$rows->address,
					"bdate"=>$rows->bdate,
					"gender"=>$rows->gender
				);
			}
			return $data;
		}
		else
		{
			return false;
		}
	}
	public function checkemail($PK,$email)
	{
		
		$this->db->select('email');
		$this->db->from('userdata');
		$this->db->where('PK_userdata !=',$PK);
		$this->db->where('email',$email);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//echo $query->num_rows();
		if($query->num_rows() == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function bankaccounts($FK_users)
	{
		$this->db->select('*');
		$this->db->from('bankaccounts');
		$this->db->where('FK_users',"$FK_users");
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
					"PK_bankaccounts"=>$rows->PK_bankaccounts,
					"FK_users"=>$rows->PK_bankaccounts,
					"accountname"=>$rows->accountname,
					"accountno"=>$rows->accountno
				);
			}
		}
		else
		{
			$data =FALSE;
		}
		return $data;
	}
	public function updatedata($PK,$email,$firstname,$lastname,$address,$contactno,$bdate,$gender,$bankname,$accountno)
	{
		//print_r($accountno);
		if(isset($bankname))
		{
			foreach($bankname as $key => $value)
			{
				if($bankname !== "Name" && $bankname !== "" && $bankname !== " ")
				{
					if($accountno[$key] !== "Account No" && $accountno[$key] !== "" && $accountno[$key] !== " ")
					{
						$account = $accountno[$key];
						$where = array(
							"accountname"=>$value,
							"accountno"=>$account,
							"FK_users"=>$PK,
						);
						$this->db->select("PK_bankaccounts");
						$this->db->from("bankaccounts");
						$this->db->where($where);
						$query = $this->db->get();
						if($query->num_rows() == 0)
						{
							$this->db->insert("bankaccounts",$where);
							$this->db->last_query();
						}
			
					}		
				}
				//echo $this->db->last_query();
			}
		}
		$data = array(
			'email'=>$email,
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'address'=>$address,
			'contactno'=>$contactno,
			'bdate'=>$bdate,
			'gender'=>$gender
		);
		$where = array(
			'PK_userdata'=>$PK
		);
		if($this->db->update('userdata',$data,$where))
		{
			return TRUE;
			
		}
		else
		{
			return FALSE;
		}
	}
	public function allcount($total,$FK_users)
	{
		$total = $this->db->escape($total); 
		$query = $this->db->query("SELECT * FROM matrix WHERE $total between min and max");
		$row = $query->row();
		
		if($query->num_rows() == 1)
		{
			
			$this->db->select('a.FK_users,count(b.FK_users) as directmember');
			$this->db->from('regdetails a');
			$this->db->join('regdetails b','a.FK_users = b.uplineid','inner');
			$this->db->where('a.FK_users',$FK_users);
			$query = $this->db->get();
			if($query->row('directmember') == 4)
			{
				//echo "pasok";
				$data = array(
					"description"=>$row->description,
					"memberamount"=>$row->equivamount,
					"serviceamount"=>$row->equivamount1,
					"property"=>$row->property,
					"cash"=>$row->cash,
					"holiday"=>$row->holiday,
					"charity"=>$row->charity,
					"car"=>$row->car,
					"others"=>$row->others
				);
				return $data;
			}
			else
			{
				$total = $query->num_rows();
				$query = $this->db->query("SELECT * FROM matrix WHERE $total between min and max");
				$row = $query->row();
				$data = array(
					"description"=>$row->description,
					"memberamount"=>$row->equivamount,
					"serviceamount"=>$row->equivamount1,
					"property"=>$row->property,
					"cash"=>$row->cash,
					"holiday"=>$row->holiday,
					"charity"=>$row->charity,
					"car"=>$row->car,
					"others"=>$row->others
				);
				return $data;
			}
		}
		else
		{
			return FALSE;
		}
	}
	public function getpass($PK,$password)
	{
		$password = md5($password);
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('PK_users',"$PK");
		$this->db->where('password',"$password");
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
	public function updatepass($PK,$oldpass,$newpass)
	{
		$auditoldpass = array(
			'password'=>md5($oldpass),
			'FK_users'=>$PK,
			'datetime'=>date("Y-m-d H:i:s")
		);
		$newpass = array(
			'password'=>md5($newpass)
		);
		$where = array(
			'PK_users'=>$PK
		);
		if($this->db->insert('oldpass',$auditoldpass))
		{
			
			$fullname = $this->session->userdata('firstname')." ".$this->session->userdata('lastname');
			$email = $this->session->userdata('email');
			if($this->db->update('users',$newpass,$where))
			{
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => '465',
					'smtp_user' => 'emmanarrazola@gmail.com', // change it to yours
					'smtp_pass' => '110112Juliebee', // change it to yours
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE,
					'crlf' => "\r\n",
					'newline' => "\r\n"
				);
				$image = base_url().'css/img/companylogo2.png';
				$data = "<img height=\"70px\" src=\"".$image."\">";
				$emailmsg = "
				<html>
				<head>
				</head>
				<body style='margin:50px 150px 50px 150px;padding;0;'>
					<div style='background-color:#ededed;width:100%;height:580px;'>
						<div id='upmessages' style='font-family:\"Segoe UI\";line-height:15px;width:95%;margin:0px auto 20px auto;padding-top:10px;'>
							This email is provided exclusively to World Wealth registered users. <br/>If you no longer wish to receive emails from World Wealth, please unsubscribe.
						</div>
						<div id='containerty' style='height:500px;width:95%;background-color:#ffffff;box-shadow:0px -5px 20px -10px;margin:auto;'>
							
							<div id='headerreg' style='background-color:#FFFFFF;height:100px;border-bottom:1px solid silver;width:95%;margin:auto;'>
								<div id='headerwrapreg' style='height:100px;width:100%;margin:auto;'>
									<div class='webnamewrapreg' style='background-color:#FFFFFF;margin:auto;width:250px;'>
										<div class='webnamereg' style='padding-top:20px;font-size:25px;font-family:arial;'>$data</div>
									</div>
								</div>
							</div>
							<div id='wrappermsg' style='margin:50px auto;width:90%;'>
								<div class='msg' style='text-align:left;font-family:\"Segoe UI\";color:gray;font-weight:300;'>
									FULLNAME ,<br /><br /> 
									Your account has been modified. <br/>
									If you don't know this activity, Please refer to this link. <br/><br /> 
									http://somewebpage.com/token=abcde12345 <br /><br /> 
									WorldWealth Administrator,<br />
									Harry Alanunay
								</div>
							</div>
							<div id='footer' style='border-top:1px solid silver;width:95%;margin:auto;text-align:center;font-family:\"Segoe UI\"'>
								World Wealth - Property Investments and Leisures<br/>
								Bldg 22-101 Vitas, Tondo, Manila
							</div>
						</div>
					</div>
				</body>
				</html>";
				
				$this->load->library('email', $config);
				//$this->email->set_newline("\r\n");
				//$this->email->from('no-reply@worldwealth.com'); // change it to yours
				//$this->email->to("$email");// change it to yours
				//$this->email->subject('Your account has been modified');
				//$this->email->message($emailmsg);
				//if($this->email->send())
				//{
					return TRUE;
				//}
				//else
				//{
					//show_error($this->email->print_debugger());
					//return FALSE;
				//}
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	public function insertlastlogin($PK)
	{
		if($this->db->update('users',array("lastlogin"=>date("Y-m-d H:i:s")),array('PK_users'=>$PK)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function nestedview($FK_users,$counter,$margin)
	{
		
		$this->db->select("PK_regdetails,FK_users");
		$this->db->from('regdetails');
		$this->db->where('uplineid',"$FK_users");
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			echo "<ul>";
			foreach($query->result() as $rows)
			{
				if($margin=='1')
				{					
					echo "<li><a>".$rows->FK_users."</a></li>";
				}
				else
				{
					echo "<li><a>".$rows->FK_users."</a></li>";
				}
				$this->db->select('PK_regdetails,FK_users');
				$this->db->from('regdetails');
				$this->db->where('uplineid',$rows->FK_users);
				$query2 = $this->db->get();
				if($query2->num_rows() >= 1)
				{
					echo "<ul>";
					foreach($query2->result() as $rows)
					{
						if($margin == '1')
						{
							echo "<li><a>".$rows->FK_users."</a></li>";
						}
						else
						{
							echo "<li id='longer'><a>".$rows->FK_users."</a></li>";
						}
						$this->nestedview($rows->FK_users,$counter,'1');
					}
					if($margin == '1') echo "</li>";
					echo "</ul>";
				}
			}
			echo "</ul>";
		}
	}
	public function getfullname($PK)
	{
		$this->db->select("CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->where('PK_userdata',"$PK");
		$query = $this->db->get();
		return $query->row('fullname');
	}
	public function nestedviewtest($FK_users,$string,$fullname)
	{
		//static $fullname;
		static $string;
		//static $fullname;
		//echo $FK_users;
		//$FK_users = $this->db->escape($FK_users);
		$this->db->select("PK_regdetails,FK_users,(SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
		$this->db->from('regdetails');
		$this->db->where('uplineid',"$FK_users");
		$query = $this->db->get();
		if($fullname == "Cherry Politics") $var = "id=\"testid\"";
		else $var = "";
		$string .= "<li value=\"$FK_users\" ref=\"$fullname\" $var><a>".$fullname."</a>";
		if($query->num_rows() >= 1)
		{
			$string .= "<ul value1=\"FK_users\">";
			foreach($query->result() as $rows)
			{
				$this->nestedviewtest($rows->FK_users,$string,$rows->fullname);
			}
			$string .= "</ul>";
		}
		$string .= "</li>";
		return $string;
		//$fullname = NULL;
	}
	public function nestedviewbyPK($FK_users,$string,$fullname)
	{
		static $string;
		$test = count(debug_backtrace()); 
		
			$this->db->select("PK_regdetails,FK_users,(SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
			$this->db->from('regdetails');
			$this->db->where('uplineid',"$FK_users");
			$query = $this->db->get();
		
			$num_rows = 4 - $query->num_rows();
			
			$imgurl = base_url()."css/img/userpic.png";
			
			$string .= "<li value=\"$FK_users\" ref=\"$fullname\" ><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">PHL | $num_rows</div><div class=\"pyramidfullname\">".$fullname."</div></a>";
			if($query->num_rows() >= 1 && $test < 6)
			{
				$string .= "<ul value1=\"FK_users\">";
				foreach($query->result() as $rows)
				{
					$this->nestedviewbyPK($rows->FK_users,$string,$rows->fullname);
				}
				if($test > 4 && $num_rows < 4)
				{
					$diff = 0;
					while($diff != $num_rows)
					{
						
						$string .= "<li value=\"0\" ref=\"0\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">$test</div><div class=\"pyramidfullname\">----</div></a>";
						$diff++;	
					}
				}
				$string .= "</ul>";
			}
			else if($test < 6)
			{
				$string .= "<ul>";
				$counter2 = 0;
				while($counter2 != 4)
				{
					$string .= "<li value=\"0\" ref=\"0\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">$test</div><div class=\"pyramidfullname\">----</div></a>";
					//$this->nestedviewbyPK('1000000005',$string,'---');
					$counter2++;	
				}
				$string .= "</ul>";
			}
			while($num_rows < 3 && $num_rows != 4 && $test > 4)
			{
				$string .= "<li value=\"0\" ref=\"0\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">$test</div><div class=\"pyramidfullname\">----</div></a>";
				$string .= "<ul>";
				$counter = 1;
				while($counter != 5)
				{
					$string .= "<li value=\"0\" ref=\"0\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">$test</div><div class=\"pyramidfullname\">----</div></a>";
					//$this->nestedviewbyPK('1000000005',$string,'---');
					$counter++;	
				}
				$string .= "</ul>";
				$num_rows++;	
			}
			
		
			$string .= "</li>";
		return $string;
	}
	public function searchquery($keywords)
	{
		$keywords = $this->db->escape_like_str($keywords);
		$sql = "	SELECT PK_userdata, firstname, lastname, CONCAT(firstname,' ',lastname) as fullname FROM userdata
					WHERE 
						CONCAT(firstname,' ',lastname) LIKE '%$keywords%' OR 
						CONCAT(lastname,', ',firstname) LIKE '%$keywords%' OR
						CONCAT(lastname,' ',firstname) LIKE '%$keywords%' OR
						PK_userdata = '$keywords' LIMIT 10
				";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
					'PK_users'=>$rows->PK_userdata,
					'firstname'=>$rows->firstname,
					'lastname'=>$rows->lastname,
					'fullname'=>$rows->fullname
				);
			}
		}
		else
		{
			$data = FALSE;
		}
		return $data;
		//echo $query;
		//echo $this->db->last_query();
	}
	
	public function updatebankaccount($FK_users,$bankname,$accountno,$PK_accountno)
	{
		//print_r($PK_accountno);
		$count = 0;
		if(isset($bankname) && isset($accountno))
		{
			foreach($bankname as $key => $values)
			{
				$num = $accountno[$count];
				$PK = $PK_accountno[$count];
				$update = array(
					"accountname"=>$values,
					"accountno"=>$num,
				);
				
				//echo "UPDATE bankaccount SET bankname = $values, accountno = $num WHERE PK = $PK<br/>";
				$this->db->update("bankaccounts",$update,array("PK_bankaccounts"=>$PK));
				$count++;
			}
		}
		//$test = array(1,2);
		//$this->db->select('*');
		//$this->db->from('bankaccounts');
		$this->db->where_not_in('PK_bankaccounts',$PK_accountno);
		$this->db->where('FK_users',$FK_users);
		$this->db->delete('bankaccounts');
		//$this->db->get();
		//echo $this->db->last_query();
		
	}
}