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

  //fungsi untuk menampilkan data
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

    //memberikan reponds bila data ditemukan dan tidak ditemukan
    if ($mahasiswa) {
      $this->response([
          'status' => TRUE,
          'data' => $mahasiswa
      ], 200);
    }else{
      $this->response([
        'status' => FALSE,
        'message' => 'id tidak di temukan'
    ], 404);
    }

  }

  //fungsi untuk menghapus data
  public function index_delete()
  {
    $id = $this->delete('id');

    if($id === null)
    {
      //pesan bila user tidak input id
      $this->response([
        'status' => FALSE,
        'message' => 'masukan id dengan benar'
    ], 400);
    }else{
      //OK Data terhapus
      if($this->Mahasiswa_model->deleteMahasiswa($id)>0){
        $this->response([
          'status' => TRUE,
          'id' => $id,
          'message' => 'data terhapus'
      ], 200);
      }else{
        //hapus gagal karena id tidak ditemukan
        $this->response([
          'status' => FALSE,
          'message' => 'penghapusan gagal id tidak ditemukan'
      ], 400);
      }
    }
  }

  public function index_post()
  {
    $data = [
      'nrp' => $this->post('nrp'),
      'nama' => $this->post('nama'),
      'email' => $this->post('email'),
      'jurusan' => $this->post('jurusan')
    ];

    if($this->Mahasiswa_model->createMahasiswa($data) > 0)
    {
      //data berhasil dibuat
      $this->response([
        'status' => TRUE,
        'message' => 'data berhasiil ditambahkan'
    ], 201);
    }else{
             //data gagal ditambahkan
             $this->response([
              'status' => FALSE,
              'message' => 'data gagal ditambahkan'
          ], 400);
    }
  }

  public function index_put()
  {
    $id = $this->put('id');
    $data = [
      'nrp' => $this->put('nrp'),
      'nama' => $this->put('nama'),
      'email' => $this->put('email'),
      'jurusan' => $this->put('jurusan')
    ];

    if($this->Mahasiswa_model->updateMahasiswa($data, $id) > 0)
    {
      //data berhasil dibuat
      $this->response([
        'status' => TRUE,
        'message' => 'data berhasiil diubah'
    ], 201);
    }else{
             //data gagal ditambahkan
             $this->response([
              'status' => FALSE,
              'message' => 'data gagal diubah'
          ], 400);
    }
  }

}
