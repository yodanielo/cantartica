<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_editorial","id");
    }
    function formulario() {
        $idn= $_SESSION["num_activo"];
        if($_POST["accion"]!=20 && $_POST["accion"]!=2) {
            $_POST["accion"]=20;
            $sql="select id from can_editorial where idnumero=".$idn;
            $_POST["idobj"]=$this->datos->get_simple($sql);
        }
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Imagen","campo"=>"recurso1","tipo"=>"archivogg",
                        "tooltip"=>"Formatos permitidos: jpg<br/>Tamaño ideal: 380 x 391 px",
                        "extensiones"=>"*.jpg;*.png;*.gif",
                        "descripcion"=>"Imágenes (*.jpg,*.png,*.gif)"
                ),
                array("label"=>"Autor de la imágen","campo"=>"imgautor","tipo"=>"fck"),
                array("label"=>"Descripción","campo"=>"descripcion","tipo"=>"fck")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,'Editorial' as tit from can_editorial where idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"editorial.php","url"=>"editorial.php","ver_eliminar"=>"0","ver_estado"=>"0","ver_nro"=>"0");
        $r->columnas=array(
                array("titulo"=>"Título","campo"=>"tit"),
        );

        return $r->ver();
    }
}
?>
