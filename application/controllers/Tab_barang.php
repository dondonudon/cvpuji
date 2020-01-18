<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Tab_barang extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Tab_barang_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Data Barang | CV PUJI');
  $this->load->library('datatables');
 }

 public function index()
 {
  $this->template->load('template', 'tab_barang/tab_barang_list');
 }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Tab_barang_model->json();
 }

 public function read($id)
 {
  $row = $this->Tab_barang_model->get_by_id($id);
  if ($row) {
   $data = array(
    'kode_barang' => $row->kode_barang,
    'kode_group'  => $row->kode_group,
    'nama'        => $row->nama,
    'ukuran'      => $row->ukuran,
    'merk'        => $row->merk,
    'gambar'      => $row->gambar,
    'harga'       => $row->harga,
    'harga_kasir' => $row->harga_kasir,
    'stok'        => $row->stok,
    'keterangan'  => $row->keterangan,
    'opsi2'       => $row->opsi2,
    'opsi3'       => $row->opsi3,
    'opsi4'       => $row->opsi4,
    'opsi5'       => $row->opsi5,
   );
   $this->template->load('template', 'tab_barang/tab_barang_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_barang'));
  }
 }

 public function create()
 {
  $data = array(
   'button'      => 'Create',
   'action'      => site_url('tab_barang/create_action'),
   'kode_barang' => set_value('kode_barang'),
   'kode_group'  => set_value('kode_group'),
   'nama'        => set_value('nama'),
   'barcode'     => set_value('barcode'),
   'ukuran'      => set_value('ukuran'),
   'merk'        => set_value('merk'),
   'gambar'      => set_value('gambar'),
   'harga'       => set_value('harga'),
   'harga_kasir' => set_value('harga_kasir'),
   'stok'        => set_value('stok'),
   'keterangan'  => set_value('keterangan'),
   'opsi2'       => set_value('opsi2'),
   'opsi3'       => set_value('opsi3'),
   'opsi4'       => set_value('opsi4'),
   'opsi5'       => set_value('opsi5'),
  );
  $this->template->load('template', 'tab_barang/tab_barang_form', $data);
 }

 public function create_action()
 {
  //get extension
  $name = $_FILES["gambar"]["name"];
  $tmp  = explode(".", $name);
  $ext  = end($tmp); # extra () to prevent notice

  $this->_rules();
  if ($this->form_validation->run() == false) {
   $this->create();
  } else {
   $data = array(
    'kode_group'  => $this->input->post('kode_group', true),
    'nama'        => $this->input->post('nama', true),
    'barcode'     => $this->input->post('barcode', true),
    'ukuran'      => $this->input->post('ukuran', true),
    'merk'        => $this->input->post('merk', true),
    'gambar'      => 'b_' . time() . '.' . $ext,
    'harga'       => $this->input->post('harga', true),
    'harga_kasir' => $this->input->post('harga_kasir', true),
    'stok'        => $this->input->post('stok', true),
    'keterangan'  => $this->input->post('keterangan', true),
    'opsi2'       => $this->input->post('opsi2', true),
    'opsi3'       => $this->input->post('opsi3', true),
    'opsi4'       => $this->input->post('opsi4', true),
    'opsi5'       => $this->input->post('opsi5', true),
    'datetime'    => date('Y-m-d H:i:s'),
   );

   //UPLOAD GAMBAR
   $config['upload_path']   = './upload/image';
   $config['allowed_types'] = 'jpg|png|jpeg';
   $config['max_size']      = '2048';
   $config['remove_space']  = true;
   $config['file_name']     = 'b_' . time() . '.' . $ext;
   $this->load->library('upload', $config); // Load konfigurasi uploadnya
   if ($this->upload->do_upload('gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
    // Jika berhasil :

   } else {
    // Jika gagal :
    $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    return $return;
   }

   $this->Tab_barang_model->insert($data);
   $this->session->set_flashdata('message', 'Create Record Success 2');
   redirect(site_url('tab_barang'));
  }
 }

 public function update($id)
 {
  $row = $this->Tab_barang_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'      => 'Update',
    'action'      => site_url('tab_barang/update_action'),
    'kode_barang' => set_value('kode_barang', $row->kode_barang),
    'kode_group'  => set_value('kode_group', $row->kode_group),
    'nama'        => set_value('nama', $row->nama),
    'barcode'     => set_value('nama', $row->barcode),
    'ukuran'      => set_value('ukuran', $row->ukuran),
    'merk'        => set_value('merk', $row->merk),
    'gambar'      => set_value('gambar', $row->gambar),
    'harga'       => set_value('harga', $row->harga),
    'harga_kasir' => set_value('harga_kasir', $row->harga_kasir),
    'stok'        => set_value('stok', $row->stok),
    'keterangan'  => set_value('keterangan', $row->keterangan),
    'opsi2'       => set_value('opsi2', $row->opsi2),
    'opsi3'       => set_value('opsi3', $row->opsi3),
    'opsi4'       => set_value('opsi4', $row->opsi4),
    'opsi5'       => set_value('opsi5', $row->opsi5),
   );
   $this->template->load('template', 'tab_barang/tab_barang_form', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_barang'));
  }
 }

 public function update_action()
 {
  $this->_rules();
  //get extension
  $name = $_FILES["gambar"]["name"];
  $tmp  = explode(".", $name);
  $ext  = end($tmp); # extra () to prevent notice

  if ($name != "") {
   if ($this->form_validation->run() == false) {
    $this->update($this->input->post('kode_barang', true));
   } else {
    $data = array(
     //'kode_group'  => $this->input->post('kode_group', true),
     'nama'        => $this->input->post('nama', true),
     'barcode'     => $this->input->post('barcode', true),
     'ukuran'      => $this->input->post('ukuran', true),
     'merk'        => $this->input->post('merk', true),
     'gambar'      => 'b_' . time() . '.' . $ext,
     'harga'       => $this->input->post('harga', true),
     'harga_kasir' => $this->input->post('harga_kasir', true),
     'stok'        => $this->input->post('stok', true),
     'keterangan'  => $this->input->post('keterangan', true),
     'opsi2'       => $this->input->post('opsi2', true),
     'opsi3'       => $this->input->post('opsi3', true),
     'opsi4'       => $this->input->post('opsi4', true),
     'opsi5'       => $this->input->post('opsi5', true),
     'datetime'    => date('Y-m-d H:i:s'),
    );

    //UPLOAD GAMBAR
    $config['upload_path']   = './upload/image';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size']      = '2048';
    $config['remove_space']  = true;
    $config['file_name']     = 'b_' . time() . '.' . $ext;
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if ($this->upload->do_upload('gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
     // Jika berhasil :

    } else {
     // Jika gagal :
     $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
     return $return;
    }
   }
  } else {
   $data = array(
    // 'kode_group'  => $this->input->post('kode_group', true),
    'nama'        => $this->input->post('nama', true),
    'barcode'     => $this->input->post('barcode', true),
    'ukuran'      => $this->input->post('ukuran', true),
    'merk'        => $this->input->post('merk', true),
    'harga'       => $this->input->post('harga', true),
    'harga_kasir' => $this->input->post('harga_kasir', true),
    'stok'        => $this->input->post('stok', true),
    'keterangan'  => $this->input->post('keterangan', true),
    'opsi2'       => $this->input->post('opsi2', true),
    'opsi3'       => $this->input->post('opsi3', true),
    'opsi4'       => $this->input->post('opsi4', true),
    'opsi5'       => $this->input->post('opsi5', true),
    'datetime'    => date('Y-m-d H:i:s'),
   );
  }

  $this->Tab_barang_model->update($this->input->post('kode_barang', true), $data);
  $this->session->set_flashdata('message', 'Update Record Success');
  redirect(site_url('tab_barang'));

 }

 public function delete($id)
 {
  $row = $this->Tab_barang_model->get_by_id($id);

  if ($row) {
   $query = $this->db->query("SELECT stok FROM tab_barang WHERE kode_barang = '$id'")->row();
   if (is_null($query->stok) || $query->stok == 0) {
    $this->Tab_barang_model->delete($id);
    $this->session->set_flashdata('message', 'Delete Record Success');
    redirect(site_url('tab_barang'));
   } else {
    $this->session->set_flashdata('error', 'Data tidak bisa dihapus karena masih ada stok');
    redirect(site_url('tab_barang'));
   }
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('tab_barang'));
  }
 }

 public function _rules()
 {
  $this->form_validation->set_rules('kode_group', 'kode group', 'trim|required');
  $this->form_validation->set_rules('nama', 'nama', 'trim|required');
  $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required');
  $this->form_validation->set_rules('merk', 'merk', 'trim|required');
  //$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
  $this->form_validation->set_rules('harga', 'harga', 'trim|required');
  $this->form_validation->set_rules('harga_kasir', 'harga_kasir', 'trim|required');
  //$this->form_validation->set_rules('stok', 'stok', 'trim|required');
  $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
  // $this->form_validation->set_rules('opsi1', 'opsi1', 'trim|required');
  // $this->form_validation->set_rules('opsi2', 'opsi2', 'trim|required');
  // $this->form_validation->set_rules('opsi3', 'opsi3', 'trim|required');
  // $this->form_validation->set_rules('opsi4', 'opsi4', 'trim|required');
  // $this->form_validation->set_rules('opsi5', 'opsi5', 'trim|required');

  $this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "tab_barang.xls";
  $judul     = "tab_barang";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Group");
  xlsWriteLabel($tablehead, $kolomhead++, "Nama");
  xlsWriteLabel($tablehead, $kolomhead++, "Ukuran");
  xlsWriteLabel($tablehead, $kolomhead++, "Merk");
  xlsWriteLabel($tablehead, $kolomhead++, "Gambar");
  xlsWriteLabel($tablehead, $kolomhead++, "Harga Pabrik");
  xlsWriteLabel($tablehead, $kolomhead++, "Harga Kasir");
  xlsWriteLabel($tablehead, $kolomhead++, "Stok");
  xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

  foreach ($this->Tab_barang_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
   xlsWriteNumber($tablebody, $kolombody++, $data->kode_group);
   xlsWriteLabel($tablebody, $kolombody++, $data->nama);
   xlsWriteNumber($tablebody, $kolombody++, $data->ukuran);
   xlsWriteLabel($tablebody, $kolombody++, $data->merk);
   xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
   xlsWriteNumber($tablebody, $kolombody++, $data->harga);
   xlsWriteNumber($tablebody, $kolombody++, $data->harga_kasir);
   xlsWriteNumber($tablebody, $kolombody++, $data->stok);
   xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }

}

/* End of file Tab_barang.php */
/* Location: ./application/controllers/Tab_barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:52:02 */
/* http://harviacode.com */
