<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_Model {

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
	public function checklogin($username,$password)
	{
		$data = NULL;
		$where = array(
			"PK_users"=>$username,
			"password"=>md5($password)
		);
		$this->db->select("*");
		$this->db->from("users");
		$this->db->join("userdata","FK_userdata = PK_userdata");
		$this->db->where($where);
		$query = $this->db->get();
		if( $query->num_rows() == 1 )
		{
			foreach($query->result() as $rows)
			{
				$data["PK_users"] = $rows->PK_users;
				$data["firstname"] = $rows->firstname;
				$data["lastname"] = $rows->lastname;
				$data["fullname"] = $rows->firstname." ".$rows->lastname;
				$data["email"] = $rows->email;
				$data["address"] = $rows->address;
				$data["bdate"] = $rows->bdate;
				$data["loginnet"] = TRUE;
				$data["lastlogin"] = $rows->lastlogin;
			}
			
		}
		else
		{
			$where = array(
				"email"=>$username,
				"password"=>md5($password)
			);
			$this->db->select("*");
			$this->db->from("users");
			$this->db->join("userdata","FK_userdata = PK_userdata");
			$this->db->where($where);
			$query = $this->db->get();
			if($query->num_rows() == 1)
			{
				foreach($query->result() as $rows)
				{
					$data["PK_users"] = $rows->PK_users;
					$data["firstname"] = $rows->firstname;
					$data["lastname"] = $rows->lastname;
					$data["fullname"] = $rows->firstname." ".$rows->lastname;
					$data["email"] = $rows->email;
					$data["address"] = $rows->address;
					$data["bdate"] = $rows->bdate;
					$data["loginnet"] = TRUE;
					$data["lastlogin"] = $rows->lastlogin;
				}
				print_r($data);
			}
			else
			{
				$this->db->select('PK_userdata, (SELECT `PK_users` FROM `users` WHERE `FK_userdata` = `PK_userdata`) as PK_users');
				$this->db->from('userdata');
				$this->db->where('email',$username);
				//$this->db->where("(SELECT password FROM oldpass WHERE FK_users = PK_userdata) = $password");
				$query = $this->db->get();
				if($query->num_rows() == 1)
				{
					$FK_usersoldpass = $query->row()->PK_users;
					$this->db->select('datetime');
					$this->db->from('oldpass');
					$this->db->where(array('FK_users'=>$FK_usersoldpass,'password'=>md5($password)));
					$query2 = $this->db->get();
					if($query2->num_rows() == 1)
					{
						$data['oldpass'] = TRUE;
						$data['PK_users'] = $query->row('PK_users');
						$data['datetime'] = $query2->row('datetime');
						return $data;
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
		}
		return $data;
	}
	public function createdb()
	{
		$query = $this->db->query('CREATE DATABASE networking2');
		//$query = "";
		if(!$query)
		{
			//$sql = file_get_contents(base_url().'newdb.sql');
			//$query = $this->db->query('USE networking2');
		}
	}
}