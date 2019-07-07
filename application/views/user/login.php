<?php 
$attributes = array('class' => 'form-signin');
echo form_open('login-post', $attributes); ?>
<!-- <form class="form-signin" method="POST"> -->
  <h2 class="form-signin-heading">Please Login</h2>
  <?php 
        echo $this->session->flashdata('login_info');
        echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
  <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
    <?php 
      $data = array(
                'name'          => 'username',
                'id'            => 'username',
                'class'         => 'form-control',
                'placeholder'   => 'Username'
                //'required'      => 'required'
            );
        $val = set_value('username');
        echo form_input($data, $val);
    ?>
	</div>
	<?php
 	$attributes = array(
                'class' => 'sr-only'
        );
    echo form_label('Password', 'inputPassword', $attributes);
      $data = array(
                'type'          => 'password',
                'name'          => 'password',
                'id'            => 'inputPassword',
                'class'         => 'form-control',
                'placeholder'   => 'Password'
                //'required'      => 'required'
            );
        echo form_input($data);
    $data = array(
                'class'         => 'btn btn-lg btn-primary btn-block',
                'value'      => 'Login'
            );
        echo form_submit($data);
    ?>
  <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>register">Register</a>
  <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>reset">Reset</a>
<?php echo form_close(); ?>
