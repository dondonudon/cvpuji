<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Retur_kasir_model extends CI_Model
{

 public $table = 'master_stok_kasir';
 public $id    = 'id_s_kasir';
 public $order = 'DESC';

 public function __construct()
 {
  parent::__construct();
 }

 // datatables
 public function json()
 {
  $this->datatables->select('master_kasir.nama, master_stok_kasir.id_s_kasir, master_stok_kasir.nostokkasir, master_stok_kasir.kode_m_kasir, master_stok_kasir.id_user, master_stok_kasir.datetime');
  $this->datatables->from('master_stok_kasir');
  //add this line for join
  $this->datatables->join('master_kasir', 'master_stok_kasir.kode_m_kasir = master_kasir.kode_m_kasir');
  $this->datatables->where('master_stok_kasir.retur', 1);
  //$this->datatables->join('tab_barang', 'master_stok_kasir.kode_barang = tab_barang.kode_barang');
  $this->datatables->add_column('action', anchor(site_url('retur_kasir/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'nostokkasir');
  // $this->datatables->add_column('action', anchor(site_url('master_stok_kasir/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))."
  //     ".anchor(site_url('master_stok_kasir/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))."
  //         ".anchor(site_url('master_stok_kasir/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_s_kasir');
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
  $this->db->like('id_s_kasir', $q);
  $this->db->or_like('kode_m_kasir', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('stok', $q);
  $this->db->or_like('datetime', $q);
  $this->db->from($this->table);
  return $this->db->count_all_results();
 }

 // get data with limit and search
 public function get_limit_data($limit, $start = 0, $q = null)
 {
  $this->db->order_by($this->id, $this->order);
  $this->db->like('id_s_kasir', $q);
  $this->db->or_like('kode_m_kasir', $q);
  $this->db->or_like('kode_barang', $q);
  $this->db->or_like('stok', $q);
  $this->db->or_like('datetime', $q);
  $this->db->limit($limit, $start);
  return $this->db->get($this->table)->result();
 }

 // insert data
 public function insert($data)
 {
  $this->db->insert($this->table, $data);
  //INSERT LOG
  $data2 = array(
   'kode_m_kasir' => $data['kode_m_kasir'],
   'kode_barang'  => $data['kode_barang'],
   'qty'          => $data['stok'],
   'datetime'     => $data['datetime'],
   'tipe'         => 'B',
  );
  $this->db->insert('log', $data2);
  //END INSERT LOG

  //UPDATE STOK KASIR
  $kode_m_kasir = $data['kode_m_kasir'];
  $kode_barang  = $data['kode_barang'];
  $_stok        = $data['stok'];

  $hsl = $this->db->query("SELECT * FROM stock_m_kasir WHERE kode_m_kasir = '$kode_m_kasir' AND kode_barang = '$kode_barang' ");
  $ret = $hsl->row();
  //$stok = $ret->stok;

  // echo $hsl;
  if ($hsl->num_rows() > 0) {
   $stok_akhir = $ret->stok + $_stok;
   $this->db->set('stok', $stok_akhir);
   $this->db->where('kode_m_kasir', $kode_m_kasir);
   $this->db->where('kode_barang', $kode_barang);
   $this->db->update('stock_m_kasir');
  } else {
   $this->db->insert('stock_m_kasir', $data);
  }
  //END UPDATE STOK KASIR
 }

 // update data
 public function update($id, $data)
 {
  $this->db->where($this->id, $id);
  $this->db->update($this->table, $data);
 }

 //get stok
 public function get_stok($kode_m_kasir, $kode_barang)
 {
  $hsl = $this->db->query("SELECT
                                ifnull(stok,0) as stok
                            FROM
                                stock_m_kasir
                            WHERE
                                kode_m_kasir = '$kode_m_kasir' AND kode_barang='$kode_barang'");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'stok' => $data->stok,
    );
   }
  } else {
   $hasil = array(
    'stok' => 0,
   );
  }
  return $hasil;
 }

 // delete data
 public function delete($id)
 {
  $this->db->where($this->id, $id);
  $this->db->delete($this->table);
 }

 public function barang_list()
 {
  $hasil = $this->db->query("SELECT tab_barang.nama, temp_master_stok_kasir.id_s_kasir, temp_master_stok_kasir.nostokkasir, temp_master_stok_kasir.kode_barang, temp_master_stok_kasir.stok, temp_master_stok_kasir.min_stok, temp_master_stok_kasir.datetime FROM temp_master_stok_kasir INNER JOIN tab_barang ON tab_barang.kode_barang=temp_master_stok_kasir.kode_barang WHERE retur = '1'");
  return $hasil->result();
 }

 public function simpan_barang($kode_barang, $stok, $noreturkasir, $datetime)
 {
  $hasil = $this->db->query("INSERT INTO temp_master_stok_kasir (nostokkasir,kode_barang,stok,retur,datetime)VALUES('$noreturkasir','$kode_barang','$stok','1','$datetime')");
  return $hasil;
 }

 public function get_barang_by_kode($id_s_kasir)
 {
  $hsl = $this->db->query("SELECT tab_barang.nama, temp_master_stok_kasir.id_s_kasir, temp_master_stok_kasir.nostokkasir, temp_master_stok_kasir.kode_barang, temp_master_stok_kasir.stok, temp_master_stok_kasir.min_stok, temp_master_stok_kasir.datetime FROM temp_master_stok_kasir INNER JOIN tab_barang ON tab_barang.kode_barang=temp_master_stok_kasir.kode_barang
                         WHERE temp_master_stok_kasir.id_s_kasir='$id_s_kasir'");
  if ($hsl->num_rows() > 0) {
   foreach ($hsl->result() as $data) {
    $hasil = array(
     'id_s_kasir' => $data->id_s_kasir,
     'nama'       => $data->nama,
     'stok'       => $data->stok,
    );
   }
  }
  return $hasil;
 }

 public function update_barang($stok, $id_s_kasir)
 {
  $hasil = $this->db->query("UPDATE temp_master_stok_kasir SET stok='$stok' WHERE id_s_kasir='$id_s_kasir'");
  return $hasil;
 }

 public function hapus_barang($id_s_kasir)
 {
  $hasil = $this->db->query("DELETE FROM temp_master_stok_kasir WHERE id_s_kasir='$id_s_kasir'");
  return $hasil;
 }
 public function insert_trans($notrans, $kode_m_kasir, $id_user, $datetime)
 {
  //UPDATE STOK
  $cek = $this->db->query("SELECT kode_barang, stok FROM temp_master_stok_kasir WHERE kode_barang IN ( SELECT kode_barang FROM stock_m_kasir WHERE kode_m_kasir = '$kode_m_kasir')")->result_array();
  if (count($cek) > 0) {
   foreach ($cek as $row) {
    $kode_barang = $row['kode_barang'];
    $stokTambah  = $row['stok'];
    $cek2        = $this->db->query("SELECT * FROM stock_m_kasir WHERE kode_barang = '$kode_barang' AND kode_m_kasir='$kode_m_kasir'")->result_array();
    foreach ($cek2 as $row2) {
     $kode_barang2 = $row2['kode_barang'];
     $stokAwal     = $row2['stok'];
     $stokAkhir    = $stokAwal - $stokTambah;
     $this->db->query("UPDATE stock_m_kasir SET stok='$stokAkhir' WHERE kode_barang = '$kode_barang' AND kode_m_kasir='$kode_m_kasir'");
    }
   }
  } else {
   $this->db->query("INSERT INTO stock_m_kasir (kode_m_kasir,kode_barang,stok,datetime) SELECT '$kode_m_kasir',kode_barang,stok,datetime FROM temp_master_stok_kasir  WHERE nostokkasir = '$notrans' ");
  }
  // END UPDATE STOK

  //insert into master_stok_kasir
  $q3 = $this->db->query("INSERT into master_stok_kasir (nostokkasir, kode_m_kasir, id_user,retur, datetime) VALUES ('$notrans', '$kode_m_kasir', '$id_user','1', '$datetime')");
  //insert into master_stok_kasir_detail
  $q4 = $this->db->query("INSERT into master_stok_kasir_detail (nostokkasir, kode_barang, stok, min_stok,retur, datetime) SELECT nostokkasir, kode_barang, stok, min_stok,'1', datetime FROM temp_master_stok_kasir WHERE nostokkasir = '$notrans'");
  //delete temp_master_stok_kasir
  $q5 = $this->db->query("DELETE FROM temp_master_stok_kasir WHERE nostokkasir='$notrans'");

  //INSERT LOG
  $log = $this->db->query("SELECT * FROM master_stok_kasir_detail WHERE nostokkasir = '$notrans'")->result_array();
  foreach ($log as $data) {
   $kode_barang = $data['kode_barang'];
   $ket         = $notrans;
   $qty         = $data['stok'];
   $datetime    = date('Y-m-d H:i:s');
   $this->db->query("INSERT INTO log (ket, kode_m_kasir, kode_barang, qty, tipe, datetime) VALUES ('$ket', '$kode_m_kasir', '$kode_barang', '$qty', 'D', '$datetime')");
  }
  //END INSERT LOG

  //UPDATE COUNTER D
  $query    = $this->db->query("SELECT counter FROM counter WHERE id='D'");
  $ret      = $query->row();
  $_counter = $ret->counter;
  $_counter++;
  $query = $this->db->query("UPDATE counter SET counter = '$_counter' WHERE id='D'");
  //END UPDATE COUNTER D

 }

}

/* End of file Master_stok_kasir_model.php */
/* Location: ./application/models/Master_stok_kasir_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-05 03:50:29 */
/* http://harviacode.com */
