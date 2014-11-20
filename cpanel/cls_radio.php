<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_radio","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_radio where idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"radio.php","url"=>"radio.php");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Nombre del canal","campo"=>"canal"),
        );

        return $r->ver();
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre del canal:","campo"=>"canal","tipo"=>"text"),
                //array("label"=>"Autor:","campo"=>"idautor","tipo"=>"select","tabla_asoc"=>"can_autores","campo_asoc"=>"nombre","id_asoc"=>"id"),
                array("label"=>"Imagen","campo"=>"radbanner","tipo"=>"archivogg",
                    'tooltip'=>"Formatos permitidos: jpg<br/>Tamaño ideal: 561px x 276px",
                    "extensiones"=>"*.jpg",
                    "descripcion"=>"Imágenes (*.jpg)"
                ),
                array("label"=>"Imagen","campo"=>"radimagen","tipo"=>"archivogg",
                    'tooltip'=>"Formatos permitidos: jpg<br/>Tamaño ideal: 75px x 75px",
                    "extensiones"=>"*.jpg",
                    "descripcion"=>"Imágenes (*.jpg)"
                ),
                array("label"=>"Información","campo"=>"informacion","tipo"=>"fck"),
                /*array("label"=>"Podcast","campo"=>"podcast","tipo"=>"archivogg_multi",
                    'tooltip'=>"Formatos permitidos: mp3",
                    'extensiones'=>"*.mp3",
                    'descripcion'=>"Archivos de vídeo (*.mp3)"
                    ),*/
        );
        return $m_Form->ver();
    }
    function pre_ins(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
    function pre_upd(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
}
?>
