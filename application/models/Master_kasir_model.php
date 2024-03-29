<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Master_kasir_model extends CI_Model
{

 public $table = 'master_kasir';
 public $id    = 'kode_m_kasir';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json()
 {
  $this->datatables->select('master_kasir.kode_m_kasir,master_kasir.nama,master_kasir.alamat,master_kasir.kota,master_kasir.telp,master_kasir.PIC,master_kasir.url,master_kasir.keterangan,master_kasir.opsi1,master_kasir.opsi2,master_kasir.opsi3,master_kasir.opsi4,master_kasir.opsi5');
  $this->datatables->from('master_kasir');
  //add this line for join
  //$this->datatables->join('tab_kasir', 'master_kasir.kode_kasir = tab_kasir.kode_kasir');
  $this->datatables->add_column('action', anchor(site_url('master_kasir/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
            " . anchor(site_url('master_kasir/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
                " . anchor(site_url('master_kasir/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_m_kasir');
  return $this->datatables->generate();
 }

 // get all
 public function get_all()
 {
  $this->db->order_by($this->id, $this->order);
  return $this->db->get($this->table)->result();
 }

 // get data by id
 public function get_by_id($id)
 {

  $this->db->where($this->id, $id);
  return $this->db->get($this->table)->row();
 }

 // get total rows
 public function total_rows($q = null)
 {
  $this->db->like('kode_m_kasir', $q);
  $this->db->or_like('nama', $q);
  $this->db->or_like('alamat', $q);
  $this->db->or_like('kota', $q);
  $this->db->or_like('telp', $q);
  $this->db->or_like('PIC', $q);
  $this->db->or_like('url', $q);
  $this->db->or_like('keterangan', $q);
  $this->db->or_like('opsi1', $q);
  $this->db->or_like('opsi2', $q);
  $this->db->or_like('opsi3', $q);
  $this->db->or_like('opsi4', $q);
  $this->db->or_like('opsi5', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

 // get data with limit and search
 public function get_limit_data($limit, $start = 0, $q = null)
 {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('kode_m_kasir', $q);
  $this->db->or_like('nama', $q);
  $this->db->or_like('alamat', $q);
  $this->db->or_like('kota', $q);
  $this->db->or_like('telp', $q);
  $this->db->or_like('PIC', $q);
  $this->db->or_like('url', $q);
  $this->db->or_like('keterangan', $q);
  $this->db->or_like('opsi1', $q);
  $this->db->or_like('opsi2', $q);
  $this->db->or_like('opsi3', $q);
  $this->db->or_like('opsi4', $q);
  $this->db->or_like('opsi5', $q);
  $this->db->limit($limit, $start);
  return $this->db->get($this->table)->result();
 }

 // insert data
 public function insert($data)
 {
  $this->db->insert($this->table, $data);
 }

 // update data
 public function update($id, $data)
 {
  $this->db->where($this->id, $id);
  $this->db->update($this->table, $data);
 }

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }

}

/* End of file Master_kasir_model.php */
/* Location: ./application/models/Master_kasir_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:51:57 */
/* http://harviacode.com */
