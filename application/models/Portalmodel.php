<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portalmodel extends CI_Model {

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
				//echo $total;
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
					"others"=>$row->others,
					"percent1"=>$row->percent1,
					"percent2"=>$row->percent2,
					"percent3"=>$row->percent3
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
					"others"=>$row->others,
					"percent1"=>$row->percent1,
					"percent2"=>$row->percent2,
					"percent3"=>$row->percent3
				);
				return $data;
			}
		}
		else
		{
			return FALSE;
		}
	}
	public function getallencashments($PK_users)
	{
		$this->db->select('*,(SELECT description FROM encashstatus WHERE PK_encashstatus = FK_encashstatus) as status, (SELECT description FROM encashtype WHERE PK_encashtype = FK_encashtype) as type');
		$this->db->from('encashments');
		
		$this->db->where('FK_users',$PK_users);
		$query = $this->db->get();
		if($query->num_rows() >= 1) return $query->result_array();
		else return FALSE;
	}
	public function gettotalencashments($PK_users)
	{
		$this->db->select('FK_users,sum(amount) as amount');
		$this->db->from('encashments');
		$this->db->where('FK_users',$PK_users);
		$this->db->group_by('FK_users');
		$query = $this->db->get();
		if($query->num_rows() >= 1) return $query->row('amount');
		else return "0";
	}
	public function getallencashtype()
	{
		$this->db->select('*');
		$this->db->from('encashtype');
		$this->db->where('active','1');
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			foreach($query->result() as $rows)
			{
				$data[$rows->PK_encashtype] = $rows->description;
			}
			return $data;
		}
		else return FALSE;
	}
	public function addencashment($forexcode,$forextype,$amount,$FK_users)
	{
		$data = array(
			'FK_forexcode'=>$forexcode,
			'FK_encashtype'=>$forextype,
			'amount'=>$amount,
			'FK_encashstatus'=>'1000',
			'datetime'=>date('Y-m-d h:i:s'),
			'FK_users'=>$FK_users
		);
		if($this->db->insert('encashments',$data)) return TRUE;
		else return FALSE;
			
	}
	public function getuserdata($PK)
	{
		//echo $PK;
		$this->db->select('a.FK_users,a.sponsorid,a.uplineid, b.firstname, b.lastname, b.email, b.contactno, b.address, b.bdate, b.gender');
		$this->db->from('regdetails a');
		$this->db->join('userdata b','b.PK_userdata = a.FK_users','INNER');
		$this->db->where('b.PK_userdata',$PK);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() == 1) return $query->result_array();
		else return false;
	}
	public function getfullname($PK)
	{
		$this->db->select("CONCAT(firstname,' ',lastname) as fullname");
		$this->db->from('userdata');
		$this->db->where('PK_userdata',"$PK");
		$query = $this->db->get();
		if($query->num_rows() == 1) return $query->row('fullname');
		else return "Not Applicable";
	}
	public function getleveldesc($total,$totalmembers)
	{
		$this->db->select('*');
		$this->db->from('matrix');
		if($total < 4)
		{
			$this->db->where("$total between min AND max",NULL,FALSE);
			$query = $this->db->get();
			if($query->num_rows() == 1) return array('description'=>$query->row('description'),'equivamount'=>$query->row('equivamount'),'equivamount1'=>$query->row('equivamount1'));
			else return FALSE;
		}
		else
		{
			$this->db->where("$totalmembers between min AND max",NULL,FALSE);
			$query = $this->db->get();
			if($query->num_rows() == 1) return array('description'=>$query->row('description'),'equivamount'=>$query->row('equivamount'),'equivamount1'=>$query->row('equivamount1'));
			else return FALSE;
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
	public function getalldirectupline($PK)
	{
		$this->db->select('*');
		$this->db->from('regdetails');
		$this->db->where('uplineid',$PK);
		$query = $this->db->get();
		if($query->num_rows() >= 1) return $query->num_rows();
		else return 0;
	}
	
	public function nestedviewbyPK($FK_users,$string,$fullname)
	{
		static $string;
		static $test2 = 1;
		static $counter3 = 0;
		static $check = 0;
		static $num_rows;
		static $num_rows2;
		static $num_rows3;
		static $num_rows4;
	
		if($test2 < 4)
		{
			$this->db->select("PK_regdetails,FK_users,(SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
			$this->db->from('regdetails');
			$this->db->where('uplineid',"$FK_users");
			$query = $this->db->get();
			$imgurl = base_url()."css/img/userpic.png";
			$string .= "
			<li value=\"$FK_users\" ref=\"$fullname\" >
				<a>
					<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
					<div class=\"pyramiddesc\">PHL | $FK_users</div>
					<div class=\"pyramidfullname\">".$fullname."</div>
				</a>";
				
			
			if($query->num_rows() >= 1)
			{
				if($test2 == 1) 
				{
					$num_rows = 4 - $query->num_rows();
					$num_rows3 = $FK_users;
				}
				else if($test2 == 2)
				{	
					$num_rows2 = 4 - $query->num_rows();	
				}
				else if($test2 == 3)
				{	
					$num_rows4 = 4 - $query->num_rows();	
				}
				if($test2 != 3) 
				{
					$string .= "<ul value1=\"FK_users\" ref=\"$test2\">
					";
					$check = 1;
				}
				$len = count($query->result());
				$i=0;
				foreach($query->result() as $rows)
				{
					$temp2 = $num_rows;
					
					if($i == $len-1) 
					{
						$test2++;
						$this->nestedviewbyPK($rows->FK_users,$string,$rows->fullname);	
						if($test2 == 3) 
						{
							if($num_rows2 != 3) $string .= "</ul class=\"$num_rows2 $test2\">";
							$temp2 = $num_rows;
							while($num_rows != 0 && $num_rows4 != 0 )
							{
								$string .= "
								<li value=\"$FK_users\" ref=\"$fullname\" >
									<a>
										<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
										<div class=\"pyramiddesc\">----</div>
										<div class=\"pyramidfullname\">----</div>
									</a>
								</li>
								";
								
								$num_rows--;
							}
							//$string .= "</li>";
							$num_rows = $temp2;
						}
						else if($test2 == 2)
						{
							while($num_rows != 0)
							{
								$string .= "
										<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
											<a>
												<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
												<div class=\"pyramiddesc\">sad</div>
												<div class=\"pyramidfullname\">----</div>
											</a>
											";
								if($num_rows4 != 0) $string .= "<ul>";
								$counter = 4;
								while($counter != 0 & $num_rows4 != 0)
									{
										$string .= "
										<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
											<a>
												<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
												<div class=\"pyramiddesc\">sad</div>
												<div class=\"pyramidfullname\">----</div>
											</a>
										</li>
										";
										$counter--;
									}
								$string .= "</li>";
								
								//else $string .= "</li>";
								$num_rows--;
							}
							if($num_rows4 == 0 ) $string .= "</ul>";
						}
					}
					else if($i == 0)
					{
						if($counter3 == 0)
						{
							$test2++;
						}
						$this->nestedviewbyPK($rows->FK_users,$string,$rows->fullname);
						if($counter3 == 0)
						{
							$test2--;
							$counter3++;
							$temp = $num_rows2;
							while($num_rows2 != 0)
							{
								
								$string .= "
									<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
										<a>
											<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
											<div class=\"pyramiddesc\">---</div>
											<div class=\"pyramidfullname\">----</div>
										</a></li>
									";
								
								$num_rows2--;
							}
							if($temp == 3 && $test2 == 2)$string .= "</ul>";
						}
					}
					else 
					{
						$this->nestedviewbyPK($rows->FK_users,$string,$num_rows2);
					}
				}
				$i++;
				
				if($check != 1) $string .= "</ul class=\"$test2\">
				";	
				
			}
			
			if($test2 == 2 && $FK_users != $num_rows3 && $query->num_rows() == 0 && $num_rows4 != 0)
			{
				$counter = 4;
				$string .= "<ul>";
				while($counter != 0)
				{
					$string .= "
						<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
						<a>
							<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
							<div class=\"pyramiddesc\">----</div>
							<div class=\"pyramidfullname\">----</div>
						</a>
					</li>
					";
					$counter--;
				}
				$string .= "</ul>";					
			}
			if($test2 == 1 && $query->num_rows() == 0)
			{
				$counter = 4;
				$string .= "<ul>";
				while($counter != 0)
				{
					$string .= "
						<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
						<a>
							<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
							<div class=\"pyramiddesc\">----</div>
							<div class=\"pyramidfullname\">----</div>
						</a>
					
					<ul>
					";
					$counter1 = 4;
					while($counter1 != 0)
					{
						$string .= "
							<li value=\"$FK_users\" ref=\"$fullname\" class=\"$num_rows2 $test2\">
							<a>
								<div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div>
								<div class=\"pyramiddesc\">----</div>
								<div class=\"pyramidfullname\">----</div>
							</a></li>";
						
						$counter1--;
					}
					$string .= "</ul></li>";
					$counter--;
				}
				$string .= "</ul>";			
			}
			
		
			$string .= "</li class=\"$test2\" value=\"$num_rows2\" id=\"emman\">
			";
		
			return $string;
		}
	}
	public function nestedarraybyPK($FK_users,$string,$fullname)
	{
		static $string = array();
		static $test2 = 1;
		static $counter3 = 0;
		static $check = 0;
		static $num_rows;
		static $num_rows2;
		static $num_rows3;
		if($test2 < 4)
		{
			$this->db->select("PK_regdetails,FK_users,(SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
			$this->db->from('regdetails');
			$this->db->where('uplineid',"$FK_users");
			$query = $this->db->get();
			$imgurl = base_url()."css/img/userpic.png";
			
			array_push($string, array('FK_users'=>$FK_users,'fullname'=>$fullname));
				
			if($test2 == 1) 
			{
				$num_rows = 4 - $query->num_rows();
				$num_rows3 = $FK_users;
			}
			else if($test2 == 2)
			{	
				$num_rows2 = 4 - $query->num_rows();
				
			}
			if($query->num_rows() >= 1)
			{
				
				if($test2 != 3) 
				{
					
					$check = 1;
				}
				$len = count($query->result());
				$i=0;
				foreach($query->result() as $rows)
				{
					$temp2 = $num_rows;
					
					if($i == $len-1) 
					{
						$test2++;
						$this->nestedarraybyPK($rows->FK_users,$string,$rows->fullname);	
						if($test2 == 3) 
						{
							
							$temp2 = $num_rows;
							while($num_rows != 0)
							{
								array_push($string, array('FK_users'=>'----','fullname'=>'----'));
								$counter = 4;
								while($counter != 0)
								{
									array_push($string, array('FK_users'=>'----','fullname'=>'----'));
									$counter--;
								}
								$num_rows--;
							}
							$num_rows = $temp2;
						}
						else if($test2 == 2)
						{
							while($num_rows != 0)
							{
								array_push($string, array('FK_users'=>'----','fullname'=>'----'));
								$counter = 4;
								while($counter != 0)
									{
										array_push($string, array('FK_users'=>'----','fullname'=>'----'));
										$counter--;
									}
								$num_rows--;
							}
						}
					}
					else if($i == 0)
					{
						if($counter3 == 0)
						{
							$test2++;
						}
						$this->nestedarraybyPK($rows->FK_users,$string,$rows->fullname);
						if($counter3 == 0)
						{
							$test2--;
							$counter3++;
							$temp = $num_rows2;
							while($num_rows2 != 0)
							{
								
								array_push($string, array('FK_users'=>'----','fullname'=>'----'));
								$num_rows2--;
							}
							if($temp == 3 && $test2 == 2)$string .= "</ul>";
						}
					}
					else 
					{
						$this->nestedarraybyPK($rows->FK_users,$string,$num_rows2);
					}
				}
				$i++;
				
				
				
			}
			
			if($test2 == 2 && $FK_users != $num_rows3 && $query->num_rows() == 0)
			{
				$counter = 4;
				while($counter != 0)
				{
					array_push($string, array('FK_users'=>'----','fullname'=>'----'));
					$counter--;
				}			
			}
			if($test2 == 1 && $query->num_rows() == 0)
			{
				$counter = 4;
				while($counter != 0)
				{
					array_push($string, array('FK_users'=>'----','fullname'=>'----'));
					$counter1 = 4;
					while($counter1 != 0)
					{
						array_push($string, array('FK_users'=>'----','fullname'=>'----'));
						$counter1--;
					}
					$counter--;
				}
			}
			array_push($string, array('FK_users'=>'----','fullname'=>'----'));
		
			return $string;
		}
	}
	public function getsponsornamebyPK($FK_users)
	{
		$this->db->select('*');
		$this->db->from('regdetails');
		$this->db->where('FK_users',$FK_users);
		$query = $this->db->get();
		if($query->num_rows() == 1) return $this->getfullname($query->row('sponsorid'));
		else return "Not Applicable";
	}
	public function nestedarraybyPK2($FK_users,$fullname)
	{
		$string = array();
		$this->db->select("FK_users, uplineid, sponsorid, (SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
		$this->db->from('regdetails');
		$this->db->where('uplineid',$FK_users);
		$query = $this->db->get();
		$total = $this->getalldirectupline($FK_users); 
		$totalmembers = $this->repeatgetupline($FK_users,0,0);
		$desc = $this->getleveldesc($total,$totalmembers);
		array_push($string, array('FK_users'=>$FK_users,'fullname'=>$fullname,'level'=>$desc['description'],'sponsorname'=>$this->getsponsornamebyPK($FK_users),'total'=>$total,'diff'=>'0','totalmembers'=>$totalmembers));
		$diff = $totalmembers;

		if($query->num_rows() >= 1):
			$num_rows = 4 - $query->num_rows();
			$temp = $num_rows;
			foreach($query->result() as $rows):
				$total = $this->getalldirectupline($rows->FK_users); 
				$totalmembers = $this->repeatgetupline($rows->FK_users,0,0) - $diff;
				$totalmembers1 = $totalmembers;
				$desc = $this->getleveldesc($total,$totalmembers);
				array_push($string, array('FK_users'=>$rows->FK_users,'fullname'=>$rows->fullname,'level'=>$desc['description'],'sponsorname'=>$this->getfullname($rows->sponsorid),'total'=>$total,'diff'=>$diff,'totalmembers'=>$totalmembers));
				$diff += $totalmembers1;
			endforeach;
			while($num_rows != 0):
				array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
				$num_rows--;
			endwhile;
			foreach($query->result() as $rows):
				$this->db->select("FK_users, uplineid, sponsorid, (SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
				$this->db->from('regdetails');
				$this->db->where('uplineid',$rows->FK_users);
				$query2 = $this->db->get();
				$num_rows2 = 4 - $query2->num_rows();
				if($query2->num_rows() >= 1):
					foreach($query2->result() as $rows2):
						$total = $this->getalldirectupline($rows2->FK_users); 
						$totalmembers = $this->repeatgetupline($rows2->FK_users,0,0) - $diff;
						$totalmembers1 = $totalmembers;
						$desc = $this->getleveldesc($total,$totalmembers);
						array_push($string, array('FK_users'=>$rows2->FK_users,'fullname'=>$rows2->fullname,'level'=>$desc['description'],'sponsorname'=>$this->getfullname($rows2->sponsorid),'total'=>$total,'diff'=>$diff,'totalmembers'=>$totalmembers));
						$diff += $totalmembers1;
					endforeach;
					while($num_rows2 != 0):
						array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
						$num_rows2--;
					endwhile;
				else:
					while($num_rows2 != 0):
						array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
						$num_rows2--;
					endwhile;
				endif;
			endforeach;
			$num_rows = $temp;
			while($temp != 0):
				$counter = 4;
				while($counter != 0):
					array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
					$counter--;
				endwhile;
				$temp--;
			endwhile;
		else:
			$counter = 4;
			while($counter != 0):
				array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
				$counter2 = 4;
				while($counter2 != 0):
					array_push($string, array('FK_users'=>"----",'fullname'=>"----",'level'=>"----",'sponsorname'=>"----",'total'=>"----",'diff'=>"----",'totalmembers'=>"----"));
					$counter2--;
				endwhile;
				$counter--;
			endwhile;
		endif;
		return $string;
	}
	public function nestedviewbyPKemman($FK_users, $fullname)
	{
		$string = "";
		if(file_exists("css/uploads/$FK_users.jpg") !== false) $imgurl = base_url()."css/uploads/$FK_users.jpg";
		else if(file_exists("css/uploads/$FK_users.png") !== false) $imgurl = base_url()."css/uploads/$FK_users..png";
		else if(file_exists("css/uploads/$FK_users.gif") !== false) $imgurl = base_url()."css/uploads/$FK_users.gif";
		else $imgurl = base_url()."css/img/userpic.png";
		$this->db->select("FK_users, uplineid, sponsorid, (SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
		$this->db->from('regdetails');
		$this->db->where('uplineid',$FK_users);
		$query = $this->db->get();
		$string .= "<ul><li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">PHL | $FK_users</div><div class=\"pyramidfullname\">$fullname</div></a><ul>";
		if($query->num_rows() >= 1):
			$num_rows = 4 - $query->num_rows();
			foreach($query->result() as $rows):
				$FK_users = $rows->FK_users;
				if(file_exists("css/uploads/$FK_users.jpg") !== false) $imgurl = base_url()."css/uploads/$FK_users.jpg";
				else if(file_exists("css/uploads/$FK_users.png") !== false) $imgurl = base_url()."css/uploads/$FK_users..png";
				else if(file_exists("css/uploads/$FK_users.gif") !== false) $imgurl = base_url()."css/uploads/$FK_users.gif";
				else $imgurl = base_url()."css/img/userpic.png";
				$string .= "<li class=\"second\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">PHL | ".$rows->FK_users."</div><div class=\"pyramidfullname\">".$rows->fullname."</div></a>";
				$this->db->select("FK_users, uplineid, sponsorid, (SELECT CONCAT(firstname,' ',lastname) FROM userdata WHERE PK_userdata = FK_users) as fullname");
				$this->db->from('regdetails');
				$this->db->where('uplineid',$rows->FK_users);
				$query2 = $this->db->get();
				$num_rows2 = 4 - $query2->num_rows();
				if($query2->num_rows() >= 1):
					
					$string .= "<ul>";
					foreach($query2->result() as $rows2)
					{
						$FK_users = $rows2->FK_users;
						if(file_exists("css/uploads/$FK_users.jpg") !== false) $imgurl = base_url()."css/uploads/$FK_users.jpg";
						else if(file_exists("css/uploads/$FK_users.png") !== false) $imgurl = base_url()."css/uploads/$FK_users..png";
						else if(file_exists("css/uploads/$FK_users.gif") !== false) $imgurl = base_url()."css/uploads/$FK_users.gif";
						else $imgurl = base_url()."css/img/userpic.png";
						$string .= "<li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">PHL | ".$rows2->FK_users."</div><div class=\"pyramidfullname\">".$rows2->fullname."</div></a></li>";
					}
					while($num_rows2 != 0):
						$string .= "<li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a></li>";
						$num_rows2--;
					endwhile;
					$string .= "</ul>";
				else:
					$string .= "<ul>";
					while($num_rows2 != 0):
						$string .= "<li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a></li>";
						$num_rows2--;
					endwhile;
					$string .= "</ul>";
				endif;
				$string .= "</li>";
			endforeach;
			
			while($num_rows != 0):
				$string .= "<li class=\"second\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a><ul>";
				$counter = 4;
				while($counter != 0):
					$string .= "<li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a></li>";
					$counter--;
				endwhile;
				$num_rows--;
				$string .= "</ul></li>";
			endwhile;
		else:
			$counter = 4;
			while($counter !=0):
				$string .= "<li class=\"second\"><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a><ul>";
				$counter2 = 4;
				while($counter2 != 0):
					$string .= "<li><a><div class=\"userwrapper\"><img src=\"$imgurl\" id=\"imguserpic\" /></div><div class=\"pyramiddesc\">----</div><div class=\"pyramidfullname\">----</div></a></li>";
					$counter2--;
				endwhile;
				$counter--;
				$string .= "</ul></li>";
			endwhile;
		endif;
		$string .= "</ul></li></ul>";
		return $string;
	}
	public function searchuser($searchstring)
	{
		$this->db->select('*');
		$this->db->from('users a');
		$this->db->join('userdata b','a.PK_users = b.PK_userdata','INNER');
		$this->db->like('PK_users',$searchstring);
		$this->db->or_like('b.lastname',$searchstring);
		$this->db->or_like('b.firstname',$searchstring);
		$this->db->or_like('b.firstname',$searchstring);
		$this->db->order_by('PK_users','DESC');
		$this->db->limit(10,0);
		$query = $this->db->get();
		if($query->num_rows() >= 1):
			return $query->result_array();
		else:
			return FALSE;
		endif;
	}
}