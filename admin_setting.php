
<?php 
	  $is_admin = $this->session->userdata('admin_id');
		if(!isset($is_admin)){
			redirect('Doctor_control/admin_login');
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Doctor_Setting_App</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/assets_admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/assets_admin/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/assets_admin/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/assets_admin/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>my_assets/assets_admin/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url();?>my_assets/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url();?>my_assets/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>my_assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files 
	  -->
	
	<script src="<?php echo base_url();?>my_assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url();?>my_assets/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
	<script src="<?php echo base_url();?>my_assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="<?php echo base_url();?>my_assets/assets_admin/js/app.js"></script>
	<script src="<?php echo base_url();?>my_assets/global_assets/js/demo_pages/datatables_responsive.js"></script>
	<!-- /theme JS files -->
	<!-- fafa-font -->
	<script src="https://kit.fontawesome.com/f64c26b0b8.js" crossorigin="anonymous"></script>
	<!-- Admin Change PASSWORD validation -->
   <script src="<?php echo base_url();?>my_assets/assets_admin/create_user.js"></script>
   
   <style>
     .iconpadding{
		 padding-top:10px;
	 }
   </style>
</head>

<body>

	<!-- Main navbar ------------------------------------------------------------------------------------------------------>
	<?php 
	   $this->load->view('doctorapp_backend/main_navbar'); 
	?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -------------------------------------------------------------------------------------------------------->
		<?php  
			$this->load->view('admin-worldsclinicalguide/admin_sidebar'); 
		?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Change</span> Password</h4>
					</div>
				</div>			 
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
			 			
<!----------------------------------------------------------------------------------- Login form -->
				<form class="login-form" method="post" action="">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Change Password </h5>
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">							 	
								<input type="password" name="admin_old_password" class="form-control" placeholder="Old Password" autocomplete="off" required>
								<div class="form-control-feedback">
									<i class="icon-user iconpadding text-muted"></i>
								</div>								
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
							   <div style="display:flex;">
								<input type="password" name="admin_new_password" class="form-control" placeholder="New Password" 
								onchange="user_password_validation()" id="user_password"  maxlength="20" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 iconpadding text-muted"></i>
								</div>
								<span style="color:red;font-size:15px;display:none;padding:5px;" id="user_password_err"><i class="fa fa-close"></i></span>						 
								<span style="color:green;font-size:15px;display:none;padding:5px;" id="user_password_ok"> <i class="fa fa-check"></i></span>
							   </div>
							   <span style="color:red;font-size:20px;display:none;font-size:12px;" id="user_password_size_err">Minimum 8 characters</span>
								<span style="color:red;font-size:20px;display:none;font-size:12px;" id="user_password_type_err">Password Must Contain ALL Type Characters</span>
							</div>
							
							<div class="form-group form-group-feedback form-group-feedback-left">
							  <div style="display:flex;">
								<input type="password" name="admin_new_password_conform" class="form-control" placeholder="Password Conform" onchange="conform_password_validation()"  id="conform_user_password"  required>
								<div class="form-control-feedback">
									<i class="icon-lock2 iconpadding text-muted"></i>
								</div>
								<span style="color:red;font-size:15px;display:none;padding:5px;" class="conform_password_err"><i class="fa fa-close"></i></span>						 
								<span style="color:green;font-size:15px;display:none;padding:5px;" class="conform_password_ok"> <i class="fa fa-check"></i></span>
							  </div>	
							    <span style="color:red;font-size:20px;display:none;font-size:12px;" class="conform_password_err">Password Missmatch</span>
							</div>

							<div class="form-group">
								<button type="submit" name="update_admin_password" class="btn btn-primary btn-block">Create New Password <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div>
						</div>
					</div>
				</form>
<!------------------------------------------------------------------------------------ /login form -->
				 
				
			</div>
			<!-- /content area -->
  
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
