<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kasir_mutasi extends CI_Controller
{
    public $kode_m_kasir = 1;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kasir_mutasi_model');
        $this->load->library('form_validation');
        $this->session->set_flashdata('title', 'Mutasi | CV PUJI');        
        $this->load->library('datatables');
        $this->load->library('pagination');
    }

    public function kode_m_kasir(){
        $sql = $this->db->query("SELECT kode_m_kasir FROM master_kasir WHERE id_users = '$_SESSION[id_users]'")->row();
        return $kode_m_kasir = $sql->kode_m_kasir;
    }

    public function index()
    {
        $data['kode_m_kasir'] = $this->kode_m_kasir();
                
                
        $this->load->view('kasir/mutasi_list',$data);
		//$this->load->view('Layout/Template', $data);
    }

    public function get(){
                $data['kode_m_kasir'] = $this->kode_m_kasir();
                $tgl_a = $_POST['tanggal_a'];
                $tgl_b = $_POST['tanggal_b'];
                $tgl = array(
                    'tgl_a' => $tgl_a,
                    'tgl_b' => $tgl_b,
                    'kode_m_kasir' => $this->kode_m_kasir(),
                );
                // $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                //$url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
                $transaksi = $this->Kasir_mutasi_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Kasir_mutasi_model
        
                
		// $data['ket'] = $ket;
		// $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['transaksi'] = $transaksi;
        $this->load->view('kasir/mutasi_list',$data);
    }
    
    public function cetak(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                $transaksi = $this->Kasir_mutasi_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Kasir_mutasi_model
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->Kasir_mutasi_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Kasir_mutasi_model
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->Kasir_mutasi_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di Kasir_mutasi_model
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $transaksi = $this->Kasir_mutasi_model->view_all(); // Panggil fungsi view_all yang ada di Kasir_mutasi_model
        }

        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;

		ob_start();
		$this->load->view('print', $data);
		$html = ob_get_contents();
        ob_end_clean();

        require_once('./assets/html2pdf/html2pdf.class.php');
		$pdf = new HTML2PDF('P','A4','en');
		$pdf->WriteHTML($html);
		$pdf->Output('Data Transaksi.pdf', 'D');
	}
    
}