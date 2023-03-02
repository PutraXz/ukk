<?php
session_start();
	if($_SESSION['level'] == "admin" || $_SESSION['level'] == "petugas" ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Spp - History Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <style>
	/* button login */
	body {font-family: Calibri Light, georgia, sans-serif;}

	/* Full-width input fields */
	input[type=text], input[type=number], input[list], select, textarea, input[type=date] {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	box-sizing: border-box;
	}

	/* Set a style for all buttons */
	button {
	background-color: #04AA6D;
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 100%;
	}

	button:hover {
	opacity: 0.8;
	}

	/* Extra styles for the cancel button */
	.cancelbtn {
	width: auto;
	padding: 10px 18px;
	background-color: #f44336;
	}

	/* Center the image and position the close button */
	.imgcontainer {
	text-align: center;
	margin: 24px 0 12px 0;
	position: relative;
	}

	img.avatar {
	width: 40%;
	border-radius: 50%;
	}

	.container {
	padding: 16px;
	}

	span.psw {
	float: right;
	padding-top: 16px;
	}

	/* The Modal (background) */
	.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	padding-top: 60px;
	}

	/* Modal Content/Box */
	.modal-content {
	background-color: #fefefe;
	margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
	border: 1px solid #888;
	width: 80%; /* Could be more or less, depending on screen size */
	}

	/* The Close Button (x) */
	.close {
	position: absolute;
	right: 25px;
	top: 0;
	color: #000;
	font-size: 35px;
	font-weight: bold;
	}

	.close:hover,
	.close:focus {
	color: red;
	cursor: pointer;
	}

	/* Add Zoom Animation */
	.animate {
	-webkit-animation: animatezoom 0.6s;
	animation: animatezoom 0.6s
	}

	@-webkit-keyframes animatezoom {
	from {-webkit-transform: scale(0)} 
	to {-webkit-transform: scale(1)}
	}
	
	@keyframes animatezoom {
	from {transform: scale(0)} 
	to {transform: scale(1)}
	}

	/* Change styles for span and cancel button on extra small screens */
	@media screen and (max-width: 300px) {
	span.psw {
		display: block;
		float: none;
	}
	.cancelbtn {
		width: 100%;
	}
	}


    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>
