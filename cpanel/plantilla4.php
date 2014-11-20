<?php
include("cls_MantixOaD.php");
$db=new MantixOaD();
if($_GET["tipo"]=="seccion")
    $tabla="can_plantilla4_seccion";
else
    $tabla="can_plantilla4_categorias";
//echo "select * from $tabla where idtabla=".intval($_GET["mid"]);
$res=$db->ejecutar("select * from $tabla where idtabla=".intval($_GET["mid"]));
//$r=mysql_fetch_object($res);

?>
<div id="fila_recurso1" class="form_fila">
    <div class="form_label">Fotografías:</div>
    <div class="form_ctl">
        <div style="float:left;">
            <div id="listado_imagenes">
                <?php
                /*while($r=mysql_fetch_object($res)) {
                        echo '<li>'.$r->imagen.'</li>';
                    }*/
                ?>
            </div>
            <div id="pl1_controles">
                <a class="pl1_btn pl1_btn_1" title="Formatos permitidos: jpg<br/>Tamaño ideal: 600 x 450 px"><input type="hidden" name="udf_asignarfotos" id="udf_asignarfotos" /></a>
                <a class="pl1_btn" title="<div align=center>Ver en modo lista</div>" id="pl_vlista" style="float:left;"><img src="images/ico-listado-0.gif"/></a>
                <a class="pl1_btn" title="<div align=center>Ver en modo miniaturas</div>" id="pl_vgal" style="float:left;"><img src="images/ico-listado-imagen-0.gif"/></a>
                <a class="pl1_btn" id="togglegrid" style="float:right;width:108px;">Asignar posición</a>
            </div>
            <a class="pl2_btn"><img src="images/flecha-fotografias_der.gif"/></a>
        </div>
        <div id="matriz">
            <div id="cdm1" class="cuadromatriz"></div>
            <div id="cdm2" class="cuadromatriz"></div>
            <div id="cdm3" class="cuadromatriz"></div>
            <div id="cdm4" class="cuadromatriz"></div>
            <div id="cdm5" class="cuadromatriz"></div>
            <div id="cdm6" class="cuadromatriz"></div>
            <div id="cdm7" class="cuadromatriz"></div>
            <div id="cdm8" class="cuadromatriz"></div>
            <div id="cdm9" class="cuadromatriz"></div>
            <div id="cdm10" class="cuadromatriz"></div>
            <div id="cdm11" class="cuadromatriz"></div>
            <div id="cdm12" class="cuadromatriz"></div>
            <div id="cdm13" class="cuadromatriz"></div>
            <div id="cdm14" class="cuadromatriz"></div>
            <div id="cdm15" class="cuadromatriz"></div>
            <div id="cdm16" class="cuadromatriz"></div>
            <div id="cdm17" class="cuadromatriz"></div>
            <div id="cdm18" class="cuadromatriz"></div>
            <div id="cdm19" class="cuadromatriz"></div>
            <div id="cdm20" class="cuadromatriz"></div>
            <div id="cdm21" class="cuadromatriz"></div>
            <div id="cdm22" class="cuadromatriz"></div>
            <div id="cdm23" class="cuadromatriz"></div>
            <div id="cdm24" class="cuadromatriz"></div>
            <div id="cdm25" class="cuadromatriz"></div>
            <div id="cdm26" class="cuadromatriz"></div>
            <div id="cdm27" class="cuadromatriz"></div>
            <div id="cdm28" class="cuadromatriz"></div>
            <div id="cdm29" class="cuadromatriz"></div>
            <div id="cdm30" class="cuadromatriz"></div>
            <div id="cdm31" class="cuadromatriz"></div>
            <div id="cdm32" class="cuadromatriz"></div>
            <div id="cdm33" class="cuadromatriz"></div>
            <div id="cdm34" class="cuadromatriz"></div>
            <div id="cdm35" class="cuadromatriz"></div>
            <div id="cdm36" class="cuadromatriz"></div>
        </div>
        <div class="leyenda_matriz">
            <strong>&middot;</strong> Para ubicar una imágen en la matriz, arrastrar y soltar la imágen donde desee.<br/>
            <strong>&middot;</strong> Para eliminar hacer doble clic sobre la imágen.
        </div>
        <a id="agg_titletag_m">
            <textarea id="agg_titleinput"></textarea>
            <input type="button" id="agg_titlebutton" value="Guardar"/>
        </a>
        <!--<script type="text/javascript">hacerupload_pl1("asignarfotos","*.jpg;","Imágenes (jpg)")</script>-->
    </div>
