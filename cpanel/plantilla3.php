<?php
include("cls_MantixOaD.php");
$db=new MantixOaD();
if($_GET["tipo"]=="seccion")
    $tabla="can_plantilla3_seccion";
else
    $tabla="can_plantilla3_categorias";
//echo "select * from $tabla where idtabla=".intval($_GET["mid"]);
$res=$db->ejecutar("select * from $tabla where not isnull(recurso1) and recurso1<>'' and idtabla=".intval($_GET["mid"]));
?>
<div id="fila_recurso1" class="form_fila">
    <div class="form_label">Imagen de Editorial</div>
    <div class="form_ctl">
        <div class="agg_contenedor">
            <?php
            while($r=mysql_fetch_object($res)) {
                $r->recurso1=utf8_encode($r->recurso1);
                $r->recurso2=utf8_encode($r->recurso2);
                ?>
            <div class="pl23_item">
                <input type="hidden" name="recurso1[]" value="<?=$r->recurso1?>" />
                <input type="hidden" class="agg_htitle" name="agg_htitle[]" value="<?=$r->recurso2?>" />
                <a></a>
                <?=$r->recurso1?>
                <?php
                if(substr($r->recurso1, strlen($r->recurso1)-3)=="jpg")
                        echo '<img src="images/ico-imagen.png" />';
                else
                        echo '<img src="images/ico-video.png" />';
                ?>
            </div>
                <?php
            }
            ?>
        </div>
        <a id="agg_titletag">
            <textarea id="agg_titleinput"></textarea>
            <input type="button" id="agg_titlebutton" value="Guardar"/>
        </a>
        <div class="pl1_controles">
            <a class="agm_btn" title="Formatos permitidos: jpg<br/>Ancho ideal: 362px"><input type="hidden" name="udf_recurso_agg" id="udf_recurso_agg"/></a>
        </div>
        <script type="text/javascript">archivogg_multi();
        $(".agm_btn").tooltip({effect: 'slide'});</script>
    </div>
</div>