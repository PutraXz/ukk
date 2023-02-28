<?php
session_start();
	if(@$_SESSION['level'] == "admin"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Spp - Data Kelas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <style>
	/* button login */
	body {font-family: Calibri Light, georgia, sans-serif;}

	/* Full-width input fields */
	input[type=text], select {
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
				<p><a href="#" onclick="document.getElementById('tambah').style.display='block'">Tambah Data</a></p>
			</div>
			<div class="col-sm-8 text-left"> 
				<h1 >Data Kelas</h1>
                <table>
                    <tr>
                        <th>No</th>
                        <th>nama_kelas</th>
                        <th>kompetensi_keahlian</th>
                        <th>Aksi</th>
                    </tr>
					<?php
						$no = 1;
						$page = @$_GET['page'];
						if($page=='hapus'){
							$id = $_GET['id'];
							$del = $conn->query("delete from kelas where id_kelas='$id'");
							if($del){
								echo "
								<script>
								alert('Hapus Data Berhasil');
								window.location.href='data_kelas.php';
								</script>
								";
							}
						};
						if(isset($_POST['edit'])){
							$nama_kelas = $_POST['nama_kelas'];
							$kompetensi_keahlian = $_POST['kompetensi_keahlian'];
							$id = $_POST['id'];
							$query = $conn->query("update kelas set nama_kelas='$nama_kelas', kompetensi_keahlian='$kompetensi_keahlian' where id_kelas='$id'");
						}						
						$query = $conn->query("select * from kelas");
						while($data = $query->fetch_array(	)){				
					?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_kelas']?></td>
                        <td><?= $data['kompetensi_keahlian']?></td>
						<td>
						<div id="edit-<?= $data['id_kelas']?>" class="modal">
							<form class="modal-content animate"  method="post">
								<div class="container-fluid">
									<input type="hidden" value="<?= $data['id_kelas']?>" name="id">
								<label for="uname"><b>nama_kelas</b></label>
									<input type="text" placeholder="Enter nama_kelas" name="nama_kelas" required value="<?= $data['nama_kelas']?>">
								<label for="psw"><b>kompetensi keahlian</b></label>
									<input type="text" placeholder="Enter kompetensi_keahlian" name="kompetensi_keahlian" required value="<?= $data['kompetensi_keahlian']?>"> 
								<button type="submit" name="edit">Simpan</button>
								</div>
								<div class="container-fluid" style="background-color:#f1f1f1">
								<button type="button" onclick="document.getElementById('edit-<?= $data['id_kelas']?>').style.display='none'" class="cancelbtn">Cancel</button>
								</div> 
							</form>
						</div>
							<a href="#"  onclick="document.getElementById('edit-<?= $data['id_kelas']?>').style.display='block'">Edit</a>
                            <a href="data_kelas.php?page=hapus&id=<?= $data['id_kelas']?>" onclick="return confirm('apakah anda yakin ingin menghapus data ini?');">Hapus</a>
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
			$nama_kelas = $_POST['nama_kelas'];
			$kompetensi_keahlian = $_POST['kompetensi_keahlian'];
			$nama_petugas = $_POST['nama_petugas'];
			$level = $_POST['level'];
			$conn->query("insert into kelas set nama_kelas='$nama_kelas', kompetensi_keahlian='$kompetensi_keahlian'");
			echo "
			<script>
			alert('Login Berhasil');
			window.location.href='data_kelas.php';
			</script>
			";
		}
	?>
	<div id="tambah" class="modal">
		<form class="modal-content animate"  method="post">
			<div class="container-fluid">
				<label for="uname"><b>nama_kelas</b></label>
					<input type="text" placeholder="Enter nama_kelas" name="nama_kelas" required>
				<label for="psw"><b>kompetensi_keahlian</b></label>
					<input type="text" placeholder="Enter kompetensi_keahlian" name="kompetensi_keahlian" required>
			<button type="submit" name="tambah">Tambah</button>
			</div>
			<div class="container-fluid" style="background-color:#f1f1f1">
			<button type="button" onclick="document.getElementById('tambah').style.display='none'" class="cancelbtn">Cancel</button>
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
