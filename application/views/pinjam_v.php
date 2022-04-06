<?php
echo "<h2>Form Pinjam Buku</h2>";
echo form_open('pinjam/save/');

echo "Anggota : ".form_dropdown('ID_Anggota',$anggota,'');
echo "<br/><br/>";
echo "Buku : ".form_dropdown('ID_Buku',$buku,'');
echo "<br/><br/>";
$data=array(
			'name' 		=> 'tgl_pinjam',
			'type'		=> 'date',

			);
echo "Tgl.Pinjam : ".form_input($data);
echo "<br/><br/>";
$data=array(
			'name'		=> 'tgl_kembali',
			'type'		=> 'date',

			);
echo "Tgl.Kembali : ".form_input($data);
echo "<br/><br/>";
echo form_submit('btn_simpan','Simpan');
echo form_reset('btn_batal','Batal');
echo form_close();

?>