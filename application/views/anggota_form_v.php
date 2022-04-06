<?php

if (!empty($query))
{
	$row = $query->row_array();

}
else 
	{
		$row['ID_Anggota']		= '';
		$row['nim']				= '';
		$row['nama']			= '';
		$row['progdi']			= '';


	}

	//...tambahan & modifikasi
	echo validation_errors();
	echo form_open('Anggota/check');
	echo form_hidden('id',set_value('id',$row['ID_Anggota']));
	echo form_hidden('is_update',$is_update);


// echo form_open('Anggota/save/' .$is_update);
// echo form_hidden('id',$row['ID_Anggota']);

echo "NIM : ".form_input('nim', set_value ('nim',$row['nim']),"size='50' maxlenght='100'");
echo "<br/><br/>";
echo "Nama : ".form_input('nama', set_value('nama',$row['nama']), "size='50' maxlenght='150'");
echo "<br/><br/>";
echo "Progdi : ".form_dropdown('progdi', $opt_progdi, set_value('progdi',$row['progdi']));
echo "<br/><br/>";
echo form_submit('btn_simpan', 'Simpan');
echo form_close();


?>