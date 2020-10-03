 <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Doctor_control extends CI_Controller { 
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model','model');//as
		$this->load->model('User_model','User_model');
	} 
	
	function index(){  
		$this->load->view('Home'); 
	} 
	
	function buy_online()
	{   
		$this->load->view('Buy-online'); 
	}
	
	function buy_online_insert()
	{   
		 $this->User_model->buy_online_insert();
	} 
	
	function user_login(){
		if($this->User_model->ur_valid_user()){
			$this->load->view('online_contents');
		}else{
			$this->load->view('Home');
			echo "<script>alert('Contact Admin Ur Not Valid User!');</script>";
		} 
	} 
	
	function user_logout(){
		$logout = $this->session->unset_userdata('doctor_user');
		redirect('Doctor_control/index');
	}
	
	function admin_login(){
		if($this->model->admin_login_check()){
			redirect('Doctor_control/admin_panel'); 
		}else{
			$this->load->view('admin-worldsclinicalguide/admin_login'); 
		} 
	}
	
	function logout_admin(){
		$this->load->view('admin-worldsclinicalguide/logout_admin');
	}
	
	
	function admin_panel(){ 
			$result['user_data'] = $this->model->select_user();  
		    $this->load->view('admin-worldsclinicalguide/admin_panel',$result); 
	}
	
	//select_new_user data sidebar and edit button click load
	function admin_create_new_user(){ 
			$id = $this->uri->segment(3);
			if($id){
				$result['update_user_value'] = $this->model->get_edit_record();
			}	 
			$result['new_user_data'] = $this->model->select_new_user();
			$this->load->view('admin-worldsclinicalguide/admin_create_new_user',$result); 
	} 
	
	//creating insert new user data create and update btn click load
	function admin_insert_new_user(){
		if(isset($_POST['doctor_create_user'])){
			$result['insert_new_user_data'] = $this->model->insert_new_user();
			redirect('Doctor_control/admin_create_new_user'); 
		}
		if(isset($_POST['doctor_update_user'])){
			if($this->model->update_new_user_record()){
				redirect('Doctor_control/admin_create_new_user'); 
			} 
		} 
	}
	
	function admin_setting(){ 
	   $new_password = $this->input->post('admin_new_password');
	   $old_password  = $this->input->post('admin_old_password');
	   if(!empty($old_password && $new_password)){
	      $this->model->admin_change_password();  
	   }	
		$this->load->view('admin-worldsclinicalguide/admin_setting'); 
	} 
	
	function admin_delete_new_user(){
		$data = $this->model->del_new_user(); 
	}
	
	function user_toggle(){ 
		if($this->model->update_status($_POST['toggle_status'],$_POST['db_id'])){
			 echo $_POST['toggle_status'];
		} 
	}
	 
}
?>