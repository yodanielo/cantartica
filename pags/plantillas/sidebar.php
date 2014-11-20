<div id="sidebarportada">
    <div class="imgcortado corto">
        <img src="images/tit-<?=aurl($_GET["opc"])?>.gif"/>
    </div>
    <?php
        if(!isset($_GET["cat"])){
            if(cie($content->imgseccion)!="")
                echo '<img class="imgsidebar" src="images/recursos/'.cie($content->imgseccion).'"/>';
            else
                echo '<div class="imgsidebar"></div>';
        }
        else{
            if(file_exists("images/porimagen/".cie($content->catimagen)) && cie($content->catimagen)!="")
                echo '<img class="imgsidebar" src="images/porimagen/'.cie($content->catimagen).'"/>';
            else
                echo '<div class="imgsidebar"></div>';
        }
    ?>
    <div id="autoreslista" class="auts_<?=str_replace("-","_",$_GET["opc"])?>">
        <?php
        if(count($auts)>0){
            $se="";
            $sa="";
            foreach($auts as $aut) {
                $clase="";
                if($_GET["cat"]==$aut->id && isset($_GET["cat"])){
                    $se='<div id="selected_cat">'.cie(separar_nombres($aut->nombre,18)).'</div>';
                    $clase='class="subm_selected"';
                }
                $sa.='<a '.$clase.' href="index.php?opc='.str_replace("_","-",$_GET["opc"]).'&cat='.$aut->id.'">'.cie(separar_nombres($aut->nombre,18)).'aa</a><br/>'."\n";
            }
            echo $se;
            echo $sa;
        }
        ?>
    </div>
    <script type="text/javascript">
        $("#autoreslista a").each(function(){
            $(this).find("br:last").remove();
            x=$(this).html().substr(0,$(this).html().length-2);
            $(this).html(x);
        })
    </script>

    <div id="agras">
        <span>Agradecemos a:</span>
        <?php
        if(count($agras)>0)
            foreach($agras as $agra) {
                echo cie('<a target="_blank" href="'.$agra->url.'"><img style="width:140px; height:140px;" src="images/recursos/'.cie($agra->banimage).'"/></a>');
            }
        ?>
    </div>
</div>