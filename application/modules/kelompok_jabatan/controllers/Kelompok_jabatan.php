<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class kelompok_jabatan extends Parent_Controller {
 
  var $nama_tabel = 'm_kelompok_jabatan';
  var $daftar_field = array('id','id_kelas_jabatan','nama_kelompok_jabatan');
  var $primary_key = 'id';
  
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_kelompok_jabatan'); 
		if(!$this->session->userdata('username')){
		   echo "<script language=javascript>
				 alert('Anda tidak berhak mengakses halaman ini!');
				 window.location='" . base_url('login') . "';
				 </script>";
		}
 	}
 
	public function index(){
		$data['judul'] = $this->data['judul']; 
		$data['konten'] = 'kelompok_jabatan/kelompok_jabatan_view';
		$this->load->view('template_view',$data);		
   
	}
 
  	public function fetch_kelompok_jabatan(){  
       $getdata = $this->m_kelompok_jabatan->fetch_kelompok_jabatan();
       echo json_encode($getdata);   
  	}

  	public function fetch_kelas_jabatan(){  
       $getdata = $this->m_kelompok_jabatan->fetch_kelas_jabatan();
       echo json_encode($getdata);   
  	}  
	 
	public function get_data_edit(){
		$id = $this->uri->segment(3);
		$sql = "select a.*,b.nama_kelas_jabatan from m_kelompok_jabatan a
				left join m_kelas_jabatan b on b.id = a.id_kelas_jabatan
 				where a.id = '".$id."' ";
		$get = $this->db->query($sql)->row();
		echo json_encode($get,TRUE);
	}
	 
	public function hapus_data(){
		$id = $this->uri->segment(3);  
    

    $sqlhapus = $this->m_kelompok_jabatan->hapus_data($id);
		
		if($sqlhapus){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE);
	}
	 
	public function simpan_data(){
    
    
    $data_form = $this->m_kelompok_jabatan->array_from_post($this->daftar_field);

    $id = isset($data_form['id']) ? $data_form['id'] : NULL; 
 

    $simpan_data = $this->m_kelompok_jabatan->simpan_data($data_form,$this->nama_tabel,$this->primary_key,$id);
 
		if($simpan_data){
			$result = array("response"=>array('message'=>'success'));
		}else{
			$result = array("response"=>array('message'=>'failed'));
		}
		
		echo json_encode($result,TRUE);

	}
 
  
       


}
