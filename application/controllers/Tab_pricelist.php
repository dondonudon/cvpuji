<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Tab_pricelist extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Tab_pricelist_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Pricelist | CV PUJI');
  $this->load->library('datatables');
 }

 public function index()
 {
  $this->template->load('template', 'tab_pricelist/tab_pricelist_list');
 }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Tab_pricelist_model->json();
 }

 public function read($id)
 {
  $row = $this->Tab_pricelist_model->get_by_id($id);
  if ($row) {
   $data = array(
    'id_pricelist' => $row->id_pricelist,
    'kode_kasir'   => $row->kode_kasir,
    'kode_barang'  => $row->kode_barang,
    'harga'        => $row->harga,
    'keterangan'   => $row->keterangan,
    'opsi1'        => $row->opsi1,
    'opsi2'        => $row->opsi2,
    'opsi3'        => $row->opsi3,
    'opsi4'        => $row->opsi4,
    'opsi5'        => $row->opsi5,
   );
   $this->template->load('template', 'tab_pricelist/tab_pricelist_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_pricelist'));
  }
 }

 public function create()
 {
  $data = array(
   'button'       => 'Create',
   'action'       => site_url('tab_pricelist/create_action'),
   'id_pricelist' => set_value('id_pricelist'),
  );
  $this->template->load('template', 'tab_pricelist/tab_pricelist_form', $data);
 }

 public function create_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->create();
  } else {
   $kode_barang = $_POST['kode_barang'];
   $kode_kasir  = $_POST['kode_kasir'];
   $harga       = $_POST['harga'];
   $datetime    = date('Y-m-d H:i:s');

   $data = array();

   $index = 0;
   // Set index array awal dengan 0
   foreach ($kode_kasir as $kasir) { // Kita buat perulangan berdasarkan nis sampai data terakhir
    array_push($data, array(
     'kode_barang' => $kode_barang,
     'kode_kasir'  => $kasir, // Ambil dan set data nama sesuai index array dari $index
     'harga'       => $harga[$index], // Ambil dan set data telepon sesuai index array dari $index
     'datetime'    => $datetime, // Ambil dan set data alamat sesuai index array dari $index
    ));
    $index++;
   }
   $query = $this->db->query("SELECT kode_barang FROM tab_pricelist WHERE kode_barang = '$kode_barang'");
   if ($query->num_rows() == 0) {
    $this->Tab_pricelist_model->insert($data);
    $this->session->set_flashdata('message', 'Create Record Success 2');
    redirect(site_url('tab_pricelist'));
   } else {
    $this->session->set_flashdata('error', 'Data sudah terinput, silahkan lakukan update');
    redirect(site_url('tab_pricelist'));
   }
  }
 }

 public function update($id)
 {
  $row = $this->Tab_pricelist_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'       => 'Update',
    'action'       => site_url('tab_pricelist/update_action'),
    'id_pricelist' => set_value('id_pricelist', $row->id_pricelist),
    'kode_kasir'   => set_value('kode_kasir', $row->kode_kasir),
    'kode_barang'  => set_value('kode_barang', $row->kode_barang),
    'harga'        => set_value('harga', $row->harga),
    'keterangan'   => set_value('keterangan', $row->keterangan),
    'opsi1'        => set_value('opsi1', $row->opsi1),
    'opsi2'        => set_value('opsi2', $row->opsi2),
    'opsi3'        => set_value('opsi3', $row->opsi3),
    'opsi4'        => set_value('opsi4', $row->opsi4),
    'opsi5'        => set_value('opsi5', $row->opsi5),
   );
   $this->template->load('template', 'tab_pricelist/tab_pricelist_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_pricelist'));
  }
 }

 public function update_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->update($this->input->post('id_pricelist', true));
  } else {
   $id_pricelist = $_POST['id_pricelist'];
   $kode_barang  = $_POST['kode_barang'];
   $kode_kasir   = $_POST['kode_kasir'];
   $harga        = $_POST['harga'];
   $datetime     = date('Y-m-d H:i:s');

   $data = array();

   $index = 0;
   // Set index array awal dengan 0
   foreach ($kode_kasir as $kasir) { // Kita buat perulangan berdasarkan nis sampai data terakhir
    array_push($data, array(
     'id_pricelist' => $id_pricelist[$index],
     'kode_kasir'   => $kode_kasir[$index], // Ambil dan set data nama sesuai index array dari $index
     'harga'        => $harga[$index], // Ambil dan set data telepon sesuai index array dari $index
     'datetime'     => $datetime, // Ambil dan set data alamat sesuai index array dari $index
    ));
    $index++;
   }
   //  var_dump($data);
   //  var_dump($id_pricelist);
   $this->Tab_pricelist_model->update($data);

   $this->session->set_flashdata('message', 'Update Record Success');
   redirect(site_url('tab_pricelist'));
  }
 }

 public function delete($id)
 {
  $row = $this->Tab_pricelist_model->get_by_id($id);

  if ($row) {
   $this->Tab_pricelist_model->delete($id);
   $this->session->set_flashdata('message', 'Delete Record Success');
   redirect(site_url('tab_pricelist'));
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_pricelist'));
  }
 }

 public function _rules()
 {
//   $this->form_validation->set_rules('kode_kasir', 'kode kasir', 'trim|required');
  //   $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
  //   $this->form_validation->set_rules('harga', 'harga', 'trim|required');
  //   $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
  //   // $this->form_validation->set_rules('opsi1', 'opsi1', 'trim|required');
  // $this->form_validation->set_rules('opsi2', 'opsi2', 'trim|required');
  // $this->form_validation->set_rules('opsi3', 'opsi3', 'trim|required');
  // $this->form_validation->set_rules('opsi4', 'opsi4', 'trim|required');
  // $this->form_validation->set_rules('opsi5', 'opsi5', 'trim|required');

  $this->form_validation->set_rules('id_pricelist', 'id_pricelist', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "tab_pricelist.xls";
  $judul     = "tab_pricelist";
  $tablehead = 0;
  $tablebody = 1;
  $nourut    = 1;
  //penulisan header
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $namaFile . "");
  header("Content-Transfer-Encoding: binary ");

  xlsBOF();

  $kolomhead = 0;
  xlsWriteLabel($tablehead, $kolomhead++, "No");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Kasir");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Harga");
  xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi1");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi2");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi3");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi4");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi5");

  foreach ($this->Tab_pricelist_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteNumber($tablebody, $kolombody++, $data->kode_kasir);
   xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
   xlsWriteNumber($tablebody, $kolombody++, $data->harga);
   xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
   xlsWriteLabel($tablebody, $kolombody++, $data->opsi1);
   xlsWriteLabel($tablebody, $kolombody++, $data->opsi2);
   xlsWriteLabel($tablebody, $kolombody++, $data->opsi3);
   xlsWriteLabel($tablebody, $kolombody++, $data->opsi4);
   xlsWriteLabel($tablebody, $kolombody++, $data->opsi5);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }

}

/* End of file Tab_pricelist.php */
/* Location: ./application/controllers/Tab_pricelist.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:52:12 */
/* http://harviacode.com */
