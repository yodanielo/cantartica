<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_radio_portada","id");
    }
    function formulario() {
        $idn= $_SESSION["num_activo"];
        if($_POST["accion"]!=20 && $_POST["accion"]!=2){
            $_POST["accion"]=20;
            $sql="select id from can_radio_portada where idnumero=".$idn;
            $_POST["idobj"]=$this->datos->get_simple($sql);
        }
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Banners","campo"=>"banners","tipo"=>"transferencia","tabla_asoc"=>"can_banners","campo_asoc"=>"banimage","id_asoc"=>"id")
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,'Portada de Radio' as tit from can_radio_portada where idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"radio_portada.php","url"=>"radio_portada.php","ver_eliminar"=>"0","ver_estado"=>"0","ver_nro"=>"0");
        $r->columnas=array(
                array("titulo"=>"Título","campo"=>"tit"),
        );

        return $r->ver();
    }
}
?>
