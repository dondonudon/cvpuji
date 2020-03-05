<?php
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $notrans; ?> | CV PUJI</title>
  <style>
    @page { size: 56mm 60mm portrait} /* output size */
    body.receipt .sheet { width: 56mm; height: 60mm } /* sheet size */
    @media print { body.receipt { width: 56mm height: 60mm} } /* fix for Chrome */
    html *
        {
        font-size: 8px !important;
        font-family: "Arial";
        }
    .table, th, td {
      border-bottom: 1px dotted;
        }

  </style>
</head>

<body onload="window.print()" class="receipt">
  <section class="sheet padding-10mm">
    <table width="100%" border="0">
    <tr>
    <td align="center">
    <?php
echo $nama_kasir . '<br>';
echo $alamat . '<br>';
echo $telp . '<br>';
echo $kota . '<br>';
?>
    </td>
    </tr>
    </table>
    <br>
    <table width="100%" border="0">
    <tr><strong>
        <td align="center">Nama</td>
        <td align="center">QTY</td>
        <td align="center">Harga</td>
        <td align="center">Jumlah</td>
    </tr></strong>

    <?php
$sum = 0;
foreach ($trans as $row) {
 echo '<tr>';
 echo '<td>' . $row['nama'] . '</td>';
 echo '<td align="center">' . $row['qty'] . '</td>';
 echo '<td align="right">' . rupiah($row['harga']) . '</td>';
 echo '<td align="right">' . rupiah($row['jumlah']) . '</td>';
 $sum += $row['jumlah'];
 echo '</tr>';
}
?>
    <tr>
    <td colspan="3"></td>
    <td align="right"><?php echo rupiah($sum); ?></td>
    </tr>
    </table>
    <br>
    <br>
    <table width="100%" border="0">
    <tr>
    <td align="center">
    Terima kasih sudah belanja di <?php echo $nama_kasir; ?>.<br>
    Semoga hari anda menyenangkan.<br>
    <br>
    </td>
    </tr>
    </table>

  </section>
</body>
</html>