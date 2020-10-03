<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<?php
class Admin_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	function select_user(){
		//select * from crud_users
		$this->db->select('*');
		$this->db->from('new_registration');
		$this->db->order_by('id','desc');
		$query=$this->db->get();
		$a=$query->result_array();
		return $a;
	}
	 
	function select_new_user(){
		//select * from crud_users
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->order_by('id','desc');
		$query=$this->db->get();
		$a=$query->result_array();
		return $a;
	}
	
	function insert_new_user()
	{
		$name=$this->input->post('doctor_username');
		$password=$this->input->post('doctor_password'); 
		$password = hash('sha512',$password);
		$field = array('user_name'=>$name,'user_password'=>$password,'status'=>1);
		$this->db->insert("user_master",$field);
	}
	
	function get_edit_record()
	{
		$id = $this->uri->segment(3); 
		//select * from user_master where id
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where('id',$id);
		$query=$this->db->get();
		$a=$query->result_array();
		return $a; 
	}
	
	function update_new_user_record(){
		  
		$name=$this->input->post('doctor_username');
		$password=$this->input->post('doctor_password');
		$password = hash('sha512',$password);
		$id = $this->input->post('update_new_created_user_id');
		$field = array('user_name'=>$name,'	user_password'=>$password);
		$this->db->where('id',$id);
		if($this->db->update('user_master',$field)){
			return true;
		}
	} 
	
	function del_new_user()
	{
		$id  = $this->input->post('del_id'); 
		$this->db->where('id',$id);
		$this->db->delete("user_master");
	} 
	
	function update_status($toggle_status,$id){ 
		 
		$this->db->where('id',$id);
		$field = array('status'=>$toggle_status);
		if($this->db->update('user_master',$field)){
			return true;
		}
	}
	
	function admin_change_password()
	{ 
	    $old_password  = $this->input->post('admin_old_password');
		$old_password = hash('sha512',$old_password);
		$new_password = $this->input->post('admin_new_password');
		$new_password = hash('sha512',$new_password); 
			$this->db->select('admin_password');
			$this->db->from('admin_master');
			$this->db->where('admin_password',$old_password);
			$query = $this->db->get();
			$num = $query->num_rows();
			 if($num){
				 $field = array('admin_password'=>$new_password);
				 $this->db->update("admin_master",$field);
				 echo "<script>alert('NEW PASSWORD UPDATED');</script>";
			 }else{
				 echo "<script>alert('Give Correct Old Password');</script>"; 
			 }  
	} 
	
	function admin_login_check(){
		$username = $this->input->post('doctor_admin_emailID');
		$password = $this->input->post('doctor_admin_password');
		$password = hash('sha512',$password);
		$this->db->select('*');
		$this->db->from('admin_master');
		$this->db->where('admin_email_id',$username,'admin_password',$password);
		$check_admin = $this->db->get();
		$num = $check_admin->num_rows();
		if($num){
			$this->session->set_userdata('admin_id',$username);
			return true;
		}else{ 
			return false;
		}
	}
	 
}

?>