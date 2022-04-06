<?php

echo anchor('Buku/add_new', 'Tambah Buku');
echo "<br /><br />";

echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>Judul</th>
			<th>Pengarang</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>";

$no = 0;
foreach ($query->result_array() as $row) 
{
	$no++;
	$Kategori     = $row['Kategori'];

	$link_edit 	 = anchor('Buku/edit/'.$row['ID_Buku'], 'Edit ||');
	$link_delete = anchor('Buku/delete/'.$row['ID_Buku'],'Hapus',"onclick='return confirm(\"Apakah Anda Yakin?\")'");

	echo "<tr>
	        <td>".$no."</td>
	        <td>".$row['Judul']."</td>
	        <td>".$row['Pengarang']."</td>
	        <td>".$opt_kategori[$Kategori]."</td>
	        <td>".$link_edit.''.$link_delete."</td>
	        </tr>";
}
echo "</table>";
?>
<p><?php echo $links; ?></p> 
<br/><a href="http://localhost/Project/perpus/">Kembali</a>