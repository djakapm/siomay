<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {

	private $views = array(
		"inbox_item" => "agent/agent_inbox_item_page",
		"inbox" => "agent/agent_inbox_page",
		"login" => "agent/agent_login_page",
		"notification" => "agent/agent_notification_page",
		"apply" => "agent/agent_apply_page",
		"register" => "agent/agent_register_page",
		"profile" => "agent/agent_profile_page",
		"personal" => "agent/agent_personal_page"
	);

    function __construct()
    {
        parent::__construct();
		$this->load->model("basicdata");
		$this->load->model("agentmanager","am");
		$this->load->model("distributormanager","dm");
        $this->load->model("securitymanager","sm");
    }

    public function view_inbox_item($inbox_item_id){
    	$this->am->update_inbox_item($inbox_item_id,"READ");
    	$data = array();
    	$inbox_item = $this->am->get_inbox_item($inbox_item_id);
    	$data["inbox_item"] = $inbox_item;
    	$data["agent_id"] = $inbox_item["to_id"];
    	$this->load->view($this->views["inbox_item"],$data);
    }

    public function view_inbox($agent_id){
    	$data = array();
    	$data["inbox_items"] = $this->am->get_inbox($agent_id);
    	$data["agent_id"] = $agent_id;
    	$this->load->view($this->views["inbox"],$data);
    }

    public function do_search_distributor_by_email(){
    	$agent_id = $this->input->post("agent_id");
    	$distributor_email = $this->input->post("distributor_email");
    	$distributor = $this->dm->get_by_email($distributor_email);
    	$distributor["agent_id"] = $agent_id;
    	$this->load->view($this->views["apply"],$distributor);
    }

    public function apply(){
    	$agent_id = $this->uri->segment(3);
    	$data = array();
    	$data["agent_id"] = $agent_id;
    	$this->load->view($this->views["apply"],$data);
    }

    public function do_apply(){
    	$agent_id = $this->input->post("agent_id");
    	$distributor_id = $this->input->post("distributor_id");
    	$is_success = $this->am->create_contract($agent_id,$distributor_id);
    	if($is_success){
			$notification["message"] = "Contract created. Please wait for the distributor approval.";
    		
    	}
    	else{
			$notification["message"] = "Fail to create contract. Please try again later.";    		
    	}

		$notification["action_url"] = site_url("agent/personal/".$agent_id);			
		$notification["action_label"] = "Back to Pesonal Page";
		$this->load->view($this->views["notification"],$notification);
    }

    public function login(){
    	$this->load->view($this->views["login"]);
    }

    public function do_login(){
    	$agent_email = $this->input->post("agent_email");
    	$agent_password = $this->input->post("agent_password");
    	$authenticated = $this->sm->agent_authenticate($agent_email,$agent_password);
    	if($authenticated["status"] === FALSE){
			$notification["message"] = $authenticated["message"];
			$notification["action_label"] = "Back to Login page";
			$notification["action_url"] = site_url("agent/login");			
			$this->load->view($this->views["notification"],$notification);

    	}
    	else{
	    	$user_data = array("email"=> $agent_email,"logged_in" => TRUE);
			$this->session->set_userdata($user_data);    
			redirect("/agent/personal/".$authenticated["id"], "location");
    	}
    }

    public function do_logout(){
    	$this->session->sess_destroy();
    	redirect("/agent/login", "locations");
    }

	public function register()
	{
		$cities = $this->basicdata->cities();
		$params = array("cities"=>$cities);
		$this->load->view($this->views["register"],$params);
	}

	public function personal(){
		$agent_id = $this->uri->segment(3);
		$agent = $this->am->get($agent_id);
		if(!empty($agent)) {			
			$this->load->view($this->views["personal"],$agent);
		}
		else{
			$notification["message"] = "Agent not found.";
			$notification["action_label"] = "Back to Login page";
			$notification["action_url"] = site_url("agent/login");			
			$this->load->view($this->views["notfication"],$notification);
		}
	}

	public function profile(){
		$agent_id = $this->uri->segment(3);
		$agent = $this->am->get($agent_id);
		if(!empty($agent)) {		
			$city = $this->basicdata->city($agent["agent_city"]);	
			$agent["agent_city"] = $city["name"];
			$this->load->view($this->views["profile"],$agent);
		}		
		else{
			$notification["message"] = "Agent not found.";
			$notification["action_label"] = "Back to Login page";
			$notification["action_url"] = site_url("agent/login");		
			$this->load->view($this->views["notification"],$notification);				
		}
	}

	public function do_register(){
		$agent_name = $this->input->post("agent_name");
		$agent_password = $this->input->post("agent_password");
		$agent_password_confirmed = $this->input->post("agent_password_confirmed");
		$agent_email = $this->input->post("agent_email");
		$agent_phone_number = $this->input->post("agent_phone_number");
		$agent_city = $this->input->post("agent_city");
		$agent_address = $this->input->post("agent_address");
		$agent_zip_code = $this->input->post("agent_zip_code");

		$new_agent = array(
			 "name" => $agent_name ,
			 "password" => $agent_password ,
			 "password_confirmed" => $agent_password_confirmed ,
    		 "phone_number" => $agent_phone_number,
   			 "email" => $agent_email ,
   			 "city_id" => $agent_city,
    		 "address" => $agent_address,
    		 "zip_code" => $agent_zip_code
		);

		$validation = $this->am->validate($new_agent);

		if($validation["status"] === FALSE){
			$notification["message"] = $validation["message"];
			$notification["action_label"] = "Back to registration form";
			$notification["action_url"] = site_url("agent/register");			
		}
		else
		{
			$agent_id = $this->am->create($new_agent);
			$notification["message"] = "Congratulation you are a registered agent.";
			$notification["action_label"] = "Done";
			$notification["action_url"] = site_url("agent/personal/".$agent_id);			
		}
		$this->load->view($this->views["notification"],$notification);
	}
}