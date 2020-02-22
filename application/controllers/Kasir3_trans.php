<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Kasir3_trans extends CI_Controller
{

 public $kode_m_kasir = 3;

 public function __construct()
 {
  parent::__construct();
  $this->load->model('Kasir_trans_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Laporan Penjualan | CV PUJI');
  $this->load->library('datatables');
 }

 public function index()
 {
  $data = array(
   'kode_m_kasir' => $this->kode_m_kasir,
  );
  $this->load->view('kasir/kasir3/trans_list', $data);
  //$this->load->view('Layout/Template', $data);
 }

 public function ajax_list()
 {
  $kode_m_kasir = $this->kode_m_kasir;
  $list = $this->Kasir_trans_model->get_datatables($kode_m_kasir);
  $data = array();
  $no   = $_POST['start'];
  foreach ($list as $customers) {
   $no++;
   $row   = array();
   $row[] = $no;
   $row[] = $customers->notrans;
   $row[] = number_format($customers->jumlah);
   $row[] = $customers->datetime;
   $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('kasir3_trans/read/' . $customers->notrans) . '" title="Edit" target="_blank">Detail</a>';

   $data[] = $row;
  }

  $output = array(
   "draw"            => $_POST['draw'],
   "recordsTotal"    => $this->Kasir_trans_model->count_all($kode_m_kasir),
   "recordsFiltered" => $this->Kasir_trans_model->count_filtered($kode_m_kasir),
   "data"            => $data,
  );
  //output to json format
  echo json_encode($output);
 }

 public function read($notrans)
 {
  $data = array('notrans' => $notrans);
  $this->load->view('kasir/kasir3/trans_read', $data);

 }

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */
