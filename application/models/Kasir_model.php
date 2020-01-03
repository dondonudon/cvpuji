<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Kasir_model extends CI_Model
{

 public $table = 'temp_trans';
 public $id    = 'id_trans';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json($data)
 {
  $kode_m_kasir = $data['kode_m_kasir'];
  $this->datatables->select('tab_barang.nama,temp_trans.id_trans,temp_trans.notrans,temp_trans.kode_barang,temp_trans.kode_m_kasir,temp_trans.qty,temp_trans.harga,temp_trans.jumlah,temp_trans.datetime');
  $this->datatables->from('temp_trans');
//   $this->datatables->add_column('harga', '$1', 'rupiah(harga)');
  //   $this->datatables->add_column('jumlah', '$1', 'rupiah(jumlah)');
  //add this line for join
  $this->datatables->join('tab_barang', 'temp_trans.kode_barang = tab_barang.kode_barang');
  $this->datatables->add_column('action', anchor(site_url('kasir' . $kode_m_kasir . '/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_trans');
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
  $this->db->like('id_trans', $q);
  $this->db->or_like('notrans', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('kode_m_kasir', $q);
  $this->db->or_like('qty', $q);
  $this->db->or_like('harga', $q);
  $this->db->or_like('datetime', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

 // get data with limit and search
 public function get_limit_data($limit, $start = 0, $q = null)
 {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('id_trans', $q);
  $this->db->or_like('notrans', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('kode_m_kasir', $q);
  $this->db->or_like('qty', $q);
  $this->db->or_like('harga', $q);
  $this->db->or_like('datetime', $q);
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

 //get harga
 public function get_harga($qty, $kode_barang)
 {
  // $a          = $this->db->query("SELECT kode_kasir FROM master_kasir WHERE kode_m_kasir = '$kode_m_kasir' ");
  // $ret        = $a->row();
  // $kode_kasir = $ret->kode_kasir;

  $hsl = $this->db->query("SELECT
                            harga
                          FROM
                            tab_pricelist
                          inner join tab_kasir on
                            tab_kasir.kode_kasir = tab_pricelist.kode_kasir
                          WHERE
                            tab_pricelist.kode_barang = '$kode_barang'
                            AND $qty BETWEEN tab_kasir.qty_a AND tab_kasir.qty_b");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'harga' => $data->harga,
    );
   }
  }
  return $hasil;
 }

 public function get_group()
 {
  $this->db->order_by('kode_group', 'asc');
  return $this->db->get('master_group')->result();
 }

 public function get_barang()
 {
  // kita joinkan tabel barang dengan group
  $this->db->order_by('kode_barang', 'asc');
  $this->db->join('master_group', 'master_group.kode_group = tab_barang.kode_group');
  return $this->db->get('tab_barang')->result();
 }

 // insert data
 public function insert_trans($kode_m_kasir)
 {

  $q1 = $this->db->query("SELECT * FROM temp_trans WHERE kode_m_kasir = '$kode_m_kasir'");

  foreach ($q1->result_array() as $row) {
   $notrans      = $row['notrans'];
   $kode_m_kasir = $row['kode_m_kasir'];
   $datetime     = $row['datetime'];
   $kode_barang  = $row['kode_barang'];
   $qty          = $row['qty'];

   $hsl  = $this->db->query("SELECT * FROM stock_m_kasir WHERE kode_m_kasir = '$kode_m_kasir' AND kode_barang = '$kode_barang' ");
   $ret  = $hsl->row();
   $stok = $ret->stok;

   //update stok kasir
   $stok_akhir = $stok - $qty;
   $q2         = $this->db->query("UPDATE stock_m_kasir SET stok = '$stok_akhir' WHERE kode_m_kasir = '$kode_m_kasir' AND kode_barang = '$kode_barang' ");

  }
  //select jumlah trans
  $q3     = $this->db->query("SELECT sum(jumlah) as jumlah FROM temp_trans WHERE notrans = '$notrans'");
  $hasil  = $q3->row();
  $jumlah = $hasil->jumlah;

  //insert trans
  $q4 = $this->db->query("INSERT into trans (notrans,kode_m_kasir,jumlah,datetime) VALUES ('$notrans','$kode_m_kasir',$jumlah,'$datetime')");
  //insert trans_detail
  $q5 = $this->db->query("INSERT INTO trans_detail (notrans, kode_barang, kode_m_kasir, qty, harga, jumlah, datetime) SELECT notrans, kode_barang, kode_m_kasir, qty, harga, jumlah, datetime FROM temp_trans WHERE kode_m_kasir = '$kode_m_kasir'");
  //insert log
  $q6 = $this->db->query("INSERT INTO log (ket, kode_barang, kode_m_kasir, qty, tipe, datetime) SELECT notrans, kode_barang, kode_m_kasir, qty ,'C' AS tipe, datetime FROM temp_trans WHERE kode_m_kasir = '$kode_m_kasir'");
  //delete temp_trans
  $q7 = $this->db->query("DELETE FROM temp_trans WHERE kode_m_kasir = '$kode_m_kasir'");

  //$q5=$this->db->query("DELETE FROM trans WHERE notrans = ''");

  //UPDATE COUNTER A
  $query    = $this->db->query("SELECT counter FROM counter WHERE id='A'");
  $ret      = $query->row();
  $_counter = $ret->counter;
  $_counter++;
  $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='A'");
  //END UPDATE COUNTER A

  //PRINT

 }

}

/* End of file Temp_Kasir1_trans_model.php */
/* Location: ./application/models/Temp_Kasir1_trans_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-06 08:08:59 */
/* http://harviacode.com */
