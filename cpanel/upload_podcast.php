<?php
if (!empty($_FILES)) {
    $narchivo= mktime().str_replace(" ","",basename(strtolower($_FILES['Filedata']['name'])));
    $ruta = "../images/podcast/".$narchivo;
    //la carpeta de donde se parte es la carpeta donde esta este fichero php
    //desde ahi hay que enrutar el archivo subido hacia su ubicacion final
    move_uploaded_file($_FILES['Filedata']['tmp_name'], $ruta);
    include_once("fimagenes.php");
    //clipImage($ruta, $ruta, 75, 75);
    echo $narchivo;
}
?>