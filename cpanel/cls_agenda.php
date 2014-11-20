<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_agenda","id");
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Título:","campo"=>"titulo","tipo"=>"text"),
                array("label"=>"Sub-Título:","campo"=>"subtitulo","tipo"=>"text"),
                array("label"=>"Fecha de inicio:","campo"=>"fecha_inicio","tipo"=>"fecha"),
                array("label"=>"Fecha de fin:","campo"=>"fecha_fin","tipo"=>"fecha"),
                array("label"=>"Imágen:","campo"=>"ageimagen","tipo"=>"archivogg",
                    "tooltip"=>"Formatos permitidos: jpg<br/>Ancho ideal: 379px",
                    "extensiones"=>"*.jpg",
                    "descripcion"=>"Im{agenes JPG"
                    ),
                array("label"=>"Descripción:","campo"=>"descripcion","tipo"=>"fck"),
                array("label"=>"Metadatos:","campo"=>"metadatos","tipo"=>"fck"),
                //array("label"=>"Banners","campo"=>"banners","tipo"=>"transferencia","tabla_asoc"=>"can_banners","campo_asoc"=>"nombre","id_asoc"=>"id")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_agenda";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"agenda.php","url"=>"agenda.php");
        $r->columnas=array(
                array("titulo"=>"Título","campo"=>"titulo"),
                array("titulo"=>"Sub-Título","campo"=>"subtitulo"),
                array("titulo"=>"Fecha de inicio","campo"=>"fecha_inicio"),
                array("titulo"=>"Fecha de fin","campo"=>"fecha_fin"),
        );

        return $r->ver();
    }
}
?>
