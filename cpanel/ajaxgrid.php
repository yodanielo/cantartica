<?php
//$_POST["pagina"]="clubes.php";
//$_POST["paginacion"]=2;
$_POST["tipo"]="ajax";
//$_POST["resultados"]="20";
include("cls_".$_POST["pagina"]);
$r=new Registro();
if($_POST["desactivar"])
    $r->datos->desactivar_simple($_POST["idobj"]);
if($_POST["activar"])
    $r->datos->activar_simple($_POST["idobj"]);
if($_POST["eliminar"])
    $r->datos->eliminar_simple($_POST["idobj"]);
echo $r->lista()
?>
