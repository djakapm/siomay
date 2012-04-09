<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SecurityManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function is_logged_in(){
    	$logged_in = $this->session->userdata("logged_in");
    	return !empty($logged_in);
    }

	public function distributor_authenticate($email,$password){
		$authenticated["status"] = TRUE;
		$authenticated["message"] = "";
		$password = sha1("espodeng " . $password . "6000 ");
		$query = $this->db->get_where("distributor",array("email"=>$email,"password"=>$password));
		$results = $query->result();
		if(empty($results)){
			$authenticated["status"] = FALSE;
			$authenticated["message"] = "Incorrect Email Address or Password.";
		}
		else{
			$authenticated["id"] = $results[0]->id;
		}
		
		return $authenticated;
	}
	
	
	public function agent_authenticate($email,$password){
		$authenticated["status"] = TRUE;
		$authenticated["message"] = "";
		$password = sha1("espodeng ".$password."6000 ");
		$query = $this->db->get_where("agent",array("email"=>$email,"password"=>$password));
		$results = $query->result();
		if(empty($results)){
			$authenticated["status"] = FALSE;
			$authenticated["message"] = "Incorrect Email Address or Password.";
		}
		else{
			$authenticated["id"] = $results[0]->id;
		}
		return $authenticated;
	}

	public function agent_update_password($email,$old_password,$new_password){
		$authenticated = $this->agent_authenticate($email,$old_password);
		$update = array("status"=>TRUE,"message"=>"");
		if($authenticated["status"] == TRUE){
			$agent = array();
			$agent["password"] = sha1("espodeng ".$new_password."6000 ");
			$this->db->where("email", $email);
			$this->db->update("agent",$agent);
		}
		else{
			$update["status"] = FALSE;
			$update["message"] = "Old Password is Incorrect.";
		}

		return $update;

	}

	public function create_session($user_data){
		$this->session->set_userdata($user_data);    
	}

	public function destroy_session(){
		$this->session->sess_destroy();
	}

	public function create_agent_session($agent){
		$email = $agent["agent_email"];
		$name = $agent["agent_name"];
    	$user_data = array(
	    "email" => $email,
	    "name" => $name,
    	"logged_in" => TRUE,
    	"role"=>"agent",
    	"personal_url" => site_url("agent/personal"),
    	"profile_url" => site_url("agent/profile"),
    	"account_url" => site_url("agent/account"),
    	"log_out_url" => site_url("agent/do_logout")
    	);
    	$this->create_session($user_data);		
	}

	public function create_distributor_session($distributor){
		$email = $distributor["distributor_email"];
		$name = $distributor["distributor_name"];
    	$user_data = array(
	    "email" => $email,
	    "name" => $name,
    	"logged_in" => TRUE,
    	"role"=>"distributor",
    	"personal_url" => site_url("distributor/personal"),
    	"profile_url" => site_url("distributor/profile"),
    	"account_url" => site_url("distributor/account"),
    	"log_out_url" => site_url("distributor/do_logout")
    	);
    	$this->create_session($user_data);				
	}
	    
}