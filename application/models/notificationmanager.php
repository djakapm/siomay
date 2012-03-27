<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotificationManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function notify($message,$action_label,$url,$notification_page){
	    $notification["message"] = $message;
	    $notification["action_label"] = $action_label;
	    $notification["action_url"] = site_url($url);           
	    $this->load->view($notification_page,$notification);
    }
}