</div>
<div id="noestan">

</div>
<script type="text/javascript">
    $(".pl1_btn_1").tooltip({effect: 'slide'});
<?php
$cad1='';
$cad2=array();
while($r=mysql_fetch_object($res)) {
    if($r->posicion!="") {
        $cad1.='$("#'.$r->posicion.'").append(\'<input type="hidden" name="pl1_img[]" value="'.$r->pl4image.'" class="pl1_img" />\');'."\n";
        $cad1.='$("#'.$r->posicion.'").append(\'<input type="hidden" name="pl1_cdr[]" value="'.$r->posicion.'" />\');'."\n";
        $cad1.='$("#'.$r->posicion.'").addClass("pl1_selected").css("background", "url(tumber.php?w=30&h=30&src=../images/recursos/'.$r->pl4image.')");'."\n";
    }else {
        //primero hago el proceso y luego cambio la bandera
        /*$cad2.='$("#listado_imagenes").append(\'<div class="padrag"><a></a>'.$r->pl4image.'</div>\');'."\n";
        $cad2.='$("#listado_imagenes div a").click(function(){'."\n";
        $cad2.='    $(this).parent().remove();'."\n";
        $cad2.='    do_noestan();'."\n";
        $cad2.='})'."\n";
        $cad2.='multiarch_pl1();'."\n";
        $cad2.='do_noestan();'."\n";*/
        array_push($cad2, $r->pl4image);
        //$cad2.='{\''.$r->pl4image.'\');'."\n";
    }
}
?>
</script>
<script type="text/javascript">
<?php
if(count($cad2)>0) {
    echo 'var cadetes= new Array("'.implode($cad2,'","').'");'."\n";
    echo 'hacerupload_pl1("asignarfotos","*.jpg;","Imágenes (jpg)",cadetes);';
}else {
    echo 'var cadetes=new Array();'."\n";
    echo 'hacerupload_pl1("asignarfotos","*.jpg;","Imágenes (jpg)",cadetes);';
}
echo $cad1;
?>
    $(".pl1_selected").draggable({
        cursorAt:{
            left:0,
            top:0
        },
        //cursor:"move",
        revert:true,
        refreshPositions: true
    });
<?php
if($_GET["mid"]!="") {
    echo '$("#togglegrid").click();';
}?>
</script>

<script type="text/javascript">
    //tooltip p123
    esfirme=false;
    elfirme=null;
    textodef="Ingresa el texto descriptivo.";
    function pl123_click(){
        $("#agg_titletag_m").show();
        esfirme=true;
        elfirme=this;
        $("#agg_titlebutton").click(function(){
            $(elfirme).find(".agg_htitle").val($("#agg_titleinput").val());
            esfirme=false;
            $("#agg_titletag_m").hide();
        });

        $("#agg_titlebutton").show();
        if($("#agg_titleinput").val()==textodef)
            $("#agg_titleinput").val("");
        $("#agg_titleinput").focus();
    }
    $("#agg_titletag_m").blur(function(){
        alert("p");
        esfirme=false;
        $(this).hide();
    });
    function pl123_show(){
        if(!esfirme){
            if($(this).find(".agg_htitle").length==0){
                $(this).append('<input type="hidden" class="agg_htitle" name="title[]" value="" />');
            }
            $("#agg_titletag_m").show();
            if($(this).find(".agg_htitle").val()=="")
                $("#agg_titletag_m #agg_titleinput").val(textodef);
            else
                $("#agg_titletag_m #agg_titleinput").val($(this).find(".agg_htitle").val());

            $("#agg_titlebutton").hide();
        }
    }
    function pl123_hide(){
        if(!esfirme){
            $("#agg_titletag_m").hide();
            $("#agg_titletag_m #agg_titleinput").val("");
        }
    }

    $(".cuadromatriz").click(pl123_click);
    $(".cuadromatriz").hover(pl123_show, pl123_hide);
</script>
