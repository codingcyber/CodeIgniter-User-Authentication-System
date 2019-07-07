<?php
/**
* 
*/
class User_model extends CI_Model
{
	
	public function insert_user($name, $email, $password){
		$query = $this->db->query("INSERT INTO users (username, email, password, active_key) VALUES ('$name', '$email', '$password', md5('$name'))");
	}

	public function login_user($username, $password){
		$query =$this->db->query("SELECT password FROM users WHERE username='$username' AND active=1");
		if($query->num_rows() == 1){
			$row = $query->row();
			if(password_verify($password, $row->password)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function get_user_info($username){
		$query =$this->db->query("SELECT id,username,email FROM users WHERE username='$username'");
		if($query->num_rows() == 1){
			$userinfo = $query->result_array();
			return $userinfo;
		}

	}

	public function check_username($username){
		$query = $this->db->query("SELECT * FROM users WHERE username='$username'");
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	public function reset_key($username){
		$this->db->query("UPDATE users SET reset_key=md5('$username') WHERE username='$username'");
	}

	public function check_reset_key($key, $getmail=0){
		$query = $this->db->query("SELECT email FROM users WHERE reset_key='$key'");
		if($getmail == 0){
			//return true or flase
			if($query->num_rows() == 1){
				return true;
			}else{
				return false;
			}
		}elseif($getmail == 1){
			//return email
			$row = $query->row();
			return $row->email;
		}
		
	}

	public function update_user_password($key, $password){
		$this->db->query("UPDATE users SET password='$password' WHERE reset_key='$key'");
		//update the key with empty value
		$this->db->query("UPDATE users SET reset_key='' WHERE reset_key='$key'");
	}

	public function get_user_email($username){
		$query = $this->db->query("SELECT email FROM users WHERE username='$username'");
		$row = $query->row();
		return $row->email;
	}


	public function check_active_key($key){
		$query = $this->db->query("SELECT * FROM users WHERE active_key='$key'");
		
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
		
	}

	public function activate_user_account($key){
		$this->db->query("UPDATE users SET active=1 WHERE active_key='$key'");
		$this->db->query("UPDATE users SET active_key='' WHERE active_key='$key'");
	}
}
?>