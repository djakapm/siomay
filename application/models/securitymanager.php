<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SecurityManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
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

	    
}