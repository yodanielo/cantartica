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
?>
<div id="colizquierdacontent">
    <div id="eventospara">
        Eventos para el mes de <a href="<?=$per_anterior?>"><img src="images/ag_izq.jpg"/></a> <?=$meses[strtolower($mes)]?> <a href="<?=$per_posterior?>"><img src="images/ag_der.jpg"/></a>
    </div>
    <div id="agecontitems">
        <?php
        if(count($res)>0)
            foreach($res as $r) {
                $linka="index.php?opc=agenda&id=".$r->id."&mes=$mes&anio=$anio";
                ?>
        <div class="ageitem">
            <a href="<?=$linka?>" class="aititle"><?=cie($r->titulo)?></a>
            <div class="aicol1">
                <a href="<?=$linka?>"><img class="aiimagen" src="images/ageimagen/peque_<?=($r->ageimagen)?>" /></a>
                <div class="eventos1_comp">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style">
                        <a addthis:url="<?=$_SERVER["PHP_SELF"]?>?opc=agenda&id=<?=$r->id?>" addthis:title="Cantartica - <?=cie($r->titulo)?>" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c97ba731ceeb968" class="addthis_button_compact"><img src="images/comp_agenda1.jpg" alt="COMPARTIR"/></a>
                        <a addthis:url="<?=$_SERVER["PHP_SELF"]?>?opc=agenda&id=<?=$r->id?>" addthis:title="Cantartica - <?=cie($r->titulo)?>" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c97ba731ceeb968" class="addthis_button_email"><img src="images/email_agenda1.jpg" alt="EMAIL"/></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c97ba731ceeb968"></script>
                    <!-- AddThis Button END -->
                </div>
            </div>
            <div class="aitexto">
                <a href="<?=$linka?>" class="aisubtitle"><?=cie($r->subtitulo)?></a><br/>
                <span class="aifecha"><?=$r->fecha_inicio?></span><br/>
                <br/>
                <span class="aidesc"><a href="<?=$linka?>" style="color:#000;"><?=limitar_letras(strip_tags(cie($r->descripcion)),150)?><br/><br/><label class="lampliar">Ampliar Informaci&oacute;n</label>+</a></span>
            </div>
        </div>
                <?php
            }
        else {
            echo '<div id="nohay">No hay eventos para mostrar</div>';
        }
        ?>
    </div>
    <div id="agepaginacion">
        <?php
        if($numpags>1) {
            if($pag_actual>1) {
                echo '<a href="index.php?opc=agenda&mes='.$mes.'&anio='.$anio.'&pag='.($pag_actual-1).'">&lt;</a> ';
            }
            for($i=1;$i<=$numpags;$i++) {
                if($i==$pag_actual)
                    echo '<a class="selected" href="index.php?opc=agenda&mes='.$mes.'&anio='.$anio.'&pag='.$i.'">'.$i.'</a> ';
                else
                    echo '<a href="index.php?opc=agenda&mes='.$mes.'&anio='.$anio.'&pag='.$i.'">'.$i.'</a> ';
            }
            if($pag_actual<$numpags) {
                echo '<a href="index.php?opc=agenda&mes='.$mes.'&anio='.$anio.'&pag='.($pag_actual+1).'">&gt;</a>';
            }
        }
        ?>
    </div>
</div>
<?php include("plantillas/sidebar.php") ?>