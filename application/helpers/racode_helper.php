<?php
function cmb_dinamis($name, $table, $field, $pk, $selected = null, $order = null)
{
 $ci  = get_instance();
 $cmb = "<select name='$name' class='form-control'>";
 if ($order) {
  $ci->db->order_by($field, $order);
 }
 $data = $ci->db->get($table)->result();
 foreach ($data as $d) {
  $cmb .= "<option value='" . $d->$pk . "'";
  $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
  $cmb .= ">" . strtoupper($d->$field) . "</option>";
 }
 $cmb .= "</select>";
 return $cmb;
}

function select2_dinamis($name, $table, $field, $pk, $placeholder)
{
 $ci      = get_instance();
 $select2 = '<select id="' . $name . '" name="' . $name . '" class="form-control select2 select2-hidden-accessible" data-placeholder="' . $placeholder . '" style="width: 100%;" tabindex="-1" aria-hidden="true" required>';
 $data    = $ci->db->get($table)->result();
 $select2 .= ' <option></option>';
 foreach ($data as $row) {
  $select2 .= ' <option value=' . $row->$pk . '>' . $row->$field . '</option>';
 }
 $select2 .= '</select>';
 return $select2;
}

function select2_dinamis_multiple($name, $table, $field, $pk, $placeholder)
{
 $ci      = get_instance();
 $select2 = '<select name="' . $name . '" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="' . $placeholder . '" style="width: 100%;" tabindex="-1" aria-hidden="true">';
 $data    = $ci->db->get($table)->result();
 $select2 .= ' <option></option>';
 foreach ($data as $row) {
  $select2 .= ' <option value=' . $row->$pk . '>' . $row->$field . '</option>';
 }
 $select2 .= '</select>';
 return $select2;
}

function datalist_dinamis($name, $table, $field, $value = null)
{
 $ci     = get_instance();
 $string = '<input value="' . $value . '" name="' . $name . '" list="' . $name . '" class="form-control">
    <datalist id="' . $name . '">';
 $data = $ci->db->get($table)->result();
 foreach ($data as $row) {
  $string .= '<option value="' . $row->$field . '">';
 }
 $string .= '</datalist>';
 return $string;
}

function rename_string_is_aktif($string)
{
 return $string == 'y' ? 'Aktif' : 'Tidak Aktif';
}

function is_login()
{
 $ci = get_instance();
 if (!$ci->session->userdata('id_users')) {
  redirect('auth');
 } else {
  $modul = $ci->uri->segment(1);

  $id_user_level = $ci->session->userdata('id_user_level');
  // dapatkan id menu berdasarkan nama controller
  $menu    = $ci->db->get_where('tbl_menu', array('url' => $modul))->row_array();
  $id_menu = $menu['id_menu'];
  // chek apakah user ini boleh mengakses modul ini
  $hak_akses = $ci->db->get_where('tbl_hak_akses', array('id_menu' => $id_menu, 'id_user_level' => $id_user_level));
  if ($hak_akses->num_rows() < 1) {
   redirect('auth');
   exit;
  }
 }
}

function alert($class, $title, $description)
{
 return '<div class="alert ' . $class . ' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> ' . $title . '</h4>
                ' . $description . '
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level, $id_menu)
{
 $ci = get_instance();
 $ci->db->where('id_user_level', $id_user_level);
 $ci->db->where('id_menu', $id_menu);
 $data = $ci->db->get('tbl_hak_akses');
 if ($data->num_rows() > 0) {
  return "checked='checked'";
 }
}

function autocomplate_json($table, $field)
{
 $ci = get_instance();
 $ci->db->like($field, $_GET['term']);
 $ci->db->select($field);
 $collections = $ci->db->get($table)->result();
 foreach ($collections as $collection) {
  $return_arr[] = $collection->$field;
 }
 echo json_encode($return_arr);
}

function notrans()
{
 // mencari kode barang dengan nilai paling besar
 $ci         = get_instance();
 $query      = $ci->db->query("SELECT id, max(counter) as maxKode FROM counter WHERE id='A'");
 $ret        = $query->row();
 $kodeBarang = $ret->maxKode;
 $tipe       = $ret->id;

 // mengambil angka atau bilangan dalam kode anggota terbesar,
 // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
 // misal 'BRG001', akan diambil '001'
 // setelah substring bilangan diambil lantas dicasting menjadi integer
 //$noUrut = (int) substr($kodeBarang, 3, 3);

 // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 $kodeBarang++;

 // membentuk kode anggota baru
 // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
 // misal sprintf("%03s", 12); maka akan dihasilkan '012'
 // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
 $year       = date('Y');
 $month      = date('m');
 $kodeBarang = $tipe . $year . $month . sprintf("%04s", $kodeBarang);
 return $kodeBarang;
}

function nostockopname()
{
 // mencari kode barang dengan nilai paling besar
 $ci         = get_instance();
 $query      = $ci->db->query("SELECT id, max(counter) as maxKode FROM counter WHERE id='B'");
 $ret        = $query->row();
 $kodeBarang = $ret->maxKode;
 $tipe       = $ret->id;

 // mengambil angka atau bilangan dalam kode anggota terbesar,
 // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
 // misal 'BRG001', akan diambil '001'
 // setelah substring bilangan diambil lantas dicasting menjadi integer
 //$noUrut = (int) substr($kodeBarang, 3, 3);

 // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 $kodeBarang++;

 // membentuk kode anggota baru
 // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
 // misal sprintf("%03s", 12); maka akan dihasilkan '012'
 // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
 $year       = date('Y');
 $month      = date('m');
 $kodeBarang = $tipe . $year . $month . sprintf("%04s", $kodeBarang);
 return $kodeBarang;
}

function nostokkasir()
{
 // mencari kode barang dengan nilai paling besar
 $ci         = get_instance();
 $query      = $ci->db->query("SELECT id, max(counter) as maxKode FROM counter WHERE id='C'");
 $ret        = $query->row();
 $kodeBarang = $ret->maxKode;
 $tipe       = $ret->id;

 // mengambil angka atau bilangan dalam kode anggota terbesar,
 // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
 // misal 'BRG001', akan diambil '001'
 // setelah substring bilangan diambil lantas dicasting menjadi integer
 //$noUrut = (int) substr($kodeBarang, 3, 3);

 // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 $kodeBarang++;

 // membentuk kode anggota baru
 // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
 // misal sprintf("%03s", 12); maka akan dihasilkan '012'
 // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
 $year       = date('Y');
 $month      = date('m');
 $kodeBarang = $tipe . $year . $month . sprintf("%04s", $kodeBarang);
 return $kodeBarang;
}

function noreturkasir()
{
 // mencari kode barang dengan nilai paling besar
 $ci         = get_instance();
 $query      = $ci->db->query("SELECT id, max(counter) as maxKode FROM counter WHERE id='D'");
 $ret        = $query->row();
 $kodeBarang = $ret->maxKode;
 $tipe       = $ret->id;

 // mengambil angka atau bilangan dalam kode anggota terbesar,
 // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
 // misal 'BRG001', akan diambil '001'
 // setelah substring bilangan diambil lantas dicasting menjadi integer
 //$noUrut = (int) substr($kodeBarang, 3, 3);

 // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 $kodeBarang++;

 // membentuk kode anggota baru
 // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
 // misal sprintf("%03s", 12); maka akan dihasilkan '012'
 // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
 $year       = date('Y');
 $month      = date('m');
 $kodeBarang = $tipe . $year . $month . sprintf("%04s", $kodeBarang);
 return $kodeBarang;
}

function rupiah($angka)
{

 $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
 return $hasil_rupiah;

}
