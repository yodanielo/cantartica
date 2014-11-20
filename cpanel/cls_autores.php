<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        if($_POST["accion"]=="20"){
            $_POST["canlayout"]="1";
        }
        $this->ini_datos("can_autores","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_autores";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"autores.php","url"=>"autores.php");
        $r->columnas=array(
                array("titulo"=>"Nombre","campo"=>"nombre"),
                //array("titulo"=>"Tipo","campo"=>"tipo"),
                //array("titulo"=>"Apellidos","campo"=>"apellidos"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre:","campo"=>"nombre","tipo"=>"text"),
                array("label"=>"Layout:","campo"=>"idlayout","tipo"=>"select","tabla_asoc"=>"can_layouts","campo_asoc"=>"nombre","id_asoc"=>"id"),
                //array("label"=>"Tipo:","campo"=>"tipo","tipo"=>"select","opciones"=>$this->getTipo()),
                array("label"=>"Texto<br/>(Español):","campo"=>"bio_es","tipo"=>"fck"),
                array("label"=>"Texto<br/>(Ingles):","campo"=>"bio_en","tipo"=>"fck"),
//                array("label"=>"Recurso 1:","campo"=>"recurso1","tipo"=>"archivo"),
//                array("label"=>"Recurso 2:","campo"=>"recurso2","tipo"=>"archivo"),
        );
        return $m_Form->ver();
    }
    function getTipo(){
        $cad='';
        $cad.='<option value="Poeta">Poeta</option>';
        $cad.='<option value="Radio">Radio</option>';
//        $cad.='<option value=""></option>';
//        $cad.='<option value=""></option>';
        return $cad;
    }
}
?>
