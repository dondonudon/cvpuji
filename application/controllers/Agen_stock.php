<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agen_stock extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Agen_stock_model');
        $this->load->library('form_validation');        
        $this->session->set_flashdata('title', 'Master Barang | CV PUJI');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'agen/stock_m_agen');
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Agen_stock_model->json();
    }

}

/* End of file Agen_stock.php */
/* Location: ./application/controllers/Agen_stock.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-13 04:30:24 */
/* http://harviacode.com */