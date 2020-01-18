<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Tab_pricelist_model extends CI_Model
{

 public $table = 'tab_pricelist';
 public $id    = 'id_pricelist';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json()
 {
  $this->datatables->select('tab_kasir.nama as nama_kasir,tab_barang.nama as nama_barang,tab_pricelist.id_pricelist,tab_pricelist.kode_kasir,tab_pricelist.kode_barang,tab_pricelist.harga,tab_pricelist.keterangan,tab_pricelist.opsi1,tab_pricelist.opsi2,tab_pricelist.opsi3,tab_pricelist.opsi4,tab_pricelist.opsi5');
  $this->datatables->from('tab_pricelist');
  //add this line for join
  $this->datatables->join('tab_barang', 'tab_pricelist.kode_barang = tab_barang.kode_barang');
  $this->datatables->join('tab_kasir', 'tab_pricelist.kode_kasir = tab_kasir.kode_kasir');
  $this->datatables->group_by('tab_barang.kode_barang');
  $this->datatables->add_column('action', anchor(site_url('tab_pricelist/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')) . "
                " . anchor(site_url('tab_pricelist/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_barang');
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
  $this->db->where('kode_barang', $id);
  return $this->db->get($this->table)->row();
 }

 // get total rows
 public function total_rows($q = null)
 {
  $this->db->like('id_pricelist', $q);
  $this->db->or_like('kode_kasir', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('harga', $q);
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
  $this->db->like('id_pricelist', $q);
  $this->db->or_like('kode_kasir', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('harga', $q);
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
  $this->db->insert_batch($this->table, $data);
 }

 // update data
 public function update($data)
 {
  //$this->db->where('kode_barang', $id);
  $this->db->update_batch($this->table, $data, 'id_pricelist');
 }

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }

}

/* End of file Tab_pricelist_model.php */
/* Location: ./application/models/Tab_pricelist_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-04 02:52:12 */
/* http://harviacode.com */
