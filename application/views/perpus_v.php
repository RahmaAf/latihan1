<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aplikasi Perpustakaan</title>
</head>
<body>
	<h1>Selamat Datang <?php echo $username; ?></h1>
	<h2>Aplikasi Perpustakaan FTIK USM</h2>
	<b>Pilih menu :</b>
	<ol>
		<li><a href="<?=base_url('index.php/buku');?>">Kelola Data Buku<a/></li>
		<li><a href="<?=base_url('index.php/anggota');?>">Kelola Data Anggota<a/></li>
		<li><a href="<?=base_url('index.php/pinjam');?>">Kelola Transaksi Pinjam<a/></li>
	</ol>
	<a href="<?=base_url('index.php/perpus/logout');?>">Logout</a>
</body>
</html>