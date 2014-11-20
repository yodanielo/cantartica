<?php
if (!empty($_FILES)) {
    $narchivo= mktime().str_replace(" ","",basename(strtolower($_FILES['Filedata']['name'])));
    $ruta1 = "../images/ageimagen/".$narchivo;
    $ruta2 = "../images/ageimagen/peque_".$narchivo;
    //la carpeta de donde se parte es la carpeta donde esta este fichero php
    //desde ahi hay que enrutar el archivo subido hacia su ubicacion final
    move_uploaded_file($_FILES['Filedata']['tmp_name'], $ruta1);
    include_once("fimagenes.php");
    clipImage($ruta1, $ruta2, 96, 97);
    clipImage($ruta1, $ruta1, 379, 348);
    echo $narchivo;
}
?>