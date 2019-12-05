<?php

$session_id= session_id();

if (isset($_POST['Depto'])){$Depto=$_POST['Depto'];}
if (isset($_POST['Ciu'])){$Ciu=$_POST['Ciu'];}

require_once ("../../config/db.php");
require_once ("../../config/conexion.php");


   

echo' <select class="form-control" id="Ciudad" name ="Ciudad" placeholder="Ciudad">';

$sql=mysqli_query($con, "select * from CIUDADES where  Departamento=".$Depto."");
while ($row=mysqli_fetch_array($sql)){
	
	if ($Ciu ==$row['Codigo']){
		echo '<option value="'.$row['Codigo'].'" selected >'.utf8_encode($row['Nombre']).'</option>';
	} else{
		echo '<option value="'.$row['Codigo'].'">'.utf8_encode($row['Nombre']).'</option>';	
	}


	
}
echo '</select>';



?>
