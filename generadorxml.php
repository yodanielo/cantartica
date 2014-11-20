<?php
include("includes/contenido.php");
$salida=generarxml($_GET["id"]);
$aa=$salida["canal"];
$bb=$salida["tracks"];
?>
<?php
$cad.='<?xml version="1.0" encoding="utf-8"?>
<songs>
    ';
foreach($bb as $b){
    $cad.='<song path="'.($config_live_site."/images/recursos/".$b->sonido).'" bild="'.($config_live_site.'/images/radimagen/'.$aa->radimagen).'" artist="Cantartica" title="'.$b->nombre.'" />';
    /*$cad.='<song name="'.$b->nombre.'"
        duration=""
        buy="false"
        download="true"
        buylink=""
        downloadSource="'."images/recursos/".rawurlencode($b->sonido).'"
            >'."images/recursos/".rawurlencode($b->sonido).'</song>';*/
}
$cad.='
</songs>';
echo $cad;
?>


