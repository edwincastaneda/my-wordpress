<?php
require_once('../../../../wp-load.php');

if($_POST['id_animal']!="--" && $_POST['id_enfermedad']!="--" && $_POST['id_producto']!="--"){
global $wpdb;
$table_name = $wpdb->prefix . "recetas";
$sql="INSERT INTO ".$table_name." (id_animal, id_enfermedad, id_producto)
        SELECT * FROM (SELECT ".$_POST['id_animal'].", ".$_POST['id_enfermedad'].", ".$_POST['id_producto'].") AS tmp
        WHERE NOT EXISTS (
            SELECT id FROM ".$table_name." WHERE id_animal=".$_POST['id_animal']." AND id_enfermedad=".$_POST['id_enfermedad']." AND id_producto=".$_POST['id_producto']."
        ) LIMIT 1";

$wpdb->query( 
	$wpdb->prepare( $sql )
);

header("Location: ".admin_url()."admin.php?page=administrar_recetas&success=1");
}else{
    
    $no1=0;
    $no2=0;
    $no3=0;
    
    if($_POST['id_animal']=="--"){
        $no1="1";
    }else{
        $no1=$_POST['id_animal'];
    }
    
    if($_POST['id_enfermedad']=="--"){
        $no2="1";
    }else{
        $no2=$_POST['id_enfermedad'];
    }
    
    if($_POST['id_producto']=="--"){
        $no3="1";
    }else{
        $no3=$_POST['id_producto'];
    }
    
header("Location: ".admin_url()."admin.php?page=administrar_recetas&error=".$no1.",".$no2.",".$no3);    
}

?>