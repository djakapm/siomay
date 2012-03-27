<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {
    private $views = array(
        "notification" => "distributor/distributor_notification_page",

        "add_bulk_inventory" => "inventory/distributor_add_bulk_inventory_item_page",
        "delete_inventory" => "inventory/distributor_delete_inventory_item_page",
        "edit_inventory" => "inventory/distributor_edit_inventory_item_page",
        "add_inventory" => "inventory/distributor_add_inventory_item_page",
        "inventory_item" => "inventory/distributor_inventory_item_page",
        "inventory" => "inventory/distributor_inventory_page",

    );

    function __construct()
    {
        parent::__construct();
		$this->load->model("basicdata","bd");
        $this->load->model("productmanager","pm");
        $this->load->model("notificationmanager","nm");
    }

    public function add_bulk_product($distributor_id){
       $data = array();
       $data["distributor_id"] = $distributor_id;
       $this->load->view($this->views["add_bulk_inventory"],$data);
    }

    public function do_add_bulk_product(){
        $distributor_id = $this->input->post("distributor_id");
        $result = $this->uploadutil->upload_bulk_product();

        if($result["is_success"]){
             $path = $result["message"]["upload_data"]["file_path"];
             $zip_folder = $result["message"]["upload_data"]["raw_name"];
             $zip_file_path = $result["message"]["upload_data"]["full_path"];
             $this->load->library("unzip");
             $this->unzip->allow(array("csv", "jpeg", "jpg"));            
             $this->unzip->extract($zip_file_path,$path.$zip_folder);
             $csv_file_path = $path.$zip_folder."/products.csv";
             $products = array();
            if (($handle = fopen($csv_file_path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    //Sprei Roumanie uk.180,Sprei Premium terbuat dari bahan import katun jepang atau lebih dikenal Satin Jepang,katun jepang,3,2.5,125000,Roumanie.jpg,AVAILABLE
                    $product = array();
                    $product["name"] = $data[0];
                    $product["description"] = $data[1];
                    $product["category"] = $this->bd->product_category_id($data[2],$distributor_id);
                    $product["stock"] = $data[3];
                    $product["weight"] = $data[4];
                    $product["price"] = $data[5];
                    $product["image"] = $data[6];
                    $product["status"] = $this->bd->product_status_id($data[7]);
                    $product["tag"] = str_replace("_",",",$data[8]);
                    $product["created_date"] = $this->bd->get_current_date_in_mysql_format();
                    $product["updated_date"] = $this->bd->get_current_date_in_mysql_format();
                    $products[] = $product;
                    $source = $path.$zip_folder."/".$product["image"];
                    $destination = "./products/".str_replace(" ","_",strtolower($product["name"]));
                          if(!file_exists($destination)){
                            mkdir($destination, 0777);
                            }
                            else{
                                $this->uploadutil->remove_old_product_image($destination);
                            }

                    copy($source,$destination."/".$product["image"]);
                }
                fclose($handle);
            }        

            $this->pm->create_bulk_products($products,$distributor_id);
            $this->nm->notify("Bulk product created successfully.","Back to Inventory page",
            "distributor/view_products/".$distributor_id,$this->views["notification"]);
        }
        else{
            $this->nm->notify("Failed to upload bulk product file. ".$result["message"]["error"],"Back to Inventory page",
            "inventory/view_products/".$distributor_id,$this->views["notification"]);
        }               
    }

    public function delete_product($distributor_id,$product_id){
        $data = array();
        $product = $this->pm->get_product($distributor_id,$product_id);
        $data["product"] = $product;
        $data["product_id"] = $product_id;
        $data["distributor_id"] = $distributor_id;
        $data["product_categories"] = $this->bd->product_categories($distributor_id);
        $data["product_statuses"] = $this->bd->product_statuses();
        $this->load->view($this->views["delete_inventory"],$data);
    }

    public function do_delete_product(){
        $distributor_id = $this->input->post("distributor_id");
        $product_id = $this->input->post("product_id");
        $product = $this->pm->get_product($distributor_id,$product_id);
        $source_file = "./".$product["product_image_path"];
        $path_parts = explode("/",$product["product_image_path"]);
        $source_folder = "./".$path_parts[0]."/".$path_parts[1];
        $destination_file = "./product_archives/".$path_parts[1]."/".$path_parts[2];
        $destination_folder = "./product_archives/".$path_parts[1];
        
        $this->uploadutil->archive_product_file($source_file,$destination_file,$source_folder,$destination_folder);
        $this->pm->remove_product($product);
        $this->nm->notify("Product removed successfully.","Back to Inventory page",
            "inventory/view_products/".$distributor_id,$this->views["notification"]);
    }

    public function edit_product($distributor_id,$product_id){
        $data = array();
        $product = $this->pm->get_product($distributor_id,$product_id);
        $data["product"] = $product;
        $data["product_id"] = $product_id;
        $data["distributor_id"] = $distributor_id;
        $data["product_categories"] = $this->bd->product_categories($distributor_id);
        $data["product_statuses"] = $this->bd->product_statuses();
        $this->load->view($this->views["edit_inventory"],$data);
    }

    public function do_edit_product(){
        $distributor_id = $this->input->post("distributor_id");
        $product_id = $this->input->post("product_id");
        $product_name = $this->input->post("product_name");
        $product_category = $this->input->post("product_category");
        $product_stock = $this->input->post("product_stock");
        $product_weight = $this->input->post("product_weight");
        $product_price = $this->input->post("product_price");
        $product_description = $this->input->post("product_description");
        $product_tag = $this->input->post("product_tag");
        $product_status = $this->input->post("product_status");
        $updated_date = $this->bd->get_current_date_in_mysql_format();
        $product_image_is_modified = !empty($_FILES["product_image"]["name"]);

        $this->pm->update_product($product_name,$product_category,$product_stock,$product_weight,$product_price,
            $product_description,$product_tag,$product_status,$updated_date,$distributor_id,$product_id);
        
        if($product_image_is_modified){
            $result = $this->uploadutil->upload_product_image($product_name);
        }

        if(isset($result)){
            if($result["is_success"] && !empty($product_id)){
                $this->pm->update_product_image_path($product_id,$product_name,$result["message"]["upload_data"]["file_name"]);
            }
            else{
                $this->nm->notify("Failed to upload product image, But the product successfuly updated. ".$result["message"]["error"],"Back to Inventory page",
                "inventory/view_products/".$distributor_id,$this->views["notification"]);
            }                    
        }

        $this->nm->notify("Product updated successfully.","Back to Inventory page",
        "inventory/view_products/".$distributor_id,$this->views["notification"]);
    }

    public function add_product($distributor_id){
        $data = array();
        $data["distributor_id"] = $distributor_id;
        $data["product_categories"] = $this->bd->product_categories($distributor_id);
        $data["product_statuses"] = $this->bd->product_statuses();
        $this->load->view($this->views["add_inventory"],$data);
    }

    public function do_add_product(){
        $distributor_id = $this->input->post("distributor_id");
        $product_name = $this->input->post("product_name");
        $product_category = $this->input->post("product_category");
        $product_stock = $this->input->post("product_stock");
        $product_weight = $this->input->post("product_weight");
        $product_price = $this->input->post("product_price");
        $product_description = $this->input->post("product_description");
        $product_tag = $this->input->post("product_tag");
        $product_status = $this->input->post("product_status");
        $created_date = $this->bd->get_current_date_in_mysql_format();
        $updated_date = $created_date;
        $product_id = $this->pm->create_product($product_name,$product_category,$product_stock,$product_weight,
            $product_price,$product_description,$product_tag,$product_status,$created_date,$updated_date,$distributor_id);

        $result = $this->uploadutil->upload_product_image($product_name);

        if($result["is_success"] && !empty($product_id)){
            $this->pm->update_product_image_path($product_id,$product_name,$result["message"]["upload_data"]["file_name"]);
            $this->nm->notify("Product added successfully.","Back to Inventory page",
            "inventory/view_products/".$distributor_id,$this->views["notification"]);
        }
        else{
            $this->nm->notify("Failed to upload product image, But the product successfuly added. ".$result["message"]["error"],"Back to Inventory page",
            "inventory/view_products/".$distributor_id,$this->views["notification"]);
        }
    }


    public function view_product($distributor_id,$product_id){
        $data = array();
        $data["distributor_id"] = $distributor_id;
        $data["product"] = $this->pm->get_product($distributor_id,$product_id);
        $this->load->view($this->views["inventory_item"],$data);
    }

    public function view_products($distributor_id){
        $data = array();
        $data["distributor_id"] = $distributor_id;
        $data["products"] = $this->pm->get_products($distributor_id);
        $this->load->view($this->views["inventory"],$data);
    }    

}
