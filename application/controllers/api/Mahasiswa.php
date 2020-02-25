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
    $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
    //Cek tampilkan data
    //var_dump($mahasiswa);

    if ($mahasiswa) {
      $this->response([
          'status' => TRUE,
          'data' => $mahasiswa
      ], 200);
    }

  }

}
