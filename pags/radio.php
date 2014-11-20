<?php
global $config_live_site;
$radio=null;
$cad='';
if(count($res)>0) {
    foreach($res as $r) {
        if($r->id==$id) {
            $radio=$r;
        }
        else {
            $cad.='<div class="canalesitem">';
            $cad.='<img class="canalimg" src="images/radimagen/'.($r->radimagen).'" />';
            $cad.='<a href="?opc=radio-cantartica&id='.($r->id).'" class="canalresumen">'.($r->canal).'<br/>'.limitar_letras(strip_tags(($r->informacion)),100).'</a>';
            $cad.='</div>';
        }
    }
}
?>
<div id="colizquierdacontent">
    <div id="colizqcanales">
        <div id="titlecolizqcanales">M&aacute;s canales</div>
        <?=$cad?>
    </div>
    <div id="colcentrocanales">
        <div id="radbanner">
            <?php
            if(file_exists("images/radimagen/".$radio->radbanner) && $radio->radbanner!="")
                echo '<img src="images/radimagen/'.$radio->radbanner.'" />';
            ?>

        </div>
        <div id="radrepro">
            <object type="application/x-shockwave-flash" data="swf/fsmp3playerv15.swf" width="353" height="402" id="myContent" style="visibility: visible; ">
                <param name="bgcolor" value="#ffffff">
                <param name="allowfullscreen" value="true">
                <param name="flashvars" value="file=<?=rawurlencode($config_live_site."/generadorxml.php?id=".$id)?>">
            </object>
            <!--<object type="application/x-shockwave-flash" data="swf/dewplayer-playlist.swf" width="240" height="200" id="dewplayer" name="dewplayer">
                <param name="wmode" value="transparent" />
                <param name="movie" value="swf/dewplayer-playlist.swf" />
                <param name="flashvars" value="showtime=true&autoreplay=true&xml=<?=rawurlencode($config_live_site."/generadorxml.php?id=".$id)?>" />
            </object>-->
        </div>
        <div id="radcontent">
            <?=($radio->informacion)?>
        </div>
    </div>
</div>
<?php include("plantillas/sidebar.php") ?>