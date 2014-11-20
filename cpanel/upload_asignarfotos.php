<?php
if (!empty($_FILES)) {
    $narchivo= str_replace(" ","",basename(strtolower($_FILES['Filedata']['name'])));
    $ruta0 = "../images/recursos/".$narchivo;
    //la carpeta de donde se parte es la carpeta donde esta este fichero php
    //desde ahi hay que enrutar el archivo subido hacia su ubicacion final
    move_uploaded_file($_FILES['Filedata']['tmp_name'], $ruta0);
    include_once("fimagenes.php");
    //clipImage($ruta0, $ruta0, 96, 57);
    echo $narchivo;
}
?>