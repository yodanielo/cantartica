<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        if(!$_POST["idobj"] || $_POST["idobj"]=="")
            $_POST["idobj"]="1";
        if($_POST["accion"]!="2")
            $_POST["accion"]="20";
        $this->ini_datos("can_secciones","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_secciones";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"letras.php","url"=>"letras.php");
        $r->columnas=array(
                array("titulo"=>"Nombre","campo"=>"nombre"),
        );
        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre:","campo"=>"nombre","tipo"=>"text","extras"=>"readonly"),
                array("label"=>"Texto Español:","campo"=>"texto_es","tipo"=>"fck"),
                array("label"=>"Texto Inglés:","campo"=>"texto_en","tipo"=>"fck"),
                array("label"=>"Imágen:","campo"=>"porimagen","tipo"=>"archivo"),
        );
        return $m_Form->ver();
    }
}
?>
