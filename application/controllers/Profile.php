<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');        
        $this->session->set_flashdata('title', 'Profile | CV PUJI');   
	$this->load->library('datatables');
    } 
    
    function index(){
        $row = $this->User_model->get_by_id($this->session->userdata("id_users"));

        if ($row) {
            $data = array(
                'button'        => 'Update',
                'action'        => site_url('profile/update_action'),
		'id_users'      => set_value('id_users', $row->id_users),
		'full_name'     => set_value('full_name', $row->full_name),
		'password'      => set_value('password', $row->password),
	    );
            $this->template->load('template','user/tbl_user_pass', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }        
    }

    function update_action(){
        $id_users = $this->input->post('id_users',TRUE);
        $password = $this->input->post('password',TRUE);
        $hashPass = password_hash($password,PASSWORD_DEFAULT);

        $data = array(
            'password'      => $hashPass);
        $this->User_model->update($id_users, $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('welcome'));
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */