<div id="inicio">
    <?php
    global $config_live_site;
    echo '<div class="flash_portada" id="flash1">';
    if(count($pos1)>0)
        foreach($pos1 as $p) {
            echo '<a class="flash_cont" href="'.$config_live_site.'?opc='.aurl($p->catnombre).'&cat='.$p->id.'">';
            echo '<img src="images/iniimagen/'.cie($p->iniimagen).'"/>';
            echo '<span class="fp_title">'.cie($p->nombre).'</span>';
            echo '<span class="fp_descripcion">'.limitar_letras(strip_tags(cie($p->texto_es)),180).'</span>';
            echo '</a>';
        }
    echo '</div>';
    echo '<div class="flash_portada" id="flash2">';
    if(count($pos2)>0)
        foreach($pos2 as $p) {
            echo '<a class="flash_cont" href="'.$config_live_site.'?opc='.aurl($p->catnombre).'&cat='.$p->id.'">';
            echo '<img src="images/iniimagen/'.cie($p->iniimagen).'"/>';
            echo '<span class="fp_title">'.cie($p->nombre).'</span>';
            echo '<span class="fp_descripcion">'.limitar_letras(strip_tags(cie($p->texto_es)),180).'</span>';
            echo '</a>';
        }
    echo '</div>';
    echo '<div class="flash_portada" id="flash3">';
    if(count($pos3)>0)
        foreach($pos3 as $p) {
            echo '<a class="flash_cont" href="'.$config_live_site.'?opc='.aurl($p->catnombre).'&cat='.$p->id.'">';
            echo '<img src="images/iniimagen/'.cie($p->iniimagen).'"/>';
            echo '<span class="fp_title">'.cie($p->nombre).'</span>';
            echo '<span class="fp_descripcion">'.limitar_letras(strip_tags(cie($p->texto_es)),180).'</span>';
            echo '</a>';
        }
    echo '</div>';
    echo '<div class="flash_portada" style="margin-right:0px;" id="flash4">';
    if(count($pos4)>0)
        foreach($pos4 as $p) {
            echo '<a class="flash_cont" href="'.$config_live_site.'?opc='.aurl($p->catnombre).'&cat='.$p->id.'">';
            echo '<img src="images/iniimagen/'.cie($p->iniimagen).'"/>';
            echo '<span class="fp_title">'.cie($p->nombre).'</span>';
            echo '<span class="fp_descripcion">'.limitar_letras(strip_tags(cie($p->texto_es)),180).'</span>';
            echo '</a>';
        }
    echo '</div>';
    ?>
</div>
<script type="text/javascript">
    load_inicio();
</script>