<?php defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Log In</title>
	
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/back/plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/back/plugins/node-waves/waves.css'); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/back/plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/back/css/style.css'); ?>" rel="stylesheet">
</head>

<body class="login-page bg-indigo">
    <div class="login-box">
        <div class="logo">
        <a href="#">Log In</a>
        </div>
		
		<?php if($error_msg = $this->session->flashdata('error_msg')): ?>		
			<div class="alert bg-pink animated shake"><?php echo $error_msg; ?></div>
		<?php endif; ?>
		
        <div class="card">
            <div class="body">				
				
				<?php echo form_open('login/auth', array('id' => 'sign_in')); ?>		
                   
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row m-b--20">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">LOG IN</button>
                        </div>
                    </div>
					
				<?php echo form_close(); ?>
				
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/back/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/back/plugins/bootstrap/js/bootstrap.js'); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/back/plugins/node-waves/waves.js'); ?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('assets/back/plugins/jquery-validation/jquery.validate.js'); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/back/js/admin.js'); ?>"></script>
    <script src="<?php echo base_url('assets/back/js/pages/examples/sign-in.js'); ?>"></script>
</body>

</html>
