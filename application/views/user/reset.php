<?php 
$attributes = array('class' => 'form-signin');
echo form_open('reset-update', $attributes); ?>
<!-- <form class="form-signin" method="POST"> -->
  <h2 class="form-signin-heading">Reset Your Password</h2>
  <?php 
        echo $this->session->flashdata('reset_info');
        echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
  <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
    <?php 
      $data = array(
                'name'          => 'username',
                'id'            => 'username',
                'class'         => 'form-control',
                'placeholder'   => 'Username or E-Mail'
                //'required'      => 'required'
            );
        echo form_input($data);
    ?>
	</div>
	<?php
    $data = array(
                'class'         => 'btn btn-lg btn-primary btn-block',
                'value'      => 'Reset'
            );
        echo form_submit($data);
    ?>
  <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>login">Login</a>
<?php echo form_close(); ?>
