<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_agradecimiento","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_agradecimiento";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"agradecimiento.php","url"=>"agradecimiento.php");
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
                array("label"=>"Número:","campo"=>"numero","tipo"=>"select","tabla_asoc"=>"can_numeros","campo_asoc"=>"nombre","id_asoc"=>"id","ordenar"=>"id desc"),
                array("label"=>"Imágen:","campo"=>"agraimagen","tipo"=>"archivo"),
                array("label"=>"Link:","campo"=>"link"),
        );
        return $m_Form->ver();
    }
}
?>
