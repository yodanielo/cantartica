<div id="edit_imagen">
    <img src="tumber.php?w=380&src=images/foto-editorial.png" />
</div>
<div id="edit_texto" style="background:none">
    <ul>
        <?php
        $cad='';
        if(count($res)>0)
            foreach($res as $r) {
                if($r->id==$_SESSION["numero"])
                    $cad.='<li class="archivonum" onclick="asignar_numero('.$r->id.')"><strong>&middot;</strong>&nbsp;<strong>'.$r->nombre.' Cantartica</strong></li>';
                else
                    $cad.='<li class="archivonum" onclick="asignar_numero('.$r->id.')"><strong>&middot;</strong> '.$r->nombre.' Cantartica</li>';
            }
        echo $cad;
        ?>
    </ul>
</div>