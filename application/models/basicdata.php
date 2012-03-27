<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basicdata extends CI_Model {

	public function get_current_date_in_mysql_format(){
		return date("Y-m-d H:i:s");
	}

	public function order_statuses(){
		$query = $this->db->get("order_status");
		$statuses = array();
		$rows = $query->result();
		foreach($rows as $row){
			$statuses[$row->id] = $row->description;
		}

		return $statuses;		
	}

	public function product_status_id($status_desc){
		$query = $this->db->get_where("product_status",array("description"=>$status_desc));
		$statuses = array();
		$rows = $query->result();
		$row = $rows[0];
		return $row->id;
		
	}

	public function product_status_desc($status_id){
		$query = $this->db->get_where("product_status",array("id"=>$status_id));
		$statuses = array();
		$rows = $query->result();
		$row = $rows[0];
		return $row->description;
	}

	public function product_statuses(){
		$query = $this->db->get("product_status");
		$statuses = array();
		$rows = $query->result();
		foreach($rows as $row){
			$statuses[$row->id] = $row->description;
		}

		return $statuses;				
	}

	public function product_category_id($category_desc,$distributor_id){
		$category_id = -1;
		$query = $this->db->get_where("product_category",array("owner_id"=>$distributor_id));
		$rows = $query->result();
		if(empty($rows)){
			$new_category = array();
			$new_category["description"] = $category_desc;
			$new_category["owner_id"] = $distributor_id;
			$this->db->insert("product_category",$new_category);
			$category_id = $this->db->insert_id();
		}
		else{
			$category_id = $rows[0]->id;
		}

		return $category_id;	
	}

	public function product_categories($distributor_id){
		$query = $this->db->get_where("product_category",array("owner_id"=>$distributor_id));
		$categories = array();
		$rows = $query->result();
		foreach($rows as $row){
			$categories[$row->id] = $row->description;
		}

		return $categories;
				
	}


	public function city($id_pair){
		$parts = explode("_",$id_pair);
		$kota_id = $parts[0];
		$propinsi_id = $parts[1];
		$query = $this->db->get_where("kota_kabupaten",array("kota_id"=>$kota_id,"propinsi_id"=>$propinsi_id));
		$results = $query->result();
		$city = array("name"=>$results[0]->kota_kabupaten);
		return $city;
	}

	public function cities(){
		$this->db->select("kk.kota_id,kk.kota_kabupaten,prop.propinsi_id,prop.propinsi");
		$this->db->from("kota_kabupaten kk");
		$this->db->join("propinsi prop","kk.propinsi_id = prop.propinsi_id","inner");
		$this->db->order_by("kk.kota_kabupaten", "asc"); 
		$query = $this->db->get();
		$rows = $query->result();
		$cities = array();
		foreach($rows as $row){
			$cities[] = array("id"=>$row->kota_id."_".$row->propinsi_id,"name"=>$row->kota_kabupaten." (".$row->propinsi.")");
		}

		return $cities;
	}
}