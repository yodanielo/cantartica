<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_sponsors","id");
    }
    function formulario() {
        $idn= $_SESSION["num_activo"];
        if($_POST["accion"]!=20 && $_POST["accion"]!=2) {
            $_POST["accion"]=20;
            $_POST["idobj"]=1;
        }
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Sponsors","campo"=>"descripcion","tipo"=>"fck")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,'Sponsors' as tit from can_sponsors";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"sponsors.php","url"=>"sponsors.php","ver_eliminar"=>"0","ver_estado"=>"0","ver_nro"=>"0");
        $r->columnas=array(
                array("titulo"=>"Título","campo"=>"tit"),
        );

        return $r->ver();
    }
}
?>
