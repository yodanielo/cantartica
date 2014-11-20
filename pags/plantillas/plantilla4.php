<div id="col1" style="width:362px">
    <?php
    for($i=1;$i<=36;$i++) {
        //echo '<a class="cuadromatriz" id="cdm'.$i.'"></a>';
        if($i>1 && $i%3==0)
            echo '<a class="cuadromatriz cuadro116" id="cdm'.$i.'" style="margin-right:0px;"></a>';
        else
            echo '<a class="cuadromatriz cuadro116" id="cdm'.$i.'"></a>';
    }
    ?>
</div>
<div id="col2" style="width:440px;margin-left:20px;" class="texto_<?=str_replace("-","_",$_GET["opc"])?>">
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
        <!-- AddThis Button END -->
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c571bcc72d12af7"></script>
    </div>
</div>
<?php include("sidebar.php") ?>
<script type="text/javascript">
<?php
if(count($plantillas)>0)
    foreach($plantillas as $p) {
        if($p->posicion!="")
            echo "agregar_matriz('".$p->posicion."','".$p->pl4image."');"."\n";
    }
?>
    load_plantilla4();
</script>