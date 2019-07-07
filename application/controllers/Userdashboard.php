<?php
class UserDashboard extends CI_Controller{
	public function index(){
		
		if($this->session->login != 'true'){
			redirect('login');
		}else{
			var_dump($this->session->userdata());
			echo "<br> <a href='" . base_url('logout') ."'>Logout</a>";
		}
		
	}
}
?>