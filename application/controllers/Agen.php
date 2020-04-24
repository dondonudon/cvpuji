<?php
class Agen extends CI_Controller
{

function __construct()
{
    parent::__construct();
    $this->load->model('Agen_model');
    $this->load->library('form_validation');        
    $this->session->set_flashdata('title', 'Entry Rekap | CV PUJI');        
$this->load->library('datatables');
}

 public function index()
 {
  $this->template->load('template', 'agen/entry_rekap');
 }

 public function json()
 {
     header('Content-Type: application/json');
     echo $this->Agen_model->json();
 }
}
