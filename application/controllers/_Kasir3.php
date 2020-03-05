<?php

if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class Kasir3 extends CI_Controller
{
  public $kode_m_kasir = 3;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Kasir_model');
    $this->load->library('form_validation');
    $this->load->library('pdf');
    $this->session->set_flashdata('title', 'Transaksi | CV PUJI');
    $this->load->library('datatables');
  }

  public function index()
  {
    //$this->template->load('template','temp_trans/temp_trans_form', $data);

    $data = array(
      'kode_m_kasir' => $this->kode_m_kasir,
    );
    $this->load->view('kasir/kasir3/temp_trans_list', $data);
  }

  public function group()
  {
    $data = array(
      'kode_m_kasir' => $this->kode_m_kasir,
    );
    //$this->template->load('template','temp_trans/temp_trans_form', $data);
    $this->load->view('kasir/kasir3/temp_trans_group', $data);
  }

  public function barang()
  {
    $kode_group = $this->uri->segment(3);
    $data       = array(
      'kode_group'   => $kode_group,
      'kode_m_kasir' => $this->kode_m_kasir,
    );
    //$this->template->load('template','temp_trans/temp_trans_form', $data);
    $this->load->view('kasir/kasir3/temp_trans_barang', $data);
  }

  public function single()
  {
    $kode_barang = $this->uri->segment(3);
    $data        = array(
      'kode_barang'  => $kode_barang,
      'kode_m_kasir' => $this->kode_m_kasir,
    );
    //$this->template->load('template','temp_trans/temp_trans_form', $data);
    $this->load->view('kasir/kasir3/temp_trans_single', $data);
  }

  public function jual_single()
  {

    $data = array(
      'notrans'      => $this->input->post('notrans', true),
      'kode_barang'  => $this->input->post('kode_barang', true),
      'kode_m_kasir' => $this->input->post('kode_m_kasir', true),
      'qty'          => $this->input->post('qty', true),
      'harga'        => $this->input->post('harga', true),
      'hpp'          => $this->input->post('hpp', true),
      'jumlah'       => $this->input->post('jumlah', true),
      'jumlah_hpp'   => $this->input->post('hpp', true) * $this->input->post('qty', true),
      'agen'         => $this->input->post('agen', true),
      'datetime'     => date('Y-m-d H:i:s'),
    );

    $this->Kasir_model->insert($data);
    $this->session->set_flashdata('message', 'Create Record Success 2');
    redirect(base_url('kasir3'));
  }

  public function json()
  {
    // $data = $this->Stock_opname_model->barang_list();
    // echo json_encode($data);

    $data1 = array(
      'kode_m_kasir' => $this->kode_m_kasir,
    );

    $data = $this->Kasir_model->json($data1);
    echo json_encode($data);
  }

  public function update_get_barcode()
  {
    $qty  = $this->input->post('value');
    $data = array(
      $this->input->post('table_column') => $this->input->post('value'),
    );

    $id_trans = $this->input->post('id_trans');

    // get kode barang
    $query       = $this->db->query("SELECT kode_barang FROM temp_trans WHERE id_trans = '$id_trans'")->row();
    $kode_barang = $query->kode_barang;

    //get stok
    $query = $this->db->query("SELECT stock_m_kasir.kode_barang, stock_m_kasir.stok FROM stock_m_kasir INNER JOIN temp_trans ON stock_m_kasir.kode_barang = temp_trans.kode_barang WHERE stock_m_kasir.kode_barang = '$kode_barang'")->row();
    $stok  = $query->stok;

    if ($stok > $qty) {
      $this->Kasir_model->update_get_barcode($data, $id_trans);
    } else {
      $data = 'Stok tidak cukup';
      $this->session->set_flashdata('error', 'Stok tidak cukup');
    }
  }

  public function update_get_barcode_agenBesar()
  {
    $qty  = $this->input->post('value');
    $data = array(
      $this->input->post('table_column') => $this->input->post('value'),
    );

    $id_trans = $this->input->post('id_trans');

    // get kode barang
    $query       = $this->db->query("SELECT kode_barang FROM temp_trans WHERE id_trans = '$id_trans'")->row();
    $kode_barang = $query->kode_barang;

    //get stok
    $query = $this->db->query("SELECT stock_m_kasir.kode_barang, stock_m_kasir.stok FROM stock_m_kasir INNER JOIN temp_trans ON stock_m_kasir.kode_barang = temp_trans.kode_barang WHERE stock_m_kasir.kode_barang = '$kode_barang'")->row();
    $stok  = $query->stok;

    if ($stok > $qty) {
      $this->Kasir_model->update_get_barcode_agenBesar($data, $id_trans);
    } else {
      $data = 'Stok tidak cukup';
      $this->session->set_flashdata('error', 'Stok tidak cukup');
    }
  }

  public function update_get_barcode_agenKecil()
  {
    $qty  = $this->input->post('value');
    $data = array(
      $this->input->post('table_column') => $this->input->post('value'),
    );

    $id_trans = $this->input->post('id_trans');

    // get kode barang
    $query       = $this->db->query("SELECT kode_barang FROM temp_trans WHERE id_trans = '$id_trans'")->row();
    $kode_barang = $query->kode_barang;

    //get stok
    $query = $this->db->query("SELECT stock_m_kasir.kode_barang, stock_m_kasir.stok FROM stock_m_kasir INNER JOIN temp_trans ON stock_m_kasir.kode_barang = temp_trans.kode_barang WHERE stock_m_kasir.kode_barang = '$kode_barang'")->row();
    $stok  = $query->stok;

    if ($stok > $qty) {
      $this->Kasir_model->update_get_barcode_agenKecil($data, $id_trans);
    } else {
      $data = 'Stok tidak cukup';
      $this->session->set_flashdata('error', 'Stok tidak cukup');
    }
  }

  public function delete()
  {
    $this->Kasir_model->delete($this->input->post('id'));
  }

  public function insert_trans()
  {
    $kode_m_kasir = $this->input->post('kode_m_kasir');
    $notrans      = $this->input->post('notrans');
    $bayar        = $this->input->post('bayar');
    $this->Kasir_model->insert_trans($kode_m_kasir, $notrans);
    $this->print($notrans, $bayar);
    $this->session->set_flashdata('message', 'Create Record Success 2');
    //   redirect(base_url('kasir3'));
  }

  function print($notrans, $bayar)
  {
    date_default_timezone_set('Asia/Bangkok');
    $pdf = new FPDF('P', 'mm', array(58, 100));
    // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan

    $query        = $this->db->query("SELECT kode_m_kasir FROM trans WHERE notrans = '$notrans' ");
    $toko         = $query->row();
    $kode_m_kasir = $toko->kode_m_kasir;
    $query        = $this->db->query("SELECT * FROM master_kasir WHERE kode_m_kasir = '$kode_m_kasir'");
    $query2       = $this->db->query("SELECT * FROM trans WHERE notrans = '$notrans'");
    $ret          = $query->row();
    $ret2         = $query2->row();
    $nama_kasir   = $ret->nama;
    $alamat       = $ret->alamat;
    $kota         = $ret->kota;
    $telp         = $ret->telp;
    $datetime     = $ret2->datetime;
    $agen         = $ret2->agen;

    //GET DATA
    $trans = $this->db->query("SELECT
                            td.notrans,
                            td.kode_barang,
                            tb.nama,
                            td.kode_m_kasir,
                            td.qty,
                            td.harga,
                            td.jumlah
                        FROM
                            trans_detail td
                        INNER JOIN tab_barang tb on
                            td.kode_barang = tb.kode_barang
                            INNER JOIN master_kasir mk on td.kode_m_kasir = mk.kode_m_kasir
                        WHERE
                            td.notrans = '$notrans'")->result_array();

    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetMargins(2, 2, 2, 1);
    $pdf->Ln();
    $pdf->Cell(0, 4, $nama_kasir, 0, 1, 'C');
    $pdf->Cell(0, 4, $alamat, 0, 1, 'C');
    $pdf->Cell(0, 4, $telp, 0, 1, 'C');
    $pdf->Cell(0, 4, $kota, 0, 1, 'C');
    $pdf->SetFont('Helvetica', '', 6);
    $pdf->Cell(0, 5, $datetime, 0, 0, 'L');
    $pdf->Cell(0, 5, $notrans, 0, 1, 'R');
    $pdf->SetFont('Helvetica', 'I', 6);
    if ($agen == 0) {
      $pdf->Cell(0, 3, "CUSTOMER", 0, 1, 'L');
    } elseif ($agen == 1) {
      $pdf->Cell(0, 3, "AGEN", 0, 1, 'L');
    }
    $pdf->Line(1, 26, 55, 26);
    $pdf->SetFont('Helvetica', '', 10);

    $sum = 0;
    foreach ($trans as $row) {
      $pdf->Cell(28, 4, $row['nama'], 0, 0);
      $pdf->Ln();
      $pdf->Cell(5, 4, $row['qty'], 0);
      $pdf->Cell(15, 4, 'X', 0, 0);
      $pdf->Cell(20, 4, number_format($row['harga']), 0, 0);
      $pdf->Cell(20, 4, number_format($row['jumlah']), 0, 1);
      $sum += $row['jumlah'];
    }
    $pdf->Ln();
    $pdf->Cell(40, 4, 'Jumlah', 0, 0);
    $pdf->Cell(10, 4, number_format($sum), 0, 1);
    $pdf->Cell(40, 4, 'Bayar', 0, 0);
    $pdf->Cell(10, 4, number_format($bayar), 0, 1);
    $kembalian = $bayar - $sum;
    $pdf->Cell(40, 4, 'Kembalian', 0, 0);
    $pdf->Cell(10, 4, number_format($kembalian), 0, 1);
    $pdf->Ln();
    $pdf->MultiCell(0, 5, 'Terima kasih sudah belanja di ' . $nama_kasir . '.', 0, 'C');
    $pdf->Cell(40, 3, 'Semoga hari anda menyenangkan.', 0, 'C');
    //$pdf->Output();
    $pdf->Output('I', $notrans . '.pdf');
    return;
    redirect(base_url('kasir3'));
  }

  public function _delete($id)
  {
    $row = $this->Kasir_model->get_by_id($id);

    if ($row) {
      $this->Kasir_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(base_url('kasir3'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(base_url('kasir3'));
    }
  }

  //get harga
  public function get_harga()
  {
    $kode_barang = $this->input->post('kode_barang');
    $qty         = $this->input->post('qty');
    //   $kode_m_kasir = $this->input->post('kode_m_kasir');
    $data = $this->Kasir_model->get_harga($qty, $kode_barang);
    echo json_encode($data);
  }

  public function get_harga_agenBesar()
  {
    $kode_barang = $this->input->post('kode_barang');
    $qty         = $this->input->post('qty');
    //   $kode_m_kasir = $this->input->post('kode_m_kasir');
    $data = $this->Kasir_model->get_harga_agenBesar($qty, $kode_barang);
    echo json_encode($data);
  }

  public function get_harga_agenKecil()
  {
    $kode_barang = $this->input->post('kode_barang');
    $qty         = $this->input->post('qty');
    //   $kode_m_kasir = $this->input->post('kode_m_kasir');
    $data = $this->Kasir_model->get_harga_agenKecil($qty, $kode_barang);
    echo json_encode($data);
  }

  public function get_barcode()
  {

    $barcode      = $this->input->post('barcode');
    $kode_m_kasir = $this->input->post('kode_m_kasir');
    $notrans      = $this->input->post('notrans');
    $data         = $this->Kasir_model->get_barcode($barcode, $kode_m_kasir, $notrans);
    echo json_encode($data);
  }

  public function get_barcode_agenBesar()
  {

    $barcode      = $this->input->post('barcode');
    $kode_m_kasir = $this->input->post('kode_m_kasir');
    $notrans      = $this->input->post('notrans');
    $data         = $this->Kasir_model->get_barcode_agenBesar($barcode, $kode_m_kasir, $notrans);
    echo json_encode($data);
  }

  public function get_barcode_agenKecil()
  {

    $barcode      = $this->input->post('barcode');
    $kode_m_kasir = $this->input->post('kode_m_kasir');
    $notrans      = $this->input->post('notrans');
    $data         = $this->Kasir_model->get_barcode_agenKecil($barcode, $kode_m_kasir, $notrans);
    echo json_encode($data);
  }

  public function hapus_barang()
  {
    $id_trans = $this->input->post('id_trans');
    $data     = $this->Kasir_model->hapus_barang($id_trans);
    echo json_encode($data);
  }

  public function get_barang()
  {
    $id_trans = $this->input->get('id');
    $data     = $this->Kasir_model->get_barang_by_kode($id_trans);
    echo json_encode($data);
  }

  public function cek_stok()
  {
    $kode_barang  = $this->input->post('kode_barang');
    $qty          = $this->input->post('qty');
    $kode_m_kasir = $this->input->post('kode_m_kasir');

    $data = cek_stok($qty, $kode_barang, $kode_m_kasir);
    echo json_encode($data);
  }

  public function _rules()
  {

    $this->form_validation->set_rules('id_trans', 'id_trans', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function excel()
  {
    $this->load->helper('exportexcel');
    $namaFile  = "temp_trans.xls";
    $judul     = "temp_trans";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Notrans");
    xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "Kode M Kasir");
    xlsWriteLabel($tablehead, $kolomhead++, "Qty");
    xlsWriteLabel($tablehead, $kolomhead++, "Harga");
    xlsWriteLabel($tablehead, $kolomhead++, "Datetime");

    foreach ($this->Kasir_model->get_all() as $data) {
      $kolombody = 0;

      //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
      xlsWriteNumber($tablebody, $kolombody++, $nourut);
      xlsWriteLabel($tablebody, $kolombody++, $data->notrans);
      xlsWriteNumber($tablebody, $kolombody++, $data->kode_barang);
      xlsWriteNumber($tablebody, $kolombody++, $data->kode_m_kasir);
      xlsWriteNumber($tablebody, $kolombody++, $data->qty);
      xlsWriteNumber($tablebody, $kolombody++, $data->harga);
      xlsWriteLabel($tablebody, $kolombody++, $data->datetime);

      $tablebody++;
      $nourut++;
    }

    xlsEOF();
    exit();
  }
}

/* End of file Temp_trans.php */
/* Location: ./application/controllers/Temp_trans.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-12-06 08:08:59 */
/* http://harviacode.com */