<?php include 'login.php';?>	
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
			</div>
			<?php include 'menu.php';?>
		</div>
	</nav>
	<div class="container-fluid text-center">    
		<div class="row content">
			<div class="col-sm-2 sidenav">
				<p> 
					<form action="" method="post">
                        <input type="text" name="keyword" placeholder="Masukkan Nisn">
                        <button type="submit" name="cari">Cari</button>
                    </form>
				</p>
			</div>
			<div class="col-sm-8 text-left"> 
				<h1 >History Pembayaran</h1>
				<button onclick="window.location='data_history.php'">Reset</button>
				<?php
					if(@$_SESSION['level'] == 'admin'){ 
				?>
				<h3>Generate Laporan</h3>
				<form action="cetak.php" method="post">
					<select name="tahun" id="tahun">
						<option value="">Pilih Tahun</option>
						<option value="all">All</option>
						<?php 
							for ($t=2000; $t<date('Y')+3; $t++){
						?>
							<option value="<?= $t ?>"><?= $t ?></option>
						<?php } ?>
					</select>
					<div id="generate-laporan">
						
					</div>
				</form>
				<?php } ?>
					<script type="text/javascript">
						$('#tahun').change(function() { 
							var tahun = $(this).val();
							$.ajax({
								type: 'POST', 
								url: 'ajax_data.php?page=laporan', 
								data: 'tahun=' + tahun, 
								success: function(response) { 
										$('#generate-laporan').html(response);
									
								}
							});
						});
				
					</script>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nisn</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                    </tr>
					<?php
						$i = 1;	
						$query2 = $conn->query("select * from siswa inner join kelas on kelas.id_kelas=siswa.id_kelas  ");
						while($data2 = $query2->fetch_array()){				
					?>
                    <tr>
                        <td><a href="#"  onclick="document.getElementById('edit-<?= $data2['nisn']?>').style.display='block'"><?= $i++; ?></a></td>
                        <td><a href="#"  onclick="document.getElementById('edit-<?= $data2['nisn']?>').style.display='block'"><?= $data2['nisn']?></a></td>
                        <td><a href="#"  onclick="document.getElementById('edit-<?= $data2['nisn']?>').style.display='block'"><?= $data2['nama']?></a></td>
                        <td>
							<a href="#"  onclick="document.getElementById('edit-<?= $data2['nisn']?>').style.display='block'"><?= $data2['nama_kelas']?></a>
							<div id="edit-<?= $data2['nisn']?>" class="modal">
							<div class="modal-content animate">
								<div class="container-fluid">
									<h1>History Pembayaran</h1>
										<table>
											<tr>
												<th>No</th>
												<th>Nisn</th>
												<th>Nama</th>
												<th>Kelas</th>
												<th>Nominal Pembayaran</th>
												<th>Bulan Dibayar</th>
												<th>Tahun Dibayar</th>
												<th>Petugas</th>
												<th>Aksi</th>
											</tr>
											<?php
												$no = 1;				
												$query = $conn->query("select * from pembayaran inner join petugas on petugas.id_petugas=pembayaran.id_petugas inner join siswa on siswa.nisn=pembayaran.nisn inner join kelas on kelas.id_kelas=siswa.id_kelas inner join spp on spp.id_spp=pembayaran.id_spp where pembayaran.nisn='$data2[nisn]' ");
												while($data = $query->fetch_array(	)){				
											?>
											<tr>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $no++ ?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['nisn']?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['nama']?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['nama_kelas']?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['nominal']?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['bulan_dibayar']?></a></td>
												<td><a href="#"  onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='block'"><?= $data['tahun_dibayar']?></a></td>
												<td><?= $data['nama_petugas']?></td>
												<td>
												<div id="edit-<?= $data['id_pembayaran']?>" class="modal">
													<form class="modal-content animate"  method="post">
														<div class="container-fluid">
														<label for="psw"><b>Nisn</b></label>
															<input type="text" value="<?= $data['nisn']?>">
														<label for="siswa"><b>Nama siswa</b></label>
															<input type="text" value="<?= $data['nama']?>" readonly>
														<label for="siswa"><b>Nama Kelas</b></label>
															<input type="text" value="<?= $data['nama_kelas']?>" readonly>
														<label for="siswa"><b>Tanggal Bayar</b></label>
															<input type="text" value="<?= $data['tgl_bayar']?>" readonly>
														<label for="bulan_dibayar"><b>Bulan Dibayar</b></label>
															<input type="text" value="<?= $data['bulan_dibayar']?>" readonly>
														<label for="psw"><b>Tahun Dibayar</b></label>
															<input type="number" readonly value="<?= $data['tahun_dibayar']?>" readonly>
														<label for="siswa"><b>Nominal Yang Harus Dibayar</b></label>
															<input type="text" value="<?= $data['nominal'] ?>" readonly>
														</div>
														<div class="container-fluid" style="background-color:#f1f1f1">
														<button type="button" onclick="document.getElementById('edit-<?= $data['id_pembayaran']?>').style.display='none'" class="cancelbtn">Cancel</button>
														</div> 
													</form>
												</div>
													<a href="data_transaksi.php?page=hapus&id_pembayaran=<?= $data['id_pembayaran']?>" onclick="return confirm('apakah anda yakin ingin menghapus data ini?');">Hapus</a>
													</script>
												</td>
											</tr>
											<?php }?>
										</table>
									</div>
								<div class="container-fluid" style="background-color:#f1f1f1">
									<button type="button" onclick="document.getElementById('edit-<?= $data2['nisn']?>').style.display='none'" class="cancelbtn">Cancel</button>
								</div> 
							</div>
						</div>
						</td>
						
                    </tr>
					<?php }?>
                </table>
			</div>
			<div class="col-sm-2 sidenav">
				<div class="well">
					<p>ADS</p>
				</div>
				<div class="well">
					<p>ADS</p>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['tambah'])){
			$id_petugas = $_SESSION['id_petugas'];
			$nisn = $_POST['nisn'];
			$tgl_bayar = date('Y-m-d');
			$bulan_dibayar = $_POST['bulan_dibayar'];
            $tahun_dibayar = $_POST['tahun_dibayar'];
			$id_spp = $_POST['id_spp'];
            $jumlah_bayar = $_POST['jumlah_bayar'];
			$conn->query("insert into pembayaran set id_petugas='$id_petugas', nisn='$nisn', tgl_bayar='$tgl_bayar', bulan_dibayar= '$bulan_dibayar', tahun_dibayar='$tahun_dibayar',id_spp='$id_spp', jumlah_bayar='$jumlah_bayar'");
			echo "
			<script>
			alert('Login Berhasil');
			window.location.href='data_transaksi.php';
			</script>
			";
		}
	?>
	<div id="transaksi" class="modal">
		<form class="modal-content animate"  method="post">
			<div class="container-fluid">
				<label for="siswa"><b>nisn siswa</b></label>
					<input list="nisn_list" name="nisn" id="nisn" required>
						<datalist id="nisn_list">
							<?php
								$q_nisn = $conn->query("select nisn from siswa");
								while($nisn = $q_nisn->fetch_array()){
							?>
							<option value="<?= $nisn['nisn'] ?>">
									
						<?php } ?>
						</datalist>
				<div id="details-pembayaran">
					
				</div>
					<script type="text/javascript">
						$('#nisn').change(function() { 
							var nisn = $(this).val();
							var data = '<?php  ?>' ;
							$.ajax({
								type: 'POST', 
								url: 'ajax_data.php?page=nisn', 
								data: 'nisn=' + nisn, 
								success: function(response) { 
										$('#details-pembayaran').html(response);
									
								}
							});
						});
				
					</script>
				<button type="submit" name="tambah">Tambah</button>
			</div>
			<div class="container-fluid" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('transaksi').style.display='none'" class="cancelbtn">Cancel</button>
			</div> 
		</form>
	</div>
	<footer class="container-fluid text-center">
		<p>Footer Text</p>
	</footer>
<script>
// Get the modal
var modal = document.getElementById('tambah');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
	modal.style.display = "none";
	}
}
</script>
</body>
</html>
<?php
	}else{
		echo "
			<script>
				alert('anda tidak memiliki akses ke halam ini');
				window.location.href='index.php';
			</script>
		";
	}
?>
