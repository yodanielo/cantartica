<?php
include("cls_MantixOaD.php");
$db = new MantixOaD();
if ($_GET["tipo"] == "seccion"){
    $tabla = "can_plantilla5_seccion";
    $pie= $db->get_simple("select nombre_ancho from can_secciones where id=" . intval($_GET["mid"]));
}
else{
    $tabla="can_plantilla5_categorias";
    $pie= $db->get_simple("select nombre_ancho from can_categorias where id=" . intval($_GET["mid"]));
}
//echo "select * from $tabla where idtabla=".intval($_GET["mid"]);
$res = $db->ejecutar("select * from $tabla where not isnull(recurso1) and recurso1<>'' and idtabla=" . intval($_GET["mid"]));
?>
<div id="fila_nombre_ancho" class="form_fila">
    <div class="form_label">Pie de foto/vídeo</div>
    <div class="form_ctl">
        <input id="nombre_ancho" name="nombre_ancho" type="text" class="form_input" maxlength="150" value="<?=$pie?>">
        <input type="hidden" id="nombre_ancho_ant" name="nombre_ancho_ant" value="<?=$pie?>">
    </div>
</div>
<div id="fila_recurso1" class="form_fila">
    <div class="form_label">Imagen de Editorial</div>
    <div class="form_ctl">
        <div class="agg_contenedor solovideos">
            <?php
            while ($r = mysql_fetch_object($res)) {
                $r->recurso1 = utf8_encode($r->recurso1);
                $r->recurso2 = utf8_encode($r->recurso2);
            ?>
                <div class="pl23_item">
                    <input type="hidden" name="recurso1[]" value="<?= $r->recurso1 ?>" />
                    <input type="hidden" class="agg_htitle" name="agg_htitle[]" value="<?= $r->recurso2 ?>" />
                    <a></a>
                <?= $r->recurso1 ?>
                <?php
                if (substr($r->recurso1, strlen($r->recurso1) - 3) == "jpg")
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
            <a class="agm_btn" title="Formatos permitidos: Vídeos (flv)<br/>Tamaño ideal: 427px x 315px" ><input type="hidden" name="udf_recurso_agg" id="udf_recurso_agg"/></a>
        </div>
        <script type="text/javascript">archivogg_multi();
            $(".agm_btn").tooltip({effect: 'slide'});
        </script>
    </div>
</div>
<?php
            /*
              <div id="fila_recurso1" class="form_fila">
              <div class="form_label">Recurso 1:</div>
              <div class="form_ctl">
              <input type="text" value="<?=$r->recurso1?>" name="recurso1" id="recurso1" class="form_input" readonly class="form_input" />
              <input type="hidden" value="<?=$r->recurso1?>" name="ant_recurso1" id="ant_recurso1"/>
              <a class="uploadsubirarchivo" id="udfsubir_recurso1" title="Formatos permitidos:<br/>video: flv<br/>imagen:jpg">
              <input type="text" value="<?=$r->recurso1?>" name="udf_recurso1" id="udf_recurso1" class="form_input" readonly class="form_input" />
              </a>
              <a href="" class="uploadborrar" id="udfborrar_recurso1">Eliminar</a>
              <script type="text/javascript">hacerupload("recurso1","*.jpg; *.flv","Imágenes (jpg), Vídeos (flv)")</script>

              </div>
              </div>
              <br style="clear:both" />
              <div id="fila_recurso2" class="form_fila">
              <div class="form_label">Recurso 2:</div>
              <div class="form_ctl">
              <input type="text" value="<?=$r->recurso2?>" name="recurso2" id="recurso2" class="form_input" readonly class="form_input" />
              <input type="hidden" value="<?=$r->recurso2?>" name="ant_recurso2" id="ant_recurso2"/>
              <a class="uploadsubirarchivo" id="udfsubir_recurso2" title="Formatos permitidos:<br/>video: flv<br/>imagen:jpg">
              <input type="text" value="<?=$r->recurso2?>" name="udf_recurso2" id="udf_recurso2" class="form_input" readonly class="form_input" />
              </a>
              <a href="" class="uploadborrar" id="udfborrar_recurso2">Eliminar</a>

              <script type="text/javascript">hacerupload("recurso2","*.jpg; *.flv","Imágenes (jpg), Vídeos (flv)")</script>
              </div>
              </div>
              <br style="clear:both" />
             *
             */