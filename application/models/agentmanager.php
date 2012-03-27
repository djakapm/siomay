<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AgentManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function update_inbox_item($inbox_item_id,$status){
    	$data = array("status"=>$status);	
		$this->db->where("id", $inbox_item_id);
		$this->db->update("agent_inbox", $data); 
    }
    
    public function get_inbox_item($inbox_item_id){
    	$query = $this->db->get_where("agent_inbox",array("id"=>$inbox_item_id));
    	$rows = $query->result();
    	$row = $rows[0];
    		$inbox_item = array("id"=>$row->id,"from_id"=>$row->from_id,"from_name"=>$row->from_name,
    		"to_id"=>$row->to_id,"to_name"=>$row->to_name,"message"=>$row->message,
    		"status"=>$row->status,"sent_date"=>$row->sent_date);

    	return $inbox_item;
    }

    public function get_inbox($agent_id){
    	$query = $this->db->get_where("agent_inbox",array("to_id"=>$agent_id));
    	$rows = $query->result();
    	$inbox_items = array();
    	foreach($rows as $row){
    		$inbox_items[] = array("id"=>$row->id,"from_id"=>$row->from_id,"from_name"=>$row->from_name,
    		"to_id"=>$row->to_id,"to_name"=>$row->to_name,"message"=>$row->message,
    		"status"=>$row->status,"sent_date"=>$row->sent_date);
    	}

    	return $inbox_items;
    }

    public function create_contract($agent_id,$distributor_id){
    	$contract = array();
    	$contract["agent_id"] = $agent_id;
    	$contract["distributor_id"] = $distributor_id;
    	$contract["status"] = "PENDING";
    	$contract["contract_date"] = $this->mysql_today_date();
    	$this->db->insert("contract", $contract);

    	$is_success = $this->db->_error_number() === 0;
    	return $is_success;
    }

	public function validate($agent){
		$validation = array();
		$validation["status"] = TRUE;
		$validation["message"] = "";
		$query = $this->db->get_where("agent",array("email"=>$agent["email"]));
		$search_by_email_results = $query->result();

		$query = $this->db->get_where("agent",array("phone_number"=>$agent["phone_number"]));
		$search_by_phone_number_results = $query->result();
		$password = sha1("espodeng ".$agent["password"]."6000 ");
		$confirmed_password = sha1("espodeng ".$agent["password_confirmed"]."6000 ");

		if($password !== $confirmed_password){
			$validation["status"] = FALSE;
			$validation["message"] = "Password does not match";			
		}
		else
		if(!empty($search_by_email_results)){
			$validation["status"] = FALSE;
			$validation["message"] = "Agent is already existed. Please use different email";
		}
		else
		if(!empty($search_by_phone_number_results)){
			$validation["status"] = FALSE;
			$validation["message"] = "Agent is already existed. Please use different phone number";
		}
		return $validation;
	}

	private function mysql_today_date(){
		$today = getdate();
		$mysql_today_date = $today["year"]."-".$today["mon"]."-".$today["mday"]
		." ".$today["hours"].":".$today["minutes"].":".$today["seconds"];
		return $mysql_today_date;
	}

	public function create($agent){
		//remove agent's unused element 
		unset($agent["password_confirmed"]);
		$agent["password"] = sha1("espodeng ".$agent["password"]."6000 ");
		$agent["registered_date"] = $this->mysql_today_date();

		$this->db->insert("agent", $agent);
		return $this->db->insert_id();		
	}

	public function get_by_email($email){
		$agent = array();
		$query = $this->db->get_where("agent",array("email"=>$email));
		$results = $query->result();
		if(!empty($results)){
			$agent["agent_name"] = $results[0]->name;
			$agent["agent_id"] = $results[0]->id;
			$agent["agent_phone_number"] = $results[0]->phone_number;
			$agent["agent_email"] = $results[0]->email;
			$agent["agent_city"] = $results[0]->city_id;
			$agent["agent_address"] = $results[0]->address;
			$agent["agent_zip_code"] = $results[0]->zip_code;
		}
		return $agent;		
	}

	public function get($agent_id){
		$agent = array();
		$query = $this->db->get_where("agent",array("id"=>$agent_id));
		$results = $query->result();
		if(!empty($results)){
			$agent["agent_name"] = $results[0]->name;
			$agent["agent_id"] = $results[0]->id;
			$agent["agent_phone_number"] = $results[0]->phone_number;
			$agent["agent_email"] = $results[0]->email;
			$agent["agent_city"] = $results[0]->city_id;
			$agent["agent_address"] = $results[0]->address;
			$agent["agent_zip_code"] = $results[0]->zip_code;
		}
		return $agent;
	}
}