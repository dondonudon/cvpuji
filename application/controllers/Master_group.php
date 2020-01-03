<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Master_group extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Master_group_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Master Group | CV PUJI');
  $this->load->library('datatables');
 }

 public function index()
 {
  $this->template->load('template', 'master_group/master_group_list');
 }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Master_group_model->json();
 }

 public function read($id)
 {
  $row = $this->Master_group_model->get_by_id($id);
  if ($row) {
   $data = array(
    'kode_group' => $row->kode_group,
    'nama_group' => $row->nama_group,
    'gambar'     => $row->gambar,
    'keterangan' => $row->keterangan,
    'opsi1'      => $row->opsi1,
    'opsi2'      => $row->opsi2,
    'opsi3'      => $row->opsi3,
    'opsi4'      => $row->opsi4,
    'opsi5'      => $row->opsi5,
   );
   $this->template->load('template', 'master_group/master_group_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_group'));
  }
 }

 public function create()
 {
  $data = array(
   'button'     => 'Create',
   'action'     => site_url('master_group/create_action'),
   'kode_group' => set_value('kode_group'),
   'nama_group' => set_value('nama_group'),
   'gambar'     => set_value('gambar'),
   'keterangan' => set_value('keterangan'),
   'opsi1'      => set_value('opsi1'),
   'opsi2'      => set_value('opsi2'),
   'opsi3'      => set_value('opsi3'),
   'opsi4'      => set_value('opsi4'),
   'opsi5'      => set_value('opsi5'),
  );
  $this->template->load('template', 'master_group/master_group_form', $data);
 }

 public function create_action()
 {
  $this->_rules();

  //get extension
  $name = $_FILES["gambar"]["name"];
  $tmp  = explode(".", $name);
  $ext  = end($tmp); # extra () to prevent notice

  if ($this->form_validation->run() == false) {
   $this->create();
  } else {
   $data = array(
    'nama_group' => $this->input->post('nama_group', true),
    'gambar'     => 'g_' . time() . '.' . $ext,
    'keterangan' => $this->input->post('keterangan', true),
    'opsi1'      => $this->input->post('opsi1', true),
    'opsi2'      => $this->input->post('opsi2', true),
    'opsi3'      => $this->input->post('opsi3', true),
    'opsi4'      => $this->input->post('opsi4', true),
    'opsi5'      => $this->input->post('opsi5', true),
    'datetime'   => date('Y-m-d H:i:s'),
   );

   //UPLOAD GAMBAR
   $config['upload_path']   = './upload/image';
   $config['allowed_types'] = 'jpg|png|jpeg';
   $config['max_size']      = '2048';
   $config['remove_space']  = true;
   $config['file_name']     = 'g_' . time() . '.' . $ext;
   $this->load->library('upload', $config); // Load konfigurasi uploadnya
   if ($this->upload->do_upload('gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
    // Jika berhasil :

   } else {
    // Jika gagal :
    $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    return $return;
   }

   $this->Master_group_model->insert($data);
   $this->session->set_flashdata('message', 'Create Record Success 2');
   redirect(site_url('master_group'));
  }
 }

 public function update($id)
 {
  $row = $this->Master_group_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'     => 'Update',
    'action'     => site_url('master_group/update_action'),
    'kode_group' => set_value('kode_group', $row->kode_group),
    'nama_group' => set_value('nama_group', $row->nama_group),
    'gambar'     => set_value('gambar', $row->gambar),
    'keterangan' => set_value('keterangan', $row->keterangan),
    'opsi1'      => set_value('opsi1', $row->opsi1),
    'opsi2'      => set_value('opsi2', $row->opsi2),
    'opsi3'      => set_value('opsi3', $row->opsi3),
    'opsi4'      => set_value('opsi4', $row->opsi4),
    'opsi5'      => set_value('opsi5', $row->opsi5),
   );
   $this->template->load('template', 'master_group/master_group_form', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_group'));
  }
 }

 public function update_action()
 {
  $name = $_FILES["gambar"]["name"];
  $tmp  = explode(".", $name);
  $ext  = end($tmp); # extra () to prevent notice

  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->update($this->input->post('kode_group', true));
  } else {
   $data = array(
    'nama_group' => $this->input->post('nama_group', true),
    'gambar'     => 'g_' . time() . '.' . $ext,
    'keterangan' => $this->input->post('keterangan', true),
    'opsi1'      => $this->input->post('opsi1', true),
    'opsi2'      => $this->input->post('opsi2', true),
    'opsi3'      => $this->input->post('opsi3', true),
    'opsi4'      => $this->input->post('opsi4', true),
    'opsi5'      => $this->input->post('opsi5', true),
    'datetime'   => date('Y-m-d H:i:s'),
   );

   //UPLOAD GAMBAR
   $config['upload_path']   = './upload/image';
   $config['allowed_types'] = 'jpg|png|jpeg';
   $config['max_size']      = '2048';
   $config['remove_space']  = true;
   $config['file_name']     = 'g_' . time() . '.' . $ext;
   $this->load->library('upload', $config); // Load konfigurasi uploadnya
   if ($this->upload->do_upload('gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
    // Jika berhasil :

   } else {
    // Jika gagal :
    $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    return $return;
   }

   $this->Master_group_model->update($this->input->post('kode_group', true), $data);
   $this->session->set_flashdata('message', 'Update Record Success');
   redirect(site_url('master_group'));
  }
 }

 public function delete($id)
 {
  $row = $this->Master_group_model->get_by_id($id);

  if ($row) {

   $query = $this->db->query("SELECT kode_group FROM tab_barang WHERE kode_group = '$id'");
   if ($query->num_rows() == 0) {
    $this->Master_group_model->delete($id);
    $this->session->set_flashdata('success', 'Delete Record Success');
    redirect(site_url('master_group'));
   } else {
    $this->session->set_flashdata('error', 'Data tidak bisa dihapus karena masih ada master barang di dalamnya');
    redirect(site_url('master_group'));
   }
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_group'));
  }
 }

 public function _rules()
 {
  $this->form_validation->set_rules('nama_group', 'nama_group', 'trim|required');
  //$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
  $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
  // $this->form_validation->set_rules('opsi1', 'opsi1', 'trim|required');
  // $this->form_validation->set_rules('opsi2', 'opsi2', 'trim|required');
  // $this->form_validation->set_rules('opsi3', 'opsi3', 'trim|required');
  // $this->form_validation->set_rules('opsi4', 'opsi4', 'trim|required');
  // $this->form_validation->set_rules('opsi5', 'opsi5', 'trim|required');

  $this->form_validation->set_rules('kode_group', 'kode_group', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "master_group.xls";
  $judul     = "master_group";
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
  xlsWriteLabel($tablehead, $kolomhead++, "nama_group");
  xlsWriteLabel($tablehead, $kolomhead++, "Gambar");
  xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi1");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi2");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi3");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi4");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi5");

  foreach ($this->Master_group_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteLabel($tablebody, $kolombody++, $data->nama_group);
   xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
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

/* End of file Master_group.php */
/* Location: ./application/controllers/Master_group.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:51:51 */
/* http://harviacode.com */
