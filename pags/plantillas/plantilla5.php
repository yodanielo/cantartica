<?php
global $config_live_site;
?>
<div id="lineavideo">
    <?php
    /**
     * PENDIENT arreglar, no salen las descripciones de cada video
     */
    if(count($plantillas)>0) {
        foreach($plantillas as $p) {
            $ext=substr($p->recurso1,strlen($p->recurso1)-3);
            switch($ext) {
                case 'jpg':
                case 'gif':
                case 'png':
                    echo '<div class="pl2rec_5"><img src="tumber.php?w=362&src=images/recursos/'.$p->recurso1.'"/><div class="subtitlei">'.cie($p->recurso2).'</div></div>';
                    break;
                case 'flv':
                    echo '<div class="pl2rec_5"><script type="text/javascript">runSWF2("http://www.seriesid.com/player/player.swf?skin=http://www.seriesid.com/player/beelden.zip&file='.$config_live_site.'/images/recursos/'.$p->recurso1.'",410,315,"10.0.0","transparent")</script><div class="subtitlei">'.$p->recurso2.'</div></div>';
                    break;
            }
        }
    }
    ?>
<div id="piefotovideo"><?=$content->nombre_ancho?></div>
</div>

<?php include("sidebar.php") ?>
<div id="pl5_desc" class="texto_<?=str_replace("-","_",$_GET["opc"])?>">
    <div id="seelan">Texto en Español</div>
    <div class="textoidioma"></div>
    <div class="tidi1">
        <?=($content->texto_es)?>
    </div>
    <div class="tidi2">
        <?=($content->texto_en)?>
    </div>
    <div class="barracompartir">
        <!-- AddThis Button BEGIN -->
        <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c571bcc72d12af7" class="addthis_button_compact"><img src="images/compartir_ico.jpg"/></a>
        <a class="addthis_button_email"><img src="images/email_ico.jpg"/></a>
        <a class="addthis_button_print"><img src="images/imprimir_ico.jpg"/></a>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c571bcc72d12af7"></script>
        <!-- AddThis Button END -->
    </div>
</div>
