<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends CI_Controller
{

  use REST_Controller {
      REST_Controller::__construct as private __resTraitConstruct;
  }

  public function __construct()
  {
    parent:: __construct();
    $this->__resTraitConstruct();
    $this->load->model('Mahasiswa_model');
  }

  public function index_get()
  {
    
    //Cek tampilkan data
    //var_dump($mahasiswa);

    //method get mahasiswa berdasarkan id
    $id = $this->get('id');

    if($id === null)
    {
      //bila id null maka tampilkan semua data
      $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
    }else{
      //bila id ada atau direquest maka tampilkan data berdasarkan id
      $mahasiswa = $this->Mahasiswa_model->getMahasiswa($id);
    }

    if ($mahasiswa) {
      $this->response([
          'status' => TRUE,
          'data' => $mahasiswa
      ], 200);
    }

  }

}
