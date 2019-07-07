<?php
/**
* 
*/
class User extends CI_Controller
{
	
	public function index(){
		echo "index";
	}

	public function login(){
		if($this->session->login == 'true'){
			redirect('/');
		}
		//echo "login";
		$this->load->view('user/header');
		$this->load->view('user/login');
		$this->load->view('user/footer');
	}

	public function login_post(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('user_model', 'auth');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE)
            {
            	$this->login();
            }
            else
            {
            	$response_val = $this->auth->login_user($username, $password);
            	if($response_val == true){
            		$val = $this->auth->get_user_info($username);
            		$this->session->set_userdata($val[0]);
            		$this->session->set_userdata('login', 'true');
            		redirect('/');

            	}elseif($response_val == false){
            		$this->session->set_flashdata('login_info', '<div class="alert alert-danger">Login Failed, please check your account status.</div>');
            		//echo "failure message";
            		$this->login();
            	}
            }
	}

	public function reset(){
		$this->load->view('user/header');
		$this->load->view('user/reset');
		$this->load->view('user/footer');
	}

	public function reset_update(){
		$this->load->model('user_model', 'auth');
		$username =  $this->input->post('username');
		$response_val = $this->auth->check_username($username);
		$email = $this->auth->get_user_email($username);
		if($response_val){
			$this->auth->reset_key($username);
			$this->load->library('email');
			//configure smtp
			$config['protocol'] = 'smtp';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['smtp_host'] = 'smtp.sendgrid.net';
			$config['smtp_user'] = 'your-smtp-user-here';
			$config['smtp_pass'] = 'your-smtp-pass-here';
			$config['smtp_port'] = '587';

			$this->email->initialize($config);

			$this->email->from('noreply@codingcyber.com', 'Coding Cyber');
			$this->email->to($email);

			$this->email->subject('Reset Password for : ' . $username);
			$reset_url = site_url('verify/'.md5($username));
			$body = "<p> Reset Your Password</p>";
			$body .= "<a href='$reset_url'> Click Here to Reset</a>";
			$this->email->message($body);

			$this->email->send();
			$this->session->set_flashdata('login_info', '<div class="alert alert-success">Reset Email Sent, Please check your Email for furthur instructions.</div>');
            redirect('login');
			
		}else{
			$this->session->set_flashdata('reset_info', '<div class="alert alert-danger">User Name not found in DB.</div>');
            redirect('reset');
		}
	}

	public function register(){
		if($this->session->login == 'true'){
			redirect('/');
		}
		//echo "register";
		$this->load->model('user_model', 'auth');
		$this->load->view('user/header');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|alpha_numeric');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('passwordagain', 'Password Confirmation', 'trim|required|matches[password]');
		
		//$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

                if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('user/register');
                }
                else
                {
                	$name = $this->input->post('username');
					$email =  $this->input->post('email');
					$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

					$this->auth->insert_user($name, $email, $password);
					$this->session->set_flashdata('register_info', '<div class="alert alert-success">User Registered Successfully, Activate Your Account</div>');

					$this->load->library('email');
					//configure smtp
					$config['protocol'] = 'smtp';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$config['smtp_host'] = 'smtp.sendgrid.net';
					$config['smtp_user'] = 'your-smtp-user-here';
					$config['smtp_pass'] = 'your-smtp-pass-here';
					$config['smtp_port'] = '587';

					$this->email->initialize($config);

					$this->email->from('noreply@codingcyber.com', 'Coding Cyber');
					$this->email->to($email);

					$this->email->subject('Activate Your Account : ' . $name);
					$activate_url = site_url('activate/'.md5($name));
					$body = "<p> Activate Your Account</p>";
					$body .= "<a href='$activate_url'> Click Here to Activate</a>";
					$this->email->message($body);

					$this->email->send();
					$this->email->print_debugger(array('headers'));
					redirect('register');
                }
		//$this->load->view('user/register');
		$this->load->view('user/footer');
	}

	public function register_post(){
		echo "register post";
		echo $this->input->post('username');
		echo $this->input->post('email');
		echo $this->input->post('password');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

	public function verify($key){
		$this->load->model('user_model', 'auth');
		$response_val = $this->auth->check_reset_key($key);
		if($response_val){
			//proceed to next - update password
			$this->after_verify($key);
		}else{
			//error message
			$this->session->set_flashdata('reset_info', '<div class="alert alert-danger">Key Not found in DB</div>');
            redirect('reset');
		}
	}

	public function after_verify($key){
		$data['key'] = $key;
		$this->load->model('user_model', 'auth');
		$this->load->library('form_validation');
		$this->load->view('user/header');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passwordagain', 'Password Confirmation', 'required|matches[password]');
		
		//$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('user/verify', $data);
                }
                else
                {
                        //update password here & set message with session flashdata
                	//$password = $this->input->post('password');
                	$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                	$this->auth->update_user_password($key, $password);
                	$this->session->set_flashdata('login_info', '<div class="alert alert-success">Passsword Update Successfully</div>');
            		redirect('login');
                }
		
		$this->load->view('user/footer');

	}

	public function activate($key){
		$this->load->model('user_model', 'auth');
		$response_val = $this->auth->check_active_key($key);
		if($response_val){
			//activate user account & set succcess messages with session flashdata
			$this->auth->activate_user_account($key);
			$this->session->set_flashdata('login_info', '<div class="alert alert-success">Account Activated Successfully, Please login to your account now.</div>');
            		redirect('login');
		}else{
			//set failure message with session flashdata
			$this->session->set_flashdata('login_info', '<div class="alert alert-danger">Key not found in DB</div>');
            		redirect('login');
		}
	}
}
?>