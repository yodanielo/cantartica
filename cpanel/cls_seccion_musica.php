<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_secciones","id");
    }
    function guardar_plantilla() {
        if($_POST["plantilla"]=="plantilla2") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla2_seccion where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                for($i=0;$i<count($_POST["recurso1"]);$i++){
                    //foreach($_POST["recurso1"] as $pl2)
                    $pl2=$_POST["recurso1"][$i];
                    $pl2text=$_POST["agg_htitle"][$i];
                    $this->datos->ejecutar("insert into can_plantilla2_seccion values(null,'".$pl2."','".$pl2text."',now(),null,1,1,1,".$this->id.")");
                }
        }
        if($_POST["plantilla"]=="plantilla3") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla3_seccion where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                for($i=0;$i<count($_POST["recurso1"]);$i++){
                    //foreach($_POST["recurso1"] as $pl2)
                    $pl2=$_POST["recurso1"][$i];
                    $pl2text=$_POST["agg_htitle"][$i];
                    $this->datos->ejecutar("insert into can_plantilla3_seccion values(null,'".$pl2."','".$pl2text."',now(),null,1,1,1,".$this->id.")");
                }
            //die(mysql_error());
        }
        if($_POST["plantilla"]=="plantilla5") {
            if($this->id)
                $this->datos->ejecutar("delete from can_plantilla5_seccion where idtabla=".$this->id);
            if(count($_POST["recurso1"])>0)
                for($i=0;$i<count($_POST["recurso1"]);$i++){
                    //foreach($_POST["recurso1"] as $pl2)
                    $pl2=$_POST["recurso1"][$i];
                    $pl2text=$_POST["agg_htitle"][$i];
                    $this->datos->ejecutar("insert into can_plantilla5_seccion values(null,'".$pl2."','".$pl2text."',now(),null,1,1,1,".$this->id.")");
                }
            //die(mysql_error());
        }
    }
    function get_plantillas() {
        $r='';
        $r.='<label><input type="radio" name="plantilla" value="plantilla1" /> Plantilla 1</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla2" /> Plantilla 2</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla3" /> Plantilla 3</label>';
        $r.='<label><input type="radio" name="plantilla" value="plantilla5" /> Plantilla 4</label>';
        return $r;
    }
    function formulario() {
        if($_POST["accion"]!=20 && $_POST["accion"]!=2) {
            $_POST["accion"]=20;
            $_POST["idobj"]=$this->datos->get_simple("select id from can_secciones where nombre='Música' and idnumero=".$_SESSION["num_activo"]);
        }
        if($_POST["accion"]=="2") {
            $this->guardar_plantilla();
        }
        //cojo los parametros de la plantilla
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                //array("label"=>"Título:","campo"=>"canal","tipo"=>"text"),
                array("label"=>"Elegir Plantilla","campo"=>"plantilla","tipo"=>"select_plantilla","opciones"=>$this->get_plantillas()),
                array("label"=>"Texto<br/>(Español):","campo"=>"texto_es","tipo"=>"fck"),
                array("label"=>"Texto<br/>(Inglés):","campo"=>"texto_en","tipo"=>"fck"),
                array("label"=>"Imágen de sección:","campo"=>"imgseccion","tipo"=>"archivogg",
                    "tooltip"=>"Tamaño ideal: 140 x 140 px<br/>Formatos permitidos: jpg",
                    "extensiones"=>"*.jpg",
                    "descripcion"=>"Imágenes JPG"
                    ),
                array("label"=>"Banners","campo"=>"banners","tipo"=>"transferencia","tabla_asoc"=>"can_banners","campo_asoc"=>"banimage","id_asoc"=>"id")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *, replace(replace(replace(plantilla,'plantilla','Plantilla '),4,1),5,4) as pl from can_secciones where nombre='Música' and idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"seccion_musica.php","url"=>"seccion_musica.php","ver_eliminar"=>"0","ver_estado"=>"0","ver_nro"=>"0");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Nombre","campo"=>"nombre"),
                array("titulo"=>"Plantilla","campo"=>"pl"),
        );
        return $r->ver();
    }
    function pre_upd() {
        $this->datos->agregar("nombre",utf8_encode("Música"));
        $this->datos->agregar("plantilla",$_POST["plantilla"]);
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
    function pre_ins() {
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
}
?>
