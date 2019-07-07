<?php
//echo $key . "key from verify view"
//get email & display it in email input field
$email = $this->auth->check_reset_key($key,1)
?>
<?php 
$attributes = array('class' => 'form-signin');
$current_url = current_url();
echo form_open($current_url, $attributes); ?>
    <h2 class="form-signin-heading">Update Your Password</h2>
    <?php 
        echo $this->session->flashdata('register_info');
        echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?php 
    $attributes = array(
                'class' => 'sr-only'
        );
    echo form_label('Email address', 'inputEmail', $attributes);

      $data = array(
                'type'          => 'email',
                'name'          => 'email',
                'id'            => 'inputEmail',
                'class'         => 'form-control',
                'placeholder'   => 'Email address',
                'disabled'      => 'disabled'
            );
        //$val = set_value('email');
        echo form_input($data, $email);
  
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

    $attributes = array(
                'class' => 'sr-only'
        );
    echo form_label('Password Again', 'inputPassword', $attributes);
      $data = array(
                'type'          => 'password',
                'name'          => 'passwordagain',
                'id'            => 'inputPassword',
                'class'         => 'form-control',
                'placeholder'   => 'Password Again'
                //'required'      => 'required'
            );
        echo form_input($data);

        $data = array(
                'class'         => 'btn btn-lg btn-primary btn-block',
                'value'      => 'Update Password'
            );
        echo form_submit($data);
    ?>
    <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>login">Login</a>
  <?php echo form_close(); ?>

