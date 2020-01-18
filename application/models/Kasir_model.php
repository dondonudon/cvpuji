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
 public function json($data1)
 {
  $kode_m_kasir = $data1['kode_m_kasir'];
  $hasil        = $this->db->query("SELECT tab_barang.nama, temp_trans.id_trans,temp_trans.notrans, temp_trans.kode_barang, temp_trans.kode_m_kasir, temp_trans.qty,temp_trans.harga, temp_trans.hpp, temp_trans.jumlah, temp_trans.jumlah_hpp, temp_trans.datetime FROM temp_trans INNER JOIN tab_barang ON tab_barang.kode_barang = temp_trans.kode_barang WHERE temp_trans.kode_m_kasir = '$kode_m_kasir'");
  return $hasil->result_array();
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

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }

 public function update($data, $id)
 {
  $this->db->where('id_trans', $id);
  $this->db->update('temp_trans', $data);
  $qty = $data['qty'];
  $hsl = $this->db->query("SELECT
                            tab_pricelist.harga, tab_barang.harga_kasir as hpp
                          FROM
                            tab_pricelist
                          INNER JOIN tab_kasir ON
                            tab_kasir.kode_kasir = tab_pricelist.kode_kasir
                          INNER JOIN tab_barang ON
                            tab_pricelist.kode_barang = tab_barang.kode_barang
                          WHERE
                            tab_pricelist.kode_barang = (SELECT kode_barang FROM temp_trans WHERE id_trans = '$id')
                            AND $qty BETWEEN tab_kasir.qty_a AND tab_kasir.qty_b")->result();
  foreach ($hsl as $data) {
   $hasil = array(
    'harga' => $data->harga,
    'hpp'   => $data->hpp,
   );

   $this->db->query("UPDATE temp_trans SET harga ='$hasil[harga]', hpp = '$hasil[hpp]', jumlah = '$hasil[harga]'*'$qty', jumlah_hpp = '$hasil[hpp]'*'$qty' WHERE id_trans = '$id'");
  }

 }

 //get harga
 public function get_harga($qty, $kode_barang)
 {
  // $a          = $this->db->query("SELECT kode_kasir FROM master_kasir WHERE kode_m_kasir = '$kode_m_kasir' ");
  // $ret        = $a->row();
  // $kode_kasir = $ret->kode_kasir;

  $hsl = $this->db->query("SELECT
                            tab_pricelist.harga, tab_barang.harga_kasir as hpp
                          FROM
                            tab_pricelist
                          INNER JOIN tab_kasir ON
                            tab_kasir.kode_kasir = tab_pricelist.kode_kasir
                          INNER JOIN tab_barang ON
                            tab_pricelist.kode_barang = tab_barang.kode_barang
                          WHERE
                            tab_pricelist.kode_barang = '$kode_barang'
                            AND $qty BETWEEN tab_kasir.qty_a AND tab_kasir.qty_b");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'harga' => $data->harga,
     'hpp'   => $data->hpp,
    );
   }
  }
  return $hasil;
 }

 public function get_barcode($barcode, $kode_m_kasir, $notrans)
 {
  $hsl = $this->db->query("SELECT
                              stock_m_kasir.kode_barang, stock_m_kasir.stok FROM stock_m_kasir
                              INNER JOIN tab_barang ON tab_barang.kode_barang = stock_m_kasir.kode_barang
                            WHERE
                              tab_barang.barcode = '$barcode'");
  $query = $hsl->row();
  $stok  = $query->stok;
  if ($hsl->num_rows() > 0 && $stok > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'kode_barang' => $data->kode_barang,
    );
    $datetime = date('Y-m-d H:i:s');

    $hsl2 = $this->db->query("SELECT
                            tab_pricelist.harga, tab_barang.harga_kasir as hpp
                          FROM
                            tab_pricelist
                          INNER JOIN tab_kasir ON
                            tab_kasir.kode_kasir = tab_pricelist.kode_kasir
                          INNER JOIN tab_barang ON
                            tab_pricelist.kode_barang = tab_barang.kode_barang
                          WHERE
                            tab_pricelist.kode_barang = '$hasil[kode_barang]'
                            AND 1 BETWEEN tab_kasir.qty_a AND tab_kasir.qty_b")->result();
    foreach ($hsl2 as $data2) {

     $this->db->query("INSERT INTO temp_trans (notrans, kode_barang, kode_m_kasir,qty,harga,jumlah,hpp,jumlah_hpp,datetime) VALUES
                      ('$notrans','$hasil[kode_barang]','$kode_m_kasir',1,'$data2->harga',1*$data2->harga,$data2->hpp,1*$data2->hpp,'$datetime')");
    }

   }
  } else {
   $hasil = array(
    'message' => false,
   );
  }
  return $hasil;

 }

 public function hapus_barang($id_trans)
 {
  $hasil = $this->db->query("DELETE FROM temp_trans WHERE id_trans='$id_trans'");
  return $hasil;
 }

 public function get_barang_by_kode($id_trans)
 {
  $hsl = $this->db->query("SELECT tab_barang.nama, temp_trans.id_trans, temp_trans.notrans, temp_trans.kode_barang, temp_trans.qty, temp_trans.datetime FROM temp_trans INNER JOIN tab_barang ON tab_barang.kode_barang=temp_trans.kode_barang
                         WHERE temp_trans.id_trans='$id_trans'");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'id_trans' => $data->id_trans,
     'nama'     => $data->nama,
     'qty'      => $data->qty,
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
 public function insert_trans($kode_m_kasir, $notrans)
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
  $q3         = $this->db->query("SELECT sum(jumlah) as jumlah, sum(jumlah_hpp) as jumlah_hpp FROM temp_trans WHERE notrans = '$notrans'");
  $hasil      = $q3->row();
  $jumlah     = $hasil->jumlah;
  $jumlah_hpp = $hasil->jumlah_hpp;

  if (!empty($notrans) && !empty($datetime)) {
   //insert trans
   $q4 = $this->db->query("INSERT into trans (notrans,kode_m_kasir,jumlah,jumlah_hpp,datetime) VALUES ('$notrans','$kode_m_kasir',$jumlah,$jumlah_hpp,'$datetime')");
  }

  //insert trans_detail
  $q5 = $this->db->query("INSERT INTO trans_detail (notrans, kode_barang, kode_m_kasir, qty, harga, hpp, jumlah, jumlah_hpp, datetime) SELECT notrans, kode_barang, kode_m_kasir, qty, harga, hpp, jumlah, jumlah_hpp, datetime FROM temp_trans WHERE kode_m_kasir = '$kode_m_kasir'");
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
