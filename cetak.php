<?php
    include 'koneksi.php';
    if($_POST['tahun'] == "all"){
        $query = $conn->query("select * from pembayaran inner join petugas on petugas.id_petugas=pembayaran.id_petugas inner join siswa on siswa.nisn=pembayaran.nisn inner join kelas on kelas.id_kelas=siswa.id_kelas inner join spp on spp.id_spp=pembayaran.id_spp");
        
    }else{
        $tahun = $_POST['tahun'];
        if($_POST['bulan'] == "all"){
            $query = $conn->query("select * from pembayaran inner join petugas on petugas.id_petugas=pembayaran.id_petugas inner join siswa on siswa.nisn=pembayaran.nisn inner join kelas on kelas.id_kelas=siswa.id_kelas inner join spp on spp.id_spp=pembayaran.id_spp where pembayaran.tahun_dibayar='$tahun'");
        }else{
            $bulan = $_POST['bulan'];
            if($_POST['id_kelas'] == "all"){
                $query = $conn->query("select * from pembayaran inner join petugas on petugas.id_petugas=pembayaran.id_petugas inner join siswa on siswa.nisn=pembayaran.nisn inner join kelas on kelas.id_kelas=siswa.id_kelas inner join spp on spp.id_spp=pembayaran.id_spp where pembayaran.tahun_dibayar='$tahun' and pembayaran.bulan_dibayar='$bulan'");
            }else{
                $id_kelas = $_POST['id_kelas'];
                $query = $conn->query("select * from pembayaran inner join petugas on petugas.id_petugas=pembayaran.id_petugas inner join siswa on siswa.nisn=pembayaran.nisn inner join kelas on kelas.id_kelas=siswa.id_kelas inner join spp on spp.id_spp=pembayaran.id_spp where pembayaran.tahun_dibayar='$tahun' and pembayaran.bulan_dibayar='$bulan' and siswa.id_kelas='$id_kelas'");
            }
        }
    }
?>
<!-- <script>
    window.print();
</script> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Spp</title>
    <style>
        table{
            width: 100%;
            text-align: center;
            background-color: black;
        }
        .header{
            font-size: 30px;
            padding: 20px 0px  20px 0px;
            background-color: white;
        }
        .hdtb{
            font-size: 14px;
            background-color: white;
            padding: 5px;
            height: 50px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="8" class="header">Laporan Pembayaran Spp Smk Negeri 1 Patumbak</td>
        </tr>
        <tr class="hdtb">
            <th width="4%">No</th>
            <th width="8%">Nisn</th>
            <th width="21%">Nama</th>
            <th width="10%">Kelas</th>
            <th width="10%">Tanggal Bayar</th>
            <th width="13%">Bulan Dibayar</th>
            <th width="13%">Tahun Dibayar</th>
            <th width="10%">Jumlah Dibayar</th>
        </tr>
        <?php
            $no = 1;
            while($data = $query->fetch_array()){
        ?>
        <tr class="hdtb">
            <td width="4%"><?= $no++?></td>
            <td width="10%"><?= $data['nisn']?></td>
            <td width="29%"><?= $data['nama']?></td>
            <td width="10%"><?= $data['nama_kelas']?></td>
            <td width="11%"><?= $data['tgl_bayar']?></td>
            <td width="13%"><?= $data['bulan_dibayar']?></td>
            <td width="10%"><?= $data['tahun_dibayar']?></td>
            <td width="11%"><?= $data['tahun_dibayar']?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>