<?php
global $config_live_site;
?>
<div id="contenidoletras3">
    <div id="letras2videos">
        <div id="video1">
            <script type="text/javascript">
                runSWF2("swf/player2.swf?file=<?=$config_live_site?>/images/letras/<?=($r->recurso1)?>", 380, 254, "10.0.0", "transparent");
            </script>
        </div>
        <div id="video2">
            <script type="text/javascript">
                runSWF2("swf/player2.swf?file=<?=$config_live_site?>/images/letras/<?=($r->recurso2)?>", 380, 254, "10.0.0", "transparent");
            </script>
        </div>
    </div>
    <div id="imgderecha" style="clear:left;">
        &nbsp;
        <!--<img src="images/letras/<?=($r->recurso1)?>"/>-->
    </div>
    <div id="contentportada">
        <a id="seelan" href="#english">See English below</a>
        <div class="textoidioma">
            <?=($r->bio_es)?>
        </div>
        <a name="english" class="textoidioma">
            <?=($r->bio_en)?>
        </a>
        <div class="barracompartir">
            <!-- AddThis Button BEGIN -->
            <a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c571bcc72d12af7" class="addthis_button_compact"><img src="images/compartir_ico.jpg"/></a>
            <a class="addthis_button_email"><img src="images/email_ico.jpg"/></a>
            <a class="addthis_button_print"><img src="images/imprimir_ico.jpg"/></a>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c571bcc72d12af7"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
</div>
<div id="sidebarportada">
    <div class="imgsidebar imgcortado"></div>
    <img class="imgsidebar" src="images/logoletras.jpg"/>
    <div id="autoreslista">
        <?php
        if(count($auts)>0)
            foreach($auts as $aut) {
                echo '<a href="index.php?opc=letras&autor='.$aut->id.'">'.$aut->nombre.'</a><br/>'."\n";
            }
        ?>
    </div>
    <div id="agras">
        <span>Agradecemos a:</span>
        <?php
        if(count($agras)>0)
            foreach($agras as $agra) {
                echo '<a href="'.$agra->link.'"><img src="images/agraimagen/'.$agra->agraimagen.'"/></a>'."\n";
            }
        ?>
    </div>

</div>