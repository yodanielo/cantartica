<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    var $idpre;
    var $manda;
    function __construct() {
        $this->idpre=$_POST["idpre"];
        $this->manda=$_POST["manda"];
        $this->ini_datos("can_layout1","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_layout1 were idart=".$this->idpre." and mana='".$this->manda."'";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"layout1.php","url"=>"layout1.php");
        $r->columnas=array(
                array("titulo"=>"Título","campo"=>"titulo"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Título","campo"=>"titulo","tipo"=>"text"),
                array("label"=>"Imagen","campo"=>"layrecurso","tipo"=>"archivogg",
                        "tooltip"=>"Formatos esperados: jpg",
                        "extensiones"=>"*.jpg",
                        "descripcion"=>"Imágenes (*.jpg)",
                ),
        );
        return $m_Form->ver();
    }
}
?>
