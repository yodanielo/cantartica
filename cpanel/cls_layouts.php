<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_layouts","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_layouts";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"layouts.php","url"=>"layouts.php");
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
                array("label"=>"Nombre:","campo"=>"nombre","tipo"=>"text"),
                array("label"=>"Descripción:","campo"=>"descripcion","tipo"=>"fck"),
        );
        return $m_Form->ver();
    }
}
?>
