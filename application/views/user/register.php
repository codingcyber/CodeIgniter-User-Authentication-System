<?php 
$attributes = array('class' => 'form-signin');
echo form_open('register', $attributes); ?>
    <h2 class="form-signin-heading">Please Register</h2>
    <?php 
        echo $this->session->flashdata('register_info');
        echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
	  <!-- <input type="text" name="username" id="username" class="form-control" placeholder="Username" required> -->
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
    echo form_label('Email address', 'inputEmail', $attributes);

      $data = array(
                'type'          => 'email',
                'name'          => 'email',
                'id'            => 'inputEmail',
                'class'         => 'form-control',
                'placeholder'   => 'Email address'
                //'required'      => 'required'
            );
        $val = set_value('email');
        echo form_input($data, $val);
  
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
                'value'      => 'Register'
            );
        echo form_submit($data);
    ?>
    <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>login">Login</a>
    <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>reset">Reset</a>
  <?php echo form_close(); ?>

