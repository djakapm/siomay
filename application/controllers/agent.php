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
		"account" => "agent/agent_account_page",
		"personal" => "agent/agent_personal_page"
	);

    function __construct()
    {
        parent::__construct();
		$this->load->model("basicdata");
		$this->load->model("agentmanager","am");
		$this->load->model("distributormanager","dm");
        $this->load->model("securitymanager","sm");
        $this->load->model("notificationmanager","nm");
    }

    public function view_inbox_item($inbox_item_id){
		if(!$this->is_logged_in()){return;}
    	$this->am->update_inbox_item($inbox_item_id,"READ");
    	$data = array();
    	$inbox_item = $this->am->get_inbox_item($inbox_item_id);
    	$data["inbox_item"] = $inbox_item;
    	$data["agent_id"] = $inbox_item["to_id"];
    	$this->load->view($this->views["inbox_item"],$data);
    }

    public function view_inbox(){
		if(!$this->is_logged_in()){return;}
		$agent = $this->am->get_by_email($this->session->userdata("email"));
		$agent_id = $agent["agent_id"];
    	$data = array();
    	$data["inbox_items"] = $this->am->get_inbox($agent_id);
    	$data["agent_id"] = $agent_id;
    	$this->load->view($this->views["inbox"],$data);
    }

    public function do_search_distributor_by_email(){
		if(!$this->is_logged_in()){return;}
    	$agent_id = $this->input->post("agent_id");
    	$distributor_email = $this->input->post("distributor_email");
    	$distributor = $this->dm->get_by_email($distributor_email);
    	$distributor["agent_id"] = $agent_id;
    	$this->load->view($this->views["apply"],$distributor);
    }

    public function apply(){
		if(!$this->is_logged_in()){return;}
		$agent = $this->am->get_by_email($this->session->userdata("email"));
		$agent_id = $agent["agent_id"];
    	$data = array();
    	$data["agent_id"] = $agent_id;
    	$this->load->view($this->views["apply"],$data);
    }

    public function do_apply(){
		if(!$this->is_logged_in()){return;}
    	$agent_id = $this->input->post("agent_id");
    	$distributor_id = $this->input->post("distributor_id");
    	$is_success = $this->am->create_contract($agent_id,$distributor_id);
    	if($is_success){
			$notification["message"] = "Contract created. Please wait for the distributor approval.";
    		
    	}
    	else{
			$notification["message"] = "Fail to create contract. Please try again later.";    		
    	}

		$this->nm->notify($notification["message"],"Back to Personal page","agent/personal/".$agent_id,
		$this->views["notification"]);

    }

    public function login(){
    	$this->load->view($this->views["login"]);
    }

    public function do_login(){
    	$agent_email = $this->input->post("agent_email");
    	$agent_password = $this->input->post("agent_password");
    	$authenticated = $this->sm->agent_authenticate($agent_email,$agent_password);
    	if($authenticated["status"] === FALSE){
			$this->nm->notify($authenticated["message"],"Back to Login page","",
			$this->views["notification"]);


    	}
    	else{
    		$agent = $this->am->get_by_email($agent_email);
	    	$this->sm->create_agent_session($agent);
			redirect("/agent/personal", "location");
    	}
    }

    public function do_logout(){
    	$this->sm->destroy_session();
    	redirect(base_url(), "locations");
    }

	public function register()
	{
		$cities = $this->basicdata->cities();
		$params = array("cities"=>$cities);
		$this->load->view($this->views["register"],$params);
	}

	private function is_logged_in(){
		$is_logged_in = $this->sm->is_logged_in();
		if(!$is_logged_in){
			$this->nm->notify("You are not logged in. Pleas log in first.","Back to Login page","",
			$this->views["notification"]);			
		}

		return $is_logged_in;
	}

	public function personal(){
		if(!$this->is_logged_in()){return;}
		$agent = $this->am->get_by_email($this->session->userdata("email"));
		if(!empty($agent)) {			
			$this->load->view($this->views["personal"],$agent);
		}
		else{
			$this->nm->notify("Agent not found.","Back to Login page","agent/login",
			$this->views["notification"]);
		}
	}

	public function profile(){
		if(!$this->is_logged_in()){return;}

		$agent = $this->am->get_by_email($this->session->userdata("email"));
		$agent_id = $agent["agent_id"];
		$agent = $this->am->get($agent_id);
		if(!empty($agent)) {		
			$city = $this->basicdata->city($agent["agent_city"]);	
			$agent["agent_city"] = $city["name"];
			$this->load->view($this->views["profile"],$agent);
		}		
		else{
			$this->nm->notify("Agent not found.","Back to Login page","agent/login",
			$this->views["notification"]);
				
		}
	}

	public function do_save_profile(){
		if(!$this->is_logged_in()){return;}

		$agent = $this->am->get_by_email($this->session->userdata("email"));
		$agent_id = $agent["agent_id"];

		$agent_name = $this->input->post("agent_name");
		$agent_phone_number = $this->input->post("agent_phone_number");
		$agent_email = $this->input->post("agent_email");
		$agent_city = $this->input->post("agent_city");
		$agent_address = $this->input->post("agent_address");
		$agent_zip_code = $this->input->post("agent_zip_code");
		$agent = array();
		$agent["id"] = $agent_id;
		$agent["name"] = $agent_name;
		$agent["phone_number"] = $agent_phone_number;
		$agent["email"] = $agent_email;
		$agent["address"] = $agent_address;
		$agent["zip_code"] = $agent_zip_code;
		$this->am->update($agent);		
		$this->nm->notify("Profile updated successfuly.","Back to Personal page","agent/personal",
		$this->views["notification"]);
	}

	public function account(){
		if(!$this->is_logged_in()){return;}

		$agent = $this->am->get_by_email($this->session->userdata("email"));
		$agent_id = $agent["agent_id"];
		$agent = $this->am->get($agent_id);
		if(!empty($agent)) {		
			$city = $this->basicdata->city($agent["agent_city"]);	
			$agent["agent_city"] = $city["name"];
			$this->load->view($this->views["account"],$agent);
		}		
		else{
			$this->nm->notify("Agent not found.","Back to Login page","agent/login",
			$this->views["notification"]);
		
		}
	}

	public function do_save_account(){
		if(!$this->is_logged_in()){return;}

		$email = $this->session->userdata("email");
		$agent_old_password = $this->input->post("agent_old_password");
		$agent_new_password = $this->input->post("agent_new_password");
		$agent_new_confirmed_password = $this->input->post("agent_new_confirmed_password");
		if($agent_new_password === $agent_new_confirmed_password){
			$update = $this->sm->agent_update_password($email,$agent_old_password,$agent_new_password);
			if($update["status"] == FALSE){
				$this->nm->notify("Old Password is incorrect.","Back to Personal page","agent/account",
				$this->views["notification"]);				
			}
			else{
				$this->nm->notify("Password changed successfuly.","Back to Personal page","agent/personal",
				$this->views["notification"]);								
			}
		}
		else{
			$this->nm->notify("New Password is not matched.","Back to Personal page","agent/account",
			$this->views["notification"]);
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
			$this->nm->notify($validation["message"],"Back to registration form","agent/register",
			$this->views["notification"]);
					
		}
		else
		{
			$agent_id = $this->am->create($new_agent);
			$this->nm->notify("Congratulation you are a registered agent.","Done","",
			$this->views["notification"]);
		}
	}
}