<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_menu_footer","id");
    }
    function formulario() {
        if($_POST["accion"]!=20 && $_POST["accion"]!=2){
            $_POST["accion"]=20;
            $_POST["idobj"]=1;
        }
        $idn= $_SESSION["num_activo"];
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Título","campo"=>"titulo","extras"=>"readonly"),
                array("label"=>"Autor de la Imágen","campo"=>"fooimgautor","tipo"=>"fck"),
                array("label"=>"Descripción","campo"=>"descripcion","tipo"=>"fck")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select * from can_menu_footer";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id","url_form"=>"menu_footer.php","url"=>"menu_footer.php","ver_eliminar"=>"0","ver_estado"=>"0");
        $r->columnas=array(
                array("titulo"=>"Artículo","campo"=>"titulo"),
        );
        return $r->ver();
    }
}
?>