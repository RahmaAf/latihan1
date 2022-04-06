<?php

if (!empty($query))
{
	$row = $query->row_array();

}
else 
	{
		$row['ID_Buku']		= '';
		$row['Judul']		= '';
		$row['Pengarang']		= '';
		$row['Kategori']		= '';


	}

//...tambahan & modifikasi
	echo validation_errors();
	echo form_open('Buku/check');
	echo form_hidden('id',set_value('id',$row['ID_Buku']));
	echo form_hidden('is_update',$is_update);


// echo form_open('Buku/save/' .$is_update);
// echo form_hidden('id',$row['ID_Buku']);
echo "Judul : ".form_input('Judul',set_value('Judul', $row['Judul']),"size='50' maxlenght='100'");
echo "<br/><br/>";
echo "Pengarang : ".form_input('Pengarang',set_value('Pengarang', $row['Pengarang']), "size='50' maxlenght='150'");
echo "<br/><br/>";
echo "Kategori : ".form_dropdown('Kategori', $opt_kategori,set_value('Kategori', $row['Kategori']));
echo "<br/><br/>";
echo form_submit('btn_simpan', 'Simpan');
echo form_close();


?>