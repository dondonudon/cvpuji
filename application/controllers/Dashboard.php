<?php
class Dashboard extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->session->set_flashdata('title', 'Dashboard | CV PUJI');
    }

    function index(){
        $this->load->view('dashboard/dashboard');
    }
}