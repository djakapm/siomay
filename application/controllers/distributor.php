<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distributor extends CI_Controller {
    private $views = array(
        "notification" => "distributor/distributor_notification_page",

        "broadcast_message" => "distributor/distributor_broadcast_message_page",
        "send_message" => "distributor/distributor_send_message_page",

        "contract" => "distributor/distributor_contract_page",
        "contract_termination" => "distributor/distributor_contract_termination_page",

        "agent_profile" => "distributor/distributor_agent_profile_view",
        "agent_management" => "distributor/distributor_agent_management_page",

        "login" => "distributor/distributor_login_page",
        "register" => "distributor/distributor_register_page",
        "personal" => "distributor/distributor_personal_page",
        "profile" => "distributor/distributor_profile_page"
    );

    function __construct()
    {
        parent::__construct();
		$this->load->model("basicdata","bd");
        $this->load->model("distributormanager","dm");
        $this->load->model("agentmanager","am");
        $this->load->model("notificationmanager","nm");
        $this->load->model("securitymanager","sm");
    }

    public function broadcast_message(){
        $distributor_id = $this->input->post("distributor_id");
        $agent_ids = $this->input->post("selected_agent_id");
        if(empty($agent_ids)){
            $this->nm->notify("Please choose one or more agent(s).","Back to Manager Agents page",
            "distributor/manage_agents/".$distributor_id,$this->views["notification"]);
        }
        else{            
            $distributor = $this->dm->get($distributor_id);
            $data["distributor_id"] = $distributor["distributor_id"];
            $data["distributor_name"] = $distributor["distributor_name"];
            $data["agent_ids"] = implode(",",$agent_ids);
            $this->load->view($this->views["broadcast_message"],$data);        
        }
    }

    public function do_broadcast_message(){
        $distributor_id = $this->input->post("distributor_id");
        $distributor_name = $this->input->post("distributor_name");
        $agent_ids = explode(",",$this->input->post("agent_ids"));
        $message = $this->input->post("message");
        foreach($agent_ids as $agent_id){
            $agent = $this->am->get($agent_id);
            $agent_name = $agent["agent_name"];
            $this->dm->send_message($distributor_id,$distributor_name,$agent_id,$agent_name,$message);            
        }

        $this->nm->notify("Broadcast message sent.","Back to Manager Agents page",
        "distributor/manage_agents/".$distributor_id,$this->views["notification"]);        
    }

    public function send_message($distributor_id,$agent_id){
    	$distributor = $this->dm->get($distributor_id);
    	$agent = $this->am->get($agent_id);
    	$data["distributor_id"] = $distributor["distributor_id"];
    	$data["distributor_name"] = $distributor["distributor_name"];
    	$data["agent_id"] = $agent["agent_id"];
    	$data["agent_name"] = $agent["agent_name"];
    	$this->load->view($this->views["send_message"],$data);
    }

    public function do_send_message(){
    	$distributor_id = $this->input->post("distributor_id");
    	$distributor_name = $this->input->post("distributor_name");
    	$agent_id = $this->input->post("agent_id");
    	$agent_name = $this->input->post("agent_name");
    	$message = $this->input->post("message");
    	$this->dm->send_message($distributor_id,$distributor_name,$agent_id,$agent_name,$message);
    	$agent = $this->am->get($agent_id);
        $this->nm->notify("Message sent to ".$agent["agent_name"],"Back to Manager Agents page",
        "distributor/manage_agents/".$distributor_id,$this->views["notification"]);        
    }

    public function terminate_contract($distributor_id,$agent_id){
    	$data = array();
    	$data["distributor_id"] = $distributor_id;
    	$data["agent_id"] = $agent_id;
    	$this->load->view($this->views["contract_termination"],$data);
    }

    public function do_terminate_contract($distributor_id,$agent_id){
    	$this->dm->terminate_contract($distributor_id,$agent_id);
    	redirect("distributor/manage_agents/".$distributor_id,$location);
    }

    public function view_agent_profile($agent_id,$distributor_id){
		$agent = $this->am->get($agent_id);
		if(!empty($agent)) {		
			$city = $this->bd->city($agent["agent_city"]);	
			$agent["agent_city"] = $city["name"];
			$agent["distributor_id"] = $distributor_id;
			$this->load->view($this->views["agent_profile"],$agent);
		}		
    	
    }

    public function manage_agents($distributor_id){
    	$agents = $this->dm->manage_agents($distributor_id);
    	$data = array();
    	$data["agents"] = $agents;
    	$data["distributor_id"] = $distributor_id;
    	$this->load->view($this->views["agent_management"],$data);
    }

    public function process_contract(){
    	$action = $this->uri->segment(3);
    	$contract_id = $this->uri->segment(4);
    	$distributor_id = $this->uri->segment(5);
    	$this->dm->update_contract($action,$contract_id);
    	redirect("distributor/view_contracts/".$distributor_id,"location");
    }

    public function view_contracts(){
    	$distributor_id = $this->uri->segment(3);
    	$pending_contracts = $this->dm->get_contracts($distributor_id,"PENDING");
    	$approved_contracts = $this->dm->get_contracts($distributor_id,"APPROVED");
    	$rejected_contracts = $this->dm->get_contracts($distributor_id,"REJECTED");
    	$data = array();
    	$data["pending_contracts"] = $pending_contracts;
    	$data["approved_contracts"] = $approved_contracts;
    	$data["rejected_contracts"] = $rejected_contracts;
    	$data["distributor_id"] = $distributor_id;
    	$this->load->view($this->views["contract"],$data);
    }

    public function login(){
    	$this->load->view($this->views["login"]);
    }

    public function do_login(){
    	$distributor_email = $this->input->post("distributor_email");
    	$distributor_password = $this->input->post("distributor_password");
    	$authenticated = $this->sm->distributor_authenticate($distributor_email,$distributor_password);
    	if($authenticated["status"] === FALSE){
            $this->nm->notify($authenticated["message"],"Back to Login page","distributor/login",
            $this->views["notification"]);        
    	}
    	else{
	    	$user_data = array("email"=> $distributor_email,"logged_in" => TRUE);
			$this->session->set_userdata($user_data);    
			redirect("/distributor/personal/".$authenticated["id"], "location");
    	}
    }

    public function do_logout(){
    	$this->session->sess_destroy();
    	redirect("/distributor/login", "locations");
    }

	public function register()
	{
		$cities = $this->bd->cities();
		$params = array("cities"=>$cities);
		$this->load->view($this->views["register"],$params);
	}

	public function personal(){
		$distributor_id = $this->uri->segment(3);
		$distributor = $this->dm->get($distributor_id);
		if(!empty($distributor)) {			
			$this->load->view($this->views["personal"],$distributor);
		}
		else{
            $this->nm->notify("Distributor not found.","Back to Login page","distributor/login",
            $this->views["notification"]);        
		}
	}

	public function profile(){
		$distributor_id = $this->uri->segment(3);
		$distributor = $this->dm->get($distributor_id);
		if(!empty($distributor)) {		
			$city = $this->bd->city($distributor["distributor_city"]);	
			$distributor["distributor_city"] = $city["name"];
			$this->load->view($this->views["profile"],$distributor);
		}		
		else{
            $this->nm->notify("Distributor not found.","Back to Login page","distributor/login",
            $this->views["notification"]);        
		}
	}

	public function do_register(){
		$distributor_name = $this->input->post("distributor_name");
		$distributor_password = $this->input->post("distributor_password");
		$distributor_password_confirmed = $this->input->post("distributor_password_confirmed");
		$distributor_email = $this->input->post("distributor_email");
		$distributor_phone_number = $this->input->post("distributor_phone_number");
		$distributor_city = $this->input->post("distributor_city");
		$distributor_address = $this->input->post("distributor_address");
		$distributor_zip_code = $this->input->post("distributor_zip_code");
		$distributor_description = $this->input->post("distributor_description");

		$new_distributor = array(
			 "name" => $distributor_name ,
			 "password" => $distributor_password ,
			 "password_confirmed" => $distributor_password_confirmed ,
    		 "phone_number" => $distributor_phone_number,
   			 "email" => $distributor_email ,
   			 "city_id" => $distributor_city,
    		 "address" => $distributor_address,
    		 "zip_code" => $distributor_zip_code,
    		 "description" => $distributor_description
		);

		$validation = $this->dm->validate($new_distributor);

		if($validation["status"] === FALSE){
            $this->nm->notify($validation["message"],"Back to registration form","distributor/register",
            $this->views["notification"]);        
		}
		else
		{
			$distributor_id = $this->dm->create($new_distributor);
            $this->nm->notify("Congratulation you are a registered distributor.","Done","distributor/personal/".$distributor_id,$this->views["notification"]);        
		}
	}
}