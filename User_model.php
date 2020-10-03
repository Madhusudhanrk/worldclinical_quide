<?php
class User_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	} 
	
	function buy_online_insert()
	{  
		$name           = $this->input->post('doctor_name');
		$city           = $this->input->post('doctor_city');
			$country_number = $this->input->post('doctor_country_number');
			$mobile_number  = $this->input->post('doctor_mobile_number');
		$mobile_number  = '+'.$country_number.'-'.$mobile_number;
		$email_id		= $this->input->post('doctor_email_id');
		$ref_name       = $this->input->post('doctor_ref_name');
		$reciepts       = $_FILES['doctor_payment_reciept']['name'];
		
		if(!empty($reciepts )){ 
				$doctor_payment_reciept_size      = $_FILES['doctor_payment_reciept']['size']; 
				$doctor_payment_reciept_tmp_name  = $_FILES['doctor_payment_reciept']['tmp_name'];	
				$doctor_payment_reciept_type = mime_content_type($doctor_payment_reciept_tmp_name);
				$allowed_extensions = array('image/jpeg','image/png', 'image/jpg','image/gif');
				if(in_array($doctor_payment_reciept_type , $allowed_extensions)){
					if($doctor_payment_reciept_size<=2097152){
					   $reciepts = time().$reciepts;
					   $doctor_payment_reciept_directory = "payment_reciepts/$reciepts";
					  
					   move_uploaded_file($doctor_payment_reciept_tmp_name,$doctor_payment_reciept_directory);
					  date_default_timezone_set('Asia/Kolkata'); 
					  
						$field = array('user_name'=>$name,'user_city'=>$city ,'user_phone_number'=>$mobile_number,'user_email_id'=>$email_id,'	refered_person_name'=>$ref_name,'reciepts'=>$reciepts,'upload_date_time'=>date("d-m-Y h:i A"));
						if($this->db->insert("new_registration",$field)){
							redirect('Doctor_control/index#success');
						}else{
							redirect('Doctor_control/index#imageonly');
						}
					}else{								 
						echo "<script>alert('File Size larger than 2MB')</script>";
					} 							
				}else{								 
						echo "<script>alert('File Type JPG,JPEG,PNG,GIF Only Allowed!')</script>";
				} 
		} 
	} 
	
	function ur_valid_user(){
		$login_user = $this->input->post('doctor_user_emailID');
		$login_pass = $this->input->post('doctor_user_password');
		$login_pass = hash('sha512',$login_pass);
		$field =  array('user_name'=>$login_user,'user_password'=>$login_pass,'status'=>1);
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where($field);
		$query = $this->db->get();
		$num = $query->num_rows();
		 if($num){ 
		     $this->session->set_userdata('doctor_user',$login_user);
			 return true;
		 }else{ 
			 return false;
		 } 
	}
}

 
?>