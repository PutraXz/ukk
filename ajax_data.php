<?php
    include 'koneksi.php';
    $datas = $datas = [
        ['month' => 'Januari'],
        ['month' => 'Februari'],
        ['month' => 'Maret'],
        ['month' => 'April'],
        ['month' => 'Mei'],
        ['month' => 'Juni'],
        ['month' => 'Juli'],
        ['month' => 'September'],
        ['month' => 'Oktober'],
        ['month' => 'November'],
        ['month' => 'Desember'],
    ];
    $page = $_GET['page'];
    if($page == 'nisn'){
    $nisn = $_POST['nisn'];
    
    // $query = $conn->query("select * from siswa where nisn='$nisn'");
    // $valid = $que;
    //     if($valid['nisn'] == $nisn){
            $t_data = $conn->query("select siswa.nama,kelas.nama_kelas,spp.nominal,siswa.id_spp, siswa.nisn from siswa inner join kelas on siswa.id_kelas=kelas.id_kelas inner join spp on spp.id_spp=siswa.id_spp where siswa.nisn='$nisn'");
            $data = $t_data->fetch_array();
            if(@$data['nisn'] == @$nisn){
?>
        <label for="tanggal"><b>Nama</b></label>
            <input type="text" value="<?= $data['nama'] ?>" disabled>
        <label for="tanggal"><b>Kelas</b></label>
            <input type="text" value="<?= $data['nama_kelas'] ?>" disabled>
        <label for="">Bulan Dibayar</label>
            <select name="bulan_dibayar" id="" required>
                <?php foreach ($datas as $month) { ?>
                <option value="<?= $month['month'] ?>"><?= $month['month'] ?></option>
                <?php } ?>
            </select>
        <label for="">Tahun Dibayar</label>
        <select name="tahun_dibayar" id="" required>

            <?php 
                $tahun = date('Y');
                for ($i=$tahun-3; $i<=$tahun+3; $i++){
            ?>
            <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
        </select>
        <label for="">Jumlah Yang Harus Dibayar</label>
        <input type="text" name="jumlah_bayar" value="<?= $data['nominal'] ?>" readonly>
        <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>" readonly>


?>
<?php
    }else{
        echo "
            <script>
            alert('salah blok!!');
            </script>
        ";
    }
    }elseif($page == "bulan"){
        if($_POST['bulan'] == 'all'){
            echo "<button type='submit' name='generate'>Generate Laporan</button>";
        }else{
    ?>  
        <select name="id_kelas" id="kelas">
            <option value="">Pilih Kelas</option>
            <option value="all">All</option>
            <?php
                $q_kelas = $conn->query("select * from kelas");
                while($kelas = $q_kelas->fetch_array()){
            ?>
                <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas']?></option>
            <?php } ?>
        </select>
    <?php
         echo "<button type='submit' name='generate'>Generate Laporan</button>";
    }
    }elseif($page == 'laporan'){
        if($_POST['tahun']=="all"){
            echo "<button type='submit' name='generate'>Generate Laporan</button>";
        }else{
        ?>
         <select name="bulan" id="bulan" required>
            <option value="">Pilih Bulan</option>
            <option value="all">All</option>
            <?php foreach ($datas as $month) { ?>
            <option value="<?= $month['month'] ?>"><?= $month['month'] ?></option>
            <?php } ?>
        </select>
        <div id="tampil-kelas">
					
        </div>
        <script type="text/javascript">
            $('#bulan').change(function() { 
                var bulan = $(this).val();
                $.ajax({
                    type: 'POST', 
                    url: 'ajax_data.php?page=bulan', 
                    data: 'bulan=' + bulan, 
                    success: function(response) { 
                            $('#tampil-kelas').html(response);
                        
                    }
                });
            });
        </script>
<?php
    }
}

?>
