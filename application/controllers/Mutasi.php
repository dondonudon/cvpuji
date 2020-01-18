<?php

if (!defined('BASEPATH')) {
 exit('No direct script access allowed');
}

class Mutasi extends CI_Controller
{
 public function __construct()
 {
  parent::__construct();
  is_login();
  $this->load->model('Mutasi_model');
  $this->load->library('form_validation');
  $this->session->set_flashdata('title', 'Mutasi | CV PUJI');
  $this->load->library('datatables');
  $this->load->library('pagination');
 }

 public function index()
 {

  $this->template->load('template', 'mutasi/mutasi_list');
  //$this->load->view('Layout/Template', $data);
 }

 public function get()
 {
  $tgl_a = $_POST['tanggal_a'];
  $tgl_b = $_POST['tanggal_b'];
  $tgl   = array(
   'tgl_a' => $tgl_a,
   'tgl_b' => $tgl_b,
  );
  // $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
  //$url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
  $transaksi = $this->Mutasi_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Mutasi_model

  // $data['ket'] = $ket;
  // $data['url_cetak'] = base_url('index.php/'.$url_cetak);
  $data['transaksi'] = $transaksi;
  $this->template->load('template', 'mutasi/mutasi_list', $data);

 }

 public function cetak()
 {
  if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
   $filter = $_GET['filter']; // Ambil data filder yang dipilih user

   if ($filter == '1') { // Jika filter nya 1 (per tanggal)
    $tgl = $_GET['tanggal'];

    $ket       = 'Data Transaksi Tanggal ' . date('d-m-y', strtotime($tgl));
    $transaksi = $this->Mutasi_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Mutasi_model
   } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
    $bulan      = $_GET['bulan'];
    $tahun      = $_GET['tahun'];
    $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $ket       = 'Data Transaksi Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
    $transaksi = $this->Mutasi_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Mutasi_model
   } else { // Jika filter nya 3 (per tahun)
    $tahun = $_GET['tahun'];

    $ket       = 'Data Transaksi Tahun ' . $tahun;
    $transaksi = $this->Mutasi_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di Mutasi_model
   }
  } else { // Jika user tidak mengklik tombol tampilkan
   $ket       = 'Semua Data Transaksi';
   $transaksi = $this->Mutasi_model->view_all(); // Panggil fungsi view_all yang ada di Mutasi_model
  }

  $data['ket']       = $ket;
  $data['transaksi'] = $transaksi;

  ob_start();
  $this->load->view('print', $data);
  $html = ob_get_contents();
  ob_end_clean();

  require_once './assets/html2pdf/html2pdf.class.php';
  $pdf = new HTML2PDF('P', 'A4', 'en');
  $pdf->WriteHTML($html);
  $pdf->Output('Data Transaksi.pdf', 'D');
 }

 public function excel()
 {
  $tanggal_a = $_POST['tanggal_a'];
  $tanggal_b = $_POST['tanggal_b'];

  $this->load->helper('exportexcel');
  $namaFile  = "mutasi.xls";
  $judul     = "mutasi";
  $tablehead = 0;
  $tablebody = 1;
  $nourut    = 1;
  //penulisan header
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=" . $namaFile . "");
  header("Content-Transfer-Encoding: binary ");

  xlsBOF();

  $kolomhead = 0;
  xlsWriteLabel($tablehead, $kolomhead++, "No");
  xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
  xlsWriteLabel($tablehead, $kolomhead++, "Saldo Awal");
  xlsWriteLabel($tablehead, $kolomhead++, "Masuk");
  xlsWriteLabel($tablehead, $kolomhead++, "Keluar");
  xlsWriteLabel($tablehead, $kolomhead++, "Akhir");
  xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

  foreach ($this->Mutasi_model->excel($tanggal_a, $tanggal_b) as $data) {
   $kolombody = 0;

   //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
   xlsWriteNumber($tablebody, $kolombody++, $nourut);
   xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
   xlsWriteLabel($tablebody, $kolombody++, $data->nama);
   xlsWriteLabel($tablebody, $kolombody++, $data->saldoAwal);
   xlsWriteLabel($tablebody, $kolombody++, $data->masuk);
   xlsWriteLabel($tablebody, $kolombody++, $data->keluar);
   xlsWriteLabel($tablebody, $kolombody++, $data->akhir);
   xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

   $tablebody++;
   $nourut++;
  }

  xlsEOF();
  exit();
 }

}
