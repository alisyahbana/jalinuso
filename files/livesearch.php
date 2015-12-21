<?php

mysql_connect("localhost","bimbelon_indtlco","jalinusoindotelco");
mysql_select_db("bimbelon_jalinuso");

$term=$_GET["term"];

$query=mysql_query("SELECT * FROM data_lokasi WHERE (no_jaringan LIKE '%".$term."%' OR kab_kota LIKE '%".$term."%') OR alamat LIKE '%".$term."%' order by no_jaringan ");
$json=array();

	while($row=mysql_fetch_array($query)){
	        $json[]=array(
       			'value'=> $row["no_jaringan"],
       			'label'=>$row["no_jaringan"]." - ".$row["kab_kota"]." - ".$row["alamat"]
         				);
	}

echo json_encode($json);

?>
