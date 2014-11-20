<?php
$meses=array(
        "",
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Setiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
);
//saco periodo anterior
$ant_mes=$mes-1;
$ant_anio=$anio;
if($mes==0) {
    $ant_mes=12;
    $ant_anio=$anio--;
}
$per_anterior="index.php?opc=agenda&mes=".$ant_mes."&anio=".$ant_anio;
//saco periodo posterior
$pos_mes=$mes+1;
$pos_anio=$anio;
if($mes==12) {
    $pos_mes=1;
    $pos_anio=$anio++;
}
$per_posterior="index.php?opc=agenda&mes=".$pos_mes."&anio=".$pos_anio;
//saco el texto de fecha
if($r->fecha_fin==""){
    //una fecha
    $fecha="El ".fechatexto($r->fecha_inicio);
}else{
    $fecha="Del ".fechatexto($r->fecha_inicio)." al ".fechatexto($r->fecha_fin);
}
?>
<div id="colizquierdacontent">
    <div id="eventospara">
        Eventos para el mes de <a href="<?=$per_anterior?>">&lt;</a> <?=$meses[strtolower($mes)]?> <a href="<?=$per_posterior?>">&gt;</a>
    </div>
    <div id="detzonaimagen">
        <img src="images/ageimagen/<?=$r->ageimagen?>"/>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style">
            <a addthis:title="Cantartica - <?=cie($r->titulo)?>" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c97ba731ceeb968" class="addthis_button_compact"><img src="images/comp_agenda1.jpg" alt="COMPARTIR"/></a>
        </div>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c97ba731ceeb968"></script>
        <!-- AddThis Button END -->
    </div>
    <div id="detzonatexto">
        <div id="metadatos">
            <?=$fecha?><br/>
            <?=cie($r->metadatos)?>
        </div>
        <div id="detsubtitle"><?=cie($r->subtitulo)?></div>
        <div id="dettitle"><?=cie($r->titulo)?></div>
        <div id="dettexto"><?=cie($r->descripcion)?></div>
        <div id="detlink"><a href="javascript:history.back()">&lt; <span>Regresar a Agenda</span></a></div>
    </div>
</div>
<?php include("plantillas/sidebar.php") ?>