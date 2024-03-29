<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Kasir_trans_model extends CI_Model
{

 public $table = 'trans';
 public $id    = 'id_trans';

 //var $table = 'customers';
 public $column_order  = array(null, 'notrans', 'datetime'); //set column field database for datatable orderable
 public $column_search = array('notrans', 'datetime'); //set column field database for datatable searchable
 //var $order = array('id' => 'asc'); // default order
 //public $order = 'DESC';

 //var $table = 'customers';

 public function __construct()
 {
  parent::__construct();
 }

 private function _get_datatables_query($kode_m_kasir)
 {

  //add custom filter here
  $tgl_a = $this->input->post('tgl_a') . " 00:00:00";
  $tgl_b = $this->input->post('tgl_b') . " 23:59:59";
  if ($this->input->post('tgl_a') && $this->input->post('tgl_b')) {
   $this->db->where('trans.datetime >=', $tgl_a);
   $this->db->where('trans.datetime <=', $tgl_b);
  }
  $this->db->where('trans.kode_m_kasir',$kode_m_kasir);
  $this->db->from($this->table);
  //$this->db->join('trans_detail', 'trans_detail.notrans = trans.notrans');
  //$this->db->join('tab_barang', 'tab_barang.kode_barang = trans_detail.kode_barang');
  $i = 0;

  foreach ($this->column_search as $item) // loop column
  {
   if ($_POST['search']['value']) // if datatable send POST for search
   {

    if ($i === 0) // first loop
    {
     $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
     $this->db->like($item, $_POST['search']['value']);
    } else {
     $this->db->or_like($item, $_POST['search']['value']);
    }

    if (count($this->column_search) - 1 == $i) //last loop
    {
     $this->db->group_end();
    }
    //close bracket
   }
   $i++;
  }

  if (isset($_POST['order'])) // here order processing
  {
   $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  } else if (isset($this->order)) {
   $order = $this->order;
   $this->db->order_by(key($order), $order[key($order)]);
  }
 }

 public function get_datatables($kode_m_kasir)
 {
  $this->_get_datatables_query($kode_m_kasir);
  if ($_POST['length'] != -1) {
   $this->db->limit($_POST['length'], $_POST['start']);
  }

  $query = $this->db->get();
  return $query->result();
 }

 public function count_filtered($kode_m_kasir)
 {
  $this->_get_datatables_query($kode_m_kasir);
  $query = $this->db->get();
  return $query->num_rows();
 }

 public function count_all($kode_m_kasir)
 {
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

}

/* End of file Absen_model.php */
/* Location: ./application/models/Absen_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */
