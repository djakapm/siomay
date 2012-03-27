<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DistributorManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }


    public function send_message($distributor_id,$distributor_name,$agent_id,$agent_name,$message){
    	$sent_date = $this->mysql_today_date();
    	$agent_inbox = array();
		$agent_inbox["from_id"] = $distributor_id;
		$agent_inbox["from_name"] = $distributor_name;
		$agent_inbox["to_id"] = $agent_id;
		$agent_inbox["to_name"] = $agent_name;
		$agent_inbox["message"] = $message;
		$agent_inbox["status"] = "UNREAD";
		$agent_inbox["sent_date"] = $sent_date;
		$this->db->insert("agent_inbox", $agent_inbox);
    }

    public function terminate_contract($distributor_id,$agent_id){
    	$data = array("status"=>"TERMINATED");	
		$this->db->where("distributor_id", $distributor_id);
		$this->db->where("agent_id", $distributor_id);
		$this->db->update("contract", $data); 
    }

    public function manage_agents($distributor_id){
		$this->db->select("a.id agent_id, a.name agent_name");
		$this->db->from("agent a");
		$this->db->join("contract c","a.id = c.agent_id","inner");
		$this->db->join("distributor d","d.id = c.distributor_id","inner");
		$this->db->where("c.status","APPROVED");
		$this->db->where("d.id",$distributor_id);
		$query = $this->db->get();
		$rows = $query->result();
		$agents = array();
		foreach($rows as $row){
			$agents[] = array("agent_id"=>$row->agent_id,"agent_name"=>$row->agent_name);
		}
		return $agents;
    }

    public function update_contract($action,$contract_id){
    	if($action === "approve"){
    		$data = array("status"=>"APPROVED");	
    	}
    	else
    	if($action === "reject"){
    		$data = array("status"=>"REJECTED");	
    	}

		$this->db->where("id", $contract_id);
		$this->db->update("contract", $data); 
    }

    public function get_contracts($distributor_id,$contract_status){
        $this->db->select("c.id as contract_id,c.agent_id as agent_id, a.name as agent_name, c.distributor_id as distributor_id, c.status as contract_status");        
        $this->db->from("contract c");
        $this->db->join("agent a", "c.agent_id = a.id","inner");
        $this->db->where("c.distributor_id",$distributor_id);
        $this->db->where("c.status",$contract_status);
        $query = $this->db->get();
    	$rows = $query->result();
    	$contracts = array();
    	foreach($rows as $row){
    		$contracts[] = array("contract_id"=>$row->contract_id,"agent_id"=>$row->agent_id,"agent_name" =>$row->agent_name, "distributor_id"=>$row->distributor_id,
    		"contract_status"=>$row->contract_status);
    	}

    	return $contracts;
    }

	public function validate($distributor){
		$validation = array();
		$validation["status"] = TRUE;
		$validation["message"] = "";
		$query = $this->db->get_where("distributor",array("email"=>$distributor["email"]));
		$search_by_email_results = $query->result();

		$query = $this->db->get_where("distributor",array("phone_number"=>$distributor["phone_number"]));
		$search_by_phone_number_results = $query->result();
		$password = sha1("espodeng " . $distributor["password"] . "6000 ");
		$confirmed_password = sha1("espodeng " . $distributor["password_confirmed"] . "6000 ");

		if($password !== $confirmed_password){
			$validation["status"] = FALSE;
			$validation["message"] = "Password does not match";			
		}
		else
		if(!empty($search_by_email_results)){
			$validation["status"] = FALSE;
			$validation["message"] = "Distributor is already existed. Please use different email";
		}
		else
		if(!empty($search_by_phone_number_results)){
			$validation["status"] = FALSE;
			$validation["message"] = "Distributor is already existed. Please use different phone number";
		}

		return $validation;
	}

	private function mysql_today_date(){
		$today = getdate();
		$mysql_today_date = $today["year"]."-".$today["mon"]."-".$today["mday"]
		." ".$today["hours"].":".$today["minutes"].":".$today["seconds"];
		return $mysql_today_date;
	}

	public function create($distributor){
		//remove distributor's unused element 
		unset($distributor["password_confirmed"]);
		$distributor["password"] = sha1("espodeng " . $distributor["password"] . "6000 ");
		$today = getdate();
		$distributor["registered_date"] = $this->mysql_today_date();
		$this->db->insert("distributor", $distributor);
		return $this->db->insert_id();		
	}

	public function get($distributor_id){
		$distributor = array();
		$query = $this->db->get_where("distributor",array("id"=>$distributor_id));
		$results = $query->result();
		if(!empty($results)){
			$distributor["distributor_name"] = $results[0]->name;
			$distributor["distributor_id"] = $results[0]->id;
			$distributor["distributor_phone_number"] = $results[0]->phone_number;
			$distributor["distributor_email"] = $results[0]->email;
			$distributor["distributor_city"] = $results[0]->city_id;
			$distributor["distributor_address"] = $results[0]->address;
			$distributor["distributor_zip_code"] = $results[0]->zip_code;
			$distributor["distributor_description"] = $results[0]->description;
		}
		return $distributor;
	}

	public function get_by_email($distributor_email){
		$distributor = array();
		$query = $this->db->get_where("distributor",array("email"=>$distributor_email));
		$results = $query->result();
		if(!empty($results)){
			$distributor["distributor_name"] = $results[0]->name;
			$distributor["distributor_id"] = $results[0]->id;
			$distributor["distributor_phone_number"] = $results[0]->phone_number;
			$distributor["distributor_email"] = $results[0]->email;
			$distributor["distributor_city"] = $results[0]->city_id;
			$distributor["distributor_address"] = $results[0]->address;
			$distributor["distributor_zip_code"] = $results[0]->zip_code;
			$distributor["distributor_description"] = $results[0]->description;
		}
		return $distributor;		
	}
}