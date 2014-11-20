<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_news","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_news";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"news.php","url"=>"news.php");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Nombre","campo"=>"nombre"),
                array("titulo"=>"Apellidos","campo"=>"apellidos"),
                array("titulo"=>"Correo","campo"=>"email"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre:","campo"=>"nombre","tipo"=>"text","obligatorio"=>"1"),
                array("label"=>"Apellidos:","campo"=>"apellidos","tipo"=>"text","obligatorio"=>"1"),
                array("label"=>"E-mail:","campo"=>"email","tipo"=>"text","obligatorio"=>"1"),
                array("label"=>"Edad:","campo"=>"edad","tipo"=>"text"),
                array("label"=>"Localidad:","campo"=>"localidad","tipo"=>"text"),
                array("label"=>"Intereses:","campo"=>"intereses","tipo"=>"text"),
                array("label"=>"Profesión:","campo"=>"profesion","tipo"=>"text"),
                array("label"=>"Comentario:","campo"=>"area","tipo"=>"area"),
        );
        return $m_Form->ver();
    }
}
?>
