<?php
	$name = $this->input->post('username');
	$email =  $this->input->post('email');
	$password = $this->input->post('password');

	$this->auth->insert_user($name, $email, $password);
	$this->session->set_flashdata('register_info', 'User Registered Successfully');
	redirect('register');
?>