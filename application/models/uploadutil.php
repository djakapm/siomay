<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UploadUtil extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }


    public function archive_product_file($source_file,$destination_file,$source_folder,$destination_folder){
        mkdir($destination_folder,0777);
        copy($source_file,$destination_file);        
        $this->remove_old_product_folder($source_folder);
    }

    private function remove_old_product_folder($dir) {
       if (is_dir($dir)) {
         $objects = scandir($dir);
         foreach ($objects as $object) {
           if ($object != "." && $object != "..") {
             if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object); else unlink($dir."/".$object);
           }
         }
         reset($objects);
         rmdir($dir);
       }
     }
 
 	public function remove_old_product_image($upload_path){
            //Remove current product image.
            $handle = opendir($upload_path);
            while (($file = readdir($handle))!==false) {
                @unlink($upload_path."/".$file);
            }
            closedir($handle);            		
	}


    public function upload_bulk_product(){
        $upload_path = "./temp";
        if(!file_exists($upload_path)){
            mkdir($upload_path, 0777);
        }

        $config["upload_path"] = $upload_path;
        $config["allowed_types"] = "csv|txt|zip";
        $config["max_size"] = "500";

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload("product_file"))
        {
            $result["is_success"] = FALSE;
            $result["message"] = array("error" => $this->upload->display_errors());
        }
        else
        {
            $result["is_success"] = TRUE;
            $result["message"] = array("upload_data" => $this->upload->data());
        }        
        
        return $result;
    }

	public function upload_product_image($product_name){
        $product_image_root_path = "./products/";
        $upload_path = $product_image_root_path.str_replace(" ","_",strtolower($product_name));
        $config["upload_path"] = $upload_path;
        $config["allowed_types"] = "gif|jpg|png";
        $config["max_size"] = "100";
        $config["max_width"]  = "1024";
        $config["max_height"]  = "768";
        $this->upload->initialize($config);
        if(!file_exists($upload_path)){
            mkdir($upload_path, 0777);
        }
        else{
        	$this->remove_old_product_image($upload_path);
        }

        if ( ! $this->upload->do_upload("product_image"))
        {
            $result["is_success"] = FALSE;
            $result["message"] = array("error" => $this->upload->display_errors());
        }
        else
        {
            $result["is_success"] = TRUE;
            $result["message"] = array("upload_data" => $this->upload->data());
        }        
        
        return $result;		
	}
}
