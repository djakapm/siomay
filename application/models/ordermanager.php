<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }


    public function delete_order($order_id,$updated_date){
        $order = array();
        $order["status"] = 4;
        $order["updated_date"] = $updated_date;
        $this->db->where("id", $order_id);
        $this->db->update("order", $order);
    }

    public function update_order($order_id,$amount_of_goods,$from_id,$order_status,$notes,$updated_date){
        $order = array();
        $order["amount_of_goods"] = $amount_of_goods;
        $order["from_id"] = $from_id;
        $order["status"] = $order_status;
        $order["notes"] = $notes;
        $order["updated_date"] = $updated_date;
        $this->db->where("id", $order_id);
        $this->db->update("order", $order);
    }

    public function create_order($product_id,$amount_of_goods,$product_price,$product_weight,
            $shipping_price,$from_id,$to_id,$order_status,$notes,$created_date,$updated_date){
        $order = array();
        $order["product_id"] = $product_id;
        $order["amount_of_goods"] = $amount_of_goods;
        $order["product_price"] = $product_price;
        $order["product_weight"] = $product_weight;
        $order["shipping_price"] = $shipping_price;
        $order["total_price"] = ($product_price + (int)($shipping_price * $product_weight)) * $amount_of_goods;
        $order["from_id"] = $from_id;
        $order["to_id"] = $to_id;
        $order["status"] = $order_status;
        $order["notes"] = $notes;
        $order["created_date"] = $created_date;
        $order["updated_date"] = $updated_date;
        $this->db->insert("order", $order);
        return $this->db->insert_id();
        
    }

    public function get_order($order_id){
        $this->db->select("o . * , p.name AS product_name, os.description AS order_status_desc, a.name as agent_name,a.email as agent_email");
        $this->db->from("order o");
        $this->db->join("product p","p.id = o.product_id","inner");
        $this->db->join("order_status os","os.id = o.status","inner");
        $this->db->join("agent a","a.id = o.from_id","inner");
        $this->db->where("o.id",$order_id);
        $this->db->where("o.status !=",4);
        $query = $this->db->get();
        $rows = $query->result();
        $row = $rows[0];
        $order = array(
            "order_id" => $row->id,
            "order_product_id" => $row->product_id,
            "order_product_name" => $row->product_name,
            "order_product_price" => $row->product_price,
            "order_product_weight" => $row->product_weight,
            "order_shipping_price" => $row->shipping_price,
            "order_total_price" => $row->total_price,
            "order_from_id" => $row->from_id,
            "order_to_id" => $row->to_id,
            "order_created_date" => $row->created_date,
            "order_updated_date" => $row->updated_date,
            "order_status" => $row->status,
            "order_status_desc" => $row->order_status_desc,
            "agent_name" => $row->agent_name,
            "agent_email" => $row->agent_email,
            "order_notes" => $row->notes,
            "order_amount_of_goods" => $row->amount_of_goods
        );
        return $order;            
    }

    public function get_orders($distributor_id){
    	$this->db->select("o . * , p.name AS product_name, os.description AS order_status_desc, a.name as agent_name");
    	$this->db->from("order o");
    	$this->db->join("product p","p.id = o.product_id","inner");
        $this->db->join("order_status os","os.id = o.status","inner");
    	$this->db->join("agent a","a.id = o.from_id","inner");
        $this->db->where("o.to_id",$distributor_id);
    	$this->db->where("o.status !=",4);
    	$query = $this->db->get();
    	$rows = $query->result();
    	$orders = array();
    	foreach($rows as $row){
    		$orders[] = array(
    			"order_id" => $row->id,
    			"order_product_id" => $row->product_id,
    			"order_product_name" => $row->product_name,
    			"order_product_price" => $row->product_price,
    			"order_shipping_price" => $row->shipping_price,
    			"order_total_price" => $row->total_price,
    			"order_from_id" => $row->from_id,
    			"order_to_id" => $row->to_id,
    			"order_created_date" => $row->created_date,
    			"order_updated_date" => $row->updated_date,
                "order_status_desc" => $row->order_status_desc,
    			"agent_name" => $row->agent_name
	    	);
    	}

    	return $orders;    
    }
}
