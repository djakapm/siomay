<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class order extends CI_Controller {
    private $views = array(
        "notification" => "distributor/distributor_notification_page",

        "delete_order" => "order/distributor_delete_order_item_page",
        "edit_order" => "order/distributor_edit_order_item_page",
        "add_order" => "order/distributor_add_order_item_page",
        "order" => "order/distributor_order_page",
    );

    function __construct()
    {
        parent::__construct();
		$this->load->model("basicdata","bd");
        // $this->load->model("distributormanager","dm");
        $this->load->model("productmanager","pm");
        $this->load->model("ordermanager","om");
        $this->load->model("agentmanager","am");
        $this->load->model("notificationmanager","nm");
        // $this->load->model("securitymanager","sm");
    }

    public function delete_order($distributor_id,$order_id){
        $products = $this->pm->get_products($distributor_id);
        $product_selections = array();
        foreach($products as $product){
            $price = $product["product_price"];
            $name = $product["product_name"];
            $weight = $product["product_weight"];
            $product_selections[$product["product_id"]] = $name." (price: ".$price.", weight: ".$weight.")";
        }

        $data = array();
        $data["product_selections"] = $product_selections;
        $data["distributor_id"] = $distributor_id;
        $data["order_statuses"] = $this->bd->order_statuses();
        $data["order"] = $this->om->get_order($order_id);
        $this->load->view($this->views["delete_order"],$data);                
    }

    public function do_delete_order(){
        $distributor_id = $this->input->post("distributor_id");
        $order_id = $this->input->post("order_id");
        $updated_date = $this->bd->get_current_date_in_mysql_format();
        $this->om->delete_order($order_id,$updated_date);

        $this->nm->notify("Order deleted successfully.","Back to Order page",
        "order/view_orders/".$distributor_id,$this->views["notification"]);

    }

    public function edit_order($distributor_id,$order_id){
        $products = $this->pm->get_products($distributor_id);
        $product_selections = array();
        foreach($products as $product){
            $price = $product["product_price"];
            $name = $product["product_name"];
            $weight = $product["product_weight"];
            $product_selections[$product["product_id"]] = $name." (price: ".$price.", weight: ".$weight.")";
        }

        $data = array();
        $data["product_selections"] = $product_selections;
        $data["distributor_id"] = $distributor_id;
        $data["order_statuses"] = $this->bd->order_statuses();
        $data["order"] = $this->om->get_order($order_id);
        $this->load->view($this->views["edit_order"],$data);        
    }

    public function do_edit_order(){
        $distributor_id = $this->input->post("distributor_id");
        $order_id = $this->input->post("order_id");
        $amount_of_goods = $this->input->post("amount_of_goods");
        $agent = $this->am->get_by_email($this->input->post("from"));
        $from_id = $agent["agent_id"];
        $order_status = $this->input->post("order_status");
        $notes = $this->input->post("notes");
        $updated_date = $this->bd->get_current_date_in_mysql_format();
        $this->om->update_order($order_id,$amount_of_goods,$from_id,$order_status,$notes,$updated_date);

        $this->nm->notify("Order updated successfully.","Back to Order page",
        "order/view_orders/".$distributor_id,$this->views["notification"]);

    }

    public function view_orders($distributor_id){
        $data = array();
        $data["distributor_id"] = $distributor_id;
        $data["orders"] = $this->om->get_orders($distributor_id);
        $this->load->view($this->views["order"],$data);        
    }

    public function add_order($distributor_id){
        $products = $this->pm->get_products($distributor_id);
        $product_selections = array();
        foreach($products as $product){
            $price = $product["product_price"];
            $name = $product["product_name"];
            $weight = $product["product_weight"];
            $product_selections[$product["product_id"]] = $name." (price: ".$price.", weight: ".$weight.")";
        }

        $data = array();
        $data["product_selections"] = $product_selections;
        $data["distributor_id"] = $distributor_id;
        $data["order_statuses"] = $this->bd->order_statuses();
        $this->load->view($this->views["add_order"],$data);
    }

    public function do_add_order(){
        $distributor_id = $this->input->post("distributor_id");
        $product_id = $this->input->post("product_name");
        $amount_of_goods = $this->input->post("amount_of_goods");
        $product_price = $this->input->post("product_price");
        $product_weight = $this->input->post("product_weight");
        $shipping_price = $this->input->post("shipping_price");
        $agent = $this->am->get_by_email($this->input->post("from"));
        $from_id = $agent["agent_id"];
        $to_id = $distributor_id;
        $order_status = $this->input->post("order_status");
        $notes = $this->input->post("notes");
        $created_date = $this->bd->get_current_date_in_mysql_format();
        $updated_date = $created_date;
        $this->om->create_order($product_id,$amount_of_goods,$product_price,$product_weight,
            $shipping_price,$from_id,$to_id,$order_status,$notes,$created_date,$updated_date);

        $this->nm->notify("Order created successfully.","Back to Order page",
        "order/view_orders/".$distributor_id,$this->views["notification"]);

    }
}
