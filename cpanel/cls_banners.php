<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_banners","id");
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
            array("label"=>"Nombre","campo"=>"nombre","tipo"=>"text","obligatorio"=>"1"),
            array("label"=>"URL","campo"=>"url","tipo"=>"text"),
            array("label"=>"Archivo","campo"=>"banimage","tipo"=>"archivogg","obligatorio"=>"1",
                "tooltip"=>"Formatos permitidos: Imágenes(jpg, gif, png), Flash<br/>Tamaño ideal: 140px x 140px",
                "extensiones"=>"*.jpg;*.gif;*.png;*.swf",
                "descripcion"=>"Imágenes (*.jpg, *.gif, *.png), Flash (*.swf)"
            ),
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,SUBSTR(banimage,LENGTH(banimage)-3) as extension from can_banners where idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"banners.php","url"=>"banners.php");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Nombre","campo"=>"nombre"),
                array("titulo"=>"URL","campo"=>"url"),
                array("titulo"=>"Archivo","campo"=>"banimage"),
        );
        return $r->ver();
    }
    function pre_ins(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
    function pre_upd(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
}
?>
