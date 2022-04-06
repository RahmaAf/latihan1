<?php

echo anchor('Anggota/add_new', 'Tambah Anggota');
echo "<br /><br />";

echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Progdi</th>
			<th>Aksi</th>
		</tr>";

$no = 0;
foreach ($query->result_array() as $row) 
{
	$no++;
	$Progdi     = $row['progdi'];

	$link_edit 	 = anchor('Anggota/edit/'.$row['ID_Anggota'], 'Edit ||');
	$link_delete = anchor('Anggota/delete/'.$row['ID_Anggota'],'Hapus',"onclick='return confirm(\"Apakah Anda Yakin?\")'");

	echo "<tr>
	        <td>".$no."</td>
	        <td>".$row['nim']."</td>
	        <td>".$row['nama']."</td>
	        <td>".$opt_progdi[$Progdi]."</td>
	        <td>".$link_edit.''.$link_delete."</td>
	        </tr>";
}
echo "</table>";
?>
<p><?php echo $links; ?></p> 
<br/><a href="http://localhost/Project/perpus/">Kembali</a>