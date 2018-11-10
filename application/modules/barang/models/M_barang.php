<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_barang extends Parent_Model { 
  
  var $nama_tabel = 'm_barang';
  var $daftar_field = array('id','id_cat_barang','nama_barang','satuan','harga_satuan');
  var $primary_key = 'id';
	  
  public function __construct(){
        parent::__construct();
        $this->load->database();
  }
  public function fetch_barang(){   
       $sql = "select a.*,b.nama_kategori from m_barang a left join m_cat_barang b on b.id = a.id_cat_barang";
		   $getdata = $this->db->query($sql)->result();
		   $data = array();  
	 
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
               
                $sub_array[] = $row->nama_kategori;  
                $sub_array[] = $row->nama_barang;  
                 
                 
			          $sub_array[] = '<a href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect" id="edit" onclick="Ubah_Data('.$row->id.');" > <i class="material-icons">create</i> Ubah </a>  &nbsp; <a href="javascript:void(0)" id="delete" class="btn btn-danger btn-xs waves-effect" onclick="Hapus_Data('.$row->id.');" > <i class="material-icons">delete</i> Hapus </a>';  
               
                $data[] = $sub_array;  
             
           }  
          
		   return $output = array("data"=>$data);
		    
    }

    public function fetch_cat_barang(){   
       $getdata = $this->db->get('m_cat_barang')->result();
       $data = array();  
       
           foreach($getdata as $row)  
           {  
                $sub_array = array();  
                             $sub_array[] = $row->nama_kategori;  
                 $sub_array[] = $row->id;  
                  
               
                $data[] = $sub_array;  
               
           }  
          
       return $output = array("data"=>$data);
        
    }

  
  
	 
 
}
