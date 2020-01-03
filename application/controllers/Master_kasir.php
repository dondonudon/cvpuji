<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Master_kasir extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Master_kasir_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Master Kasir | CV PUJI');
  $this->load->library('datatables');
 }

 public function index()
 {
  $this->template->load('template', 'master_kasir/master_kasir_list');
 }

 public function json()
 {
  header('Content-Type: application/json');
  echo $this->Master_kasir_model->json();
 }

 public function read($id)
 {
  $row = $this->Master_kasir_model->get_by_id($id);
  if ($row) {
   $data = array(
    'kode_m_kasir' => $row->kode_m_kasir,
    'nama'         => $row->nama,
    'alamat'       => $row->alamat,
    'kota'         => $row->kota,
    'telp'         => $row->telp,
    'PIC'          => $row->PIC,
    'url'          => $row->url,
    'keterangan'   => $row->keterangan,
    'opsi1'        => $row->opsi1,
    'opsi2'        => $row->opsi2,
    'opsi3'        => $row->opsi3,
    'opsi4'        => $row->opsi4,
    'opsi5'        => $row->opsi5,
   );
   $this->template->load('template', 'master_kasir/master_kasir_read', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_kasir'));
  }
 }

 public function create()
 {
  $data = array(
   'button'       => 'Create',
   'action'       => site_url('master_kasir/create_action'),
   'kode_m_kasir' => set_value('kode_m_kasir'),
   'nama'         => set_value('nama'),
   'alamat'       => set_value('alamat'),
   'kota'         => set_value('kota'),
   'telp'         => set_value('telp'),
   'PIC'          => set_value('PIC'),
   'url'          => set_value('url'),
   'keterangan'   => set_value('keterangan'),
   'opsi1'        => set_value('opsi1'),
   'opsi2'        => set_value('opsi2'),
   'opsi3'        => set_value('opsi3'),
   'opsi4'        => set_value('opsi4'),
   'opsi5'        => set_value('opsi5'),
  );
  $this->template->load('template', 'master_kasir/master_kasir_form', $data);
 }

 public function create_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->create();
  } else {
   $data = array(
    'nama'       => $this->input->post('nama', true),
    'alamat'     => $this->input->post('alamat', true),
    'kota'       => $this->input->post('kota', true),
    'telp'       => $this->input->post('telp', true),
    'PIC'        => $this->input->post('PIC', true),
    'url'        => $this->input->post('url', true),
    'keterangan' => $this->input->post('keterangan', true),
    'opsi1'      => $this->input->post('opsi1', true),
    'opsi2'      => $this->input->post('opsi2', true),
    'opsi3'      => $this->input->post('opsi3', true),
    'opsi4'      => $this->input->post('opsi4', true),
    'opsi5'      => $this->input->post('opsi5', true),
    'datetime'   => date('Y-m-d H:i:s'),
   );

   $this->Master_kasir_model->insert($data);
   $this->session->set_flashdata('message', 'Create Record Success 2');
   redirect(site_url('master_kasir'));
  }
 }

 public function update($id)
 {
  $row = $this->Master_kasir_model->get_by_id($id);

  if ($row) {
   $data = array(
    'button'       => 'Update',
    'action'       => site_url('master_kasir/update_action'),
    'kode_m_kasir' => set_value('kode_m_kasir', $row->kode_m_kasir),

    'nama'         => set_value('nama', $row->nama),
    'alamat'       => set_value('alamat', $row->alamat),
    'kota'         => set_value('kota', $row->kota),
    'telp'         => set_value('telp', $row->telp),
    'PIC'          => set_value('PIC', $row->PIC),
    'url'          => set_value('url', $row->url),
    'keterangan'   => set_value('keterangan', $row->keterangan),
    'opsi1'        => set_value('opsi1', $row->opsi1),
    'opsi2'        => set_value('opsi2', $row->opsi2),
    'opsi3'        => set_value('opsi3', $row->opsi3),
    'opsi4'        => set_value('opsi4', $row->opsi4),
    'opsi5'        => set_value('opsi5', $row->opsi5),
   );
   $this->template->load('template', 'master_kasir/master_kasir_form', $data);
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_kasir'));
  }
 }

 public function update_action()
 {
  $this->_rules();

  if ($this->form_validation->run() == false) {
   $this->update($this->input->post('kode_m_kasir', true));
  } else {
   $data = array(
    'nama'       => $this->input->post('nama', true),
    'alamat'     => $this->input->post('alamat', true),
    'kota'       => $this->input->post('kota', true),
    'telp'       => $this->input->post('telp', true),
    'PIC'        => $this->input->post('PIC', true),
    'url'        => $this->input->post('url', true),
    'keterangan' => $this->input->post('keterangan', true),
    'opsi1'      => $this->input->post('opsi1', true),
    'opsi2'      => $this->input->post('opsi2', true),
    'opsi3'      => $this->input->post('opsi3', true),
    'opsi4'      => $this->input->post('opsi4', true),
    'opsi5'      => $this->input->post('opsi5', true),
    'datetime'   => date('Y-m-d H:i:s'),
   );

   $this->Master_kasir_model->update($this->input->post('kode_m_kasir', true), $data);
   $this->session->set_flashdata('message', 'Update Record Success');
   redirect(site_url('master_kasir'));
  }
 }

 public function delete($id)
 {
  $row = $this->Master_kasir_model->get_by_id($id);

  if ($row) {
   $this->Master_kasir_model->delete($id);
   $this->session->set_flashdata('message', 'Delete Record Success');
   redirect(site_url('master_kasir'));
  } else {
   $this->session->set_flashdata('message', 'Record Not Found');
   redirect(site_url('master_kasir'));
  }
 }

 public function _rules()
 {
  $this->form_validation->set_rules('nama', 'nama', 'trim|required');
  $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
  $this->form_validation->set_rules('kota', 'kota', 'trim|required');
  $this->form_validation->set_rules('telp', 'telp', 'trim|required');
  $this->form_validation->set_rules('PIC', 'pic', 'trim|required');
  $this->form_validation->set_rules('url', 'url', 'trim|required');
  $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
  // $this->form_validation->set_rules('opsi1', 'opsi1', 'trim|required');
  // $this->form_validation->set_rules('opsi2', 'opsi2', 'trim|required');
  // $this->form_validation->set_rules('opsi3', 'opsi3', 'trim|required');
  // $this->form_validation->set_rules('opsi4', 'opsi4', 'trim|required');
  // $this->form_validation->set_rules('opsi5', 'opsi5', 'trim|required');

  $this->form_validation->set_rules('kode_m_kasir', 'kode_m_kasir', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

 public function excel()
 {
  $this->load->helper('exportexcel');
  $namaFile  = "master_kasir.xls";
  $judul     = "master_kasir";
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
  xlsWriteLabel($tablehead, $kolomhead++, "Nama");
  xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
  xlsWriteLabel($tablehead, $kolomhead++, "Kota");
  xlsWriteLabel($tablehead, $kolomhead++, "Telp");
  xlsWriteLabel($tablehead, $kolomhead++, "PIC");
  xlsWriteLabel($tablehead, $kolomhead++, "Url");
  xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi1");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi2");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi3");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi4");
  xlsWriteLabel($tablehead, $kolomhead++, "Opsi5");

  foreach ($this->Master_kasir_model->get_all() as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
   xlsWriteLabel($tablebody, $kolombody++, $data->kota);
   xlsWriteLabel($tablebody, $kolombody++, $data->telp);
   xlsWriteLabel($tablebody, $kolombody++, $data->PIC);
   xlsWriteLabel($tablebody, $kolombody++, $data->url);
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

/* End of file Master_kasir.php */
/* Location: ./application/controllers/Master_kasir.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:51:57 */
/* http://harviacode.com */
