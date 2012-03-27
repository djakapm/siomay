<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductManager extends CI_Model {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model("uploadutil");
    }

    public function remove_product($product){
    	$product_archive = array();

    	$product_archive["owner_id"] = $product["product_owner_id"];
    	$product_archive["name"] = $product["product_name"];
    	$product_archive["description"] = $product["product_description"];
    	$product_archive["category_id"] = $product["product_category_id"];
    	$product_archive["tag"] = $product["product_tag"];
    	$product_archive["stock"] = $product["product_stock"];
        $product_archive["weight"] = $product["product_weight"];
    	$product_archive["price"] = $product["product_price"];
    	$product_archive["image_path"] = $product["product_image_path"];
    	$product_archive["status"] = $product["product_status"];
    	$product_archive["created_date"] = $product["product_created_date"];
    	$product_archive["updated_date"] = $product["product_updated_date"];
    	    	
    	$this->db->insert("product_archive",$product_archive);
    	$this->db->delete("product", array("id" => $product["product_id"])); 
    }

    public function update_product_image_path($product_id,$product_name,$product_image){
    	$product = array();
    	$product["image_path"] = "products/".str_replace(" ","_",strtolower($product_name))."/".$product_image;
    	$this->db->where("id", $product_id);
		$this->db->update("product", $product);
    }

    public function update_product($product_name,$product_category,$product_stock,$product_weight,$product_price,$product_description,$product_tag,
	    $product_status,$updated_date,$distributor_id,$product_id){
    	$product = array();
    	$product["name"] = $product_name;
    	$product["description"] = $product_description;
    	$product["owner_id"] = $distributor_id;
    	$product["category_id"] = $product_category;
    	$product["tag"] = $product_tag;
    	$product["stock"] = $product_stock;
        $product["weight"] = $product_weight;
    	$product["price"] = $product_price;
    	$product["status"] = $product_status;
    	$product["updated_date"] = $updated_date;
    	$this->db->where("id", $product_id);
		$this->db->update("product", $product);
    }

    public function create_bulk_products($products,$distributor_id){
        foreach($products as $product){
            $product_id = $this->create_product($product["name"],$product["category"],$product["stock"],
            $product["weight"],$product["price"],$product["description"],$product["tag"],$product["status"],$product["created_date"],$product["updated_date"],$distributor_id);
            $this->update_product_image_path($product_id,$product["name"],$product["image"]);            
        }
    }

    public function create_product($product_name,$product_category,$product_stock,$product_weight,$product_price,$product_description,$product_tag,
	    $product_status,$created_date,$updated_date,$distributor_id){
    	$product = array();
    	$product["name"] = $product_name;
    	$product["description"] = $product_description;
    	$product["owner_id"] = $distributor_id;
    	$product["category_id"] = $product_category;
    	$product["tag"] = $product_tag;
    	$product["stock"] = $product_stock;
        $product["weight"] = $product_weight;
        $product["price"] = $product_price;
    	$product["image_path"] = "";
    	$product["status"] = $product_status;
    	$product["created_date"] = $created_date;
    	$product["updated_date"] = $updated_date;
		$this->db->insert("product", $product);
		return $this->db->insert_id();
    }

    public function get_product($distributor_id,$product_id){
    	$this->db->select("p . * , ps.description AS product_status_desc,pc.description as product_category_desc");
    	$this->db->from("product p");
    	$this->db->join("product_status ps","ps.id = p.status","inner");
    	$this->db->join("product_category pc","pc.id = p.category_id and pc.owner_id = p.owner_id","inner");
    	$this->db->where("p.id",$product_id);
    	$this->db->where("p.owner_id",$distributor_id);
    	$query = $this->db->get();
    	$rows = $query->result();
    	$row = $rows[0];
		$product = array(
			"product_id" => $row->id,
			"product_name" => $row->name,
			"product_description" => $row->description,
			"product_owner_id" => $row->owner_id,
			"product_category_id" => $row->category_id,
			"product_category_desc" => $row->product_category_desc,
			"product_tag" => $row->tag,
			"product_stock" => $row->stock,
            "product_weight" => $row->weight,
			"product_price" => $row->price,
			"product_image_path" => $row->image_path,
			"product_created_date" => $row->created_date,
			"product_updated_date" => $row->updated_date,
			"product_image_path" => $row->image_path,
			"product_status" => $row->status,
			"product_status_desc" => $row->product_status_desc
    	);

    	return $product;    	
    }

    public function get_products($distributor_id){
    	$this->db->select("p . * , ps.description AS product_status_desc");
    	$this->db->from("product p");
    	$this->db->join("product_status ps","ps.id = p.status","inner");
    	$this->db->where("owner_id",$distributor_id);
    	$query = $this->db->get();
    	$rows = $query->result();
    	$products = array();
    	foreach($rows as $row){
    		$products[] = array(
    			"product_id" => $row->id,
    			"product_name" => $row->name,
    			"product_description" => $row->description,
    			"product_owner_id" => $row->owner_id,
    			"product_category_id" => $row->category_id,
    			"product_tag" => $row->tag,
    			"product_stock" => $row->stock,
                "product_weight" => $row->weight,
    			"product_price" => $row->price,
    			"product_image_path" => $row->image_path,
    			"product_created_date" => $row->created_date,
    			"product_updated_date" => $row->updated_date,
    			"product_image_path" => $row->image_path,
				"product_status" => $row->status,
				"product_status_desc" => $row->product_status_desc

	    	);
    	}

    	return $products;
    }    
}