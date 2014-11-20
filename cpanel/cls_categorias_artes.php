<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_categorias","id");
        /*if($_POST["accion"]=="2"){
            $this->guardar_plantilla();
        }*/
        /*if($_POST["accion"]!=20 && $_POST["accion"]!=2){
            $_POST["accion"]=20;
            $_POST["idobj"]=1;
        }*/
    }
    function guardar_plantilla() {
        //Imagen de menu
        $saco=array();
        $c=count($_POST["posi_pos"]);
        //actualizo los que estan disponibles sus avatars
        for($i=0;$i<$c;$i++) {
            $ppos=$_POST["posi_pos"][$i];
            $pimg=$_POST["posi_img"][$i];
            $sql="select id from can_categorias where porimagen like '".$pimg."'";
            $mmid=$this->datos->get_simple($sql);
            $saco[]=$mmid;
            $sql="update can_categorias set pospl='".$ppos."' where id=".$mmid;
            $this->datos->ejecutar($sql);
        }
        //fin Imagen de menu
        if($_POST["plantilla"]=="plantilla4") {
            if($this->id){
                $msql="delete from can_plantilla4_categorias where idtabla=".$this->id.";";
                $this->datos->ejecutar($msql);
            }
            //if(count($_POST["pl1_img"])>0){
            $csql.="";
            /*echo '<pre>';
            print_r($_POST["pl1_img"]);
            print_r($_POST["pl1_cdr"]);
            print_r($_POST["noestan"]);
            echo '</pre>';*/
            for($i=0;$i<count($_POST["pl1_img"]);$i++) {
                $msql="insert into can_plantilla4_categorias values(null,'".$_POST["pl1_cdr"][$i]."','".$_POST["pl1_img"][$i]."',now(),null,1,1,1,".$this->id.");";
                $this->datos->ejecutar($msql);
                /*$this->datos->ejecutar($sql);
                if(mysql_error())
                    die(mysql_error());*/
            }
            $c=count($_POST["noestan"]);
            for($i=0;$i<$c;$i++) {
                $sql="insert into can_plantilla4_categorias values(null,'','".$_POST["noestan"][$i]."',now(),null,1,1,1,".$this->id.")";
                $this->datos->ejecutar($sql);
                if(mysql_error())
                    die(mysql_error());
            }
        }
        if($_POST["plantilla"]=="plantilla2") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla2_categorias where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                foreach($_POST["recurso1"] as $pl2)
                    $this->datos->ejecutar("insert into can_plantilla2_categorias values(null,'".$pl2."',null,now(),null,1,1,1,".$this->id.")");
        }
        if($_POST["plantilla"]=="plantilla3") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla3_categorias where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                foreach($_POST["recurso1"] as $pl2)
                    $this->datos->ejecutar("insert into can_plantilla3_categorias values(null,'".$pl2."',null,now(),null,1,1,1,".$this->id.")");
            //die(mysql_error());
        }
        if($_POST["plantilla"]=="plantilla5") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla5_categorias where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                foreach($_POST["recurso1"] as $pl2)
                    $this->datos->ejecutar("insert into can_plantilla5_categorias values(null,'".$pl2."',null,now(),null,1,1,1,".$this->id.")");
            //die(mysql_error());
        }
    }
    function get_plantillas() {
        $r='';
        $r.='<label><input type="radio" name="plantilla" value="plantilla4" /> Plantilla 1</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla2" /> Plantilla 2</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla3" /> Plantilla 3</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla5" /> Plantilla 4</label>';
        return $r;
    }
    function formulario() {
        $xx=$this->datos->get_simple("select plantilla from can_secciones where nombre like 'Artes Plásticas' and idnumero=".$_SESSION["num_activo"]);
        $this->semuestra=$xx;
        //cojo los parametros de la plantilla
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                //array("label"=>"Título:","campo"=>"canal","tipo"=>"text"),
                array("label"=>"Nombre","campo"=>"nombre","tipo"=>"text","obligatorio"=>"1"),
                array("label"=>"Imagen de la categoría","campo"=>"catimagen","tipo"=>"archivogg",
                        "tooltip"=>"Formatos permitidos: jpg<br/>Tamaño ideal: 140px x 140px",
                        "extensiones"=>"*.jpg",
                        "descripcion"=>"Imágenes (*.jpg)"
                ),
        );
        if($this->semuestra=="plantilla1")
            array_push($m_Form->controles,
                    array("label"=>"Imagen de menú","campo"=>"porimagen","tipo"=>"imagenmenu",
                    "tooltip"=>"Formatos permitidos: jpg<br/>Tamaño ideal: 87px x 87px",
                    "extensiones"=>"*.jpg",
                    "descripcion"=>"Imágenes (*.jpg)",
                    "nombre_seccion"=>"Artes Plásticas"
                    )
            );
        array_push($m_Form->controles,array("label"=>"Elegir Plantilla","campo"=>"plantilla","tipo"=>"select_plantilla","opciones"=>$this->get_plantillas(),"esseccion"=>"no"));
        //array("label"=>"Posición en portada","campo"=>"pospl","tipo"=>"ctposicion","idseccion"=>"1"),
        array_push($m_Form->controles,array("label"=>"Texto<br/>(Español):","campo"=>"texto_es","tipo"=>"fck"));
        array_push($m_Form->controles,array("label"=>"Texto<br/>(Inglés):","campo"=>"texto_en","tipo"=>"fck"));
        array_push($m_Form->controles,array("label"=>"Banners","campo"=>"banners","tipo"=>"transferencia","tabla_asoc"=>"can_banners","campo_asoc"=>"banimage","id_asoc"=>"id"));
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="SELECT can_categorias. *, replace(replace(replace(can_categorias.plantilla,'plantilla','Plantilla '),4,1),5,4) as pl
                FROM can_categorias
                INNER JOIN can_secciones ON can_categorias.idseccion = can_secciones.id
                where can_secciones.nombre like 'Artes Plásticas' and can_secciones.idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"posicion","url_form"=>"categorias_artes.php","url"=>"categorias_artes.php","ver_ordenar"=>"1");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Nombre","campo"=>"nombre"),
            array("titulo"=>"Plantilla","campo"=>"pl"),
        );
        return $r->ver();
    }
    function pre_ins() {
        $this->datos->agregar("idseccion",$this->datos->get_simple("select id from can_secciones where nombre like 'Artes Plásticas' and idnumero=".$_SESSION["num_activo"]));
        $this->datos->agregar("plantilla",$_POST["plantilla"]);
        $this->datos->agregar("posicion",$this->datos->get_simple("select ifnull(max(a.posicion),0)+1 from can_categorias a inner join can_secciones  b where a.idseccion=b.id and b.nombre like 'Artes Plásticas' and idnumero=".$_SESSION["num_activo"]));
    }
    function pre_upd() {
        $this->datos->agregar("idseccion",$this->datos->get_simple("select id from can_secciones where nombre like 'Artes Plásticas' and idnumero=".$_SESSION["num_activo"]));
        $this->datos->agregar("plantilla",$_POST["plantilla"]);
        //verifico si no hay imagen
        $this->guardar_plantilla();
        $this->datos->agregar("porimagen",$_POST["porimagen"]);
        $this->datos->agregar("pospl",$_POST["pospl"]);
    }
    function post_ins() {
        $this->guardar_plantilla();
    }
    function post_upd() {
    }
}
?>
