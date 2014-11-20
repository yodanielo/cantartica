<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_portada","id");
    }
    function get_posiciones(){
        $r='';
        $r.='<option value="Posición 1">Posición 1</option>';
        $r.='<option value="Posición 2">Posición 2</option>';
        $r.='<option value="Posición 3">Posición 3</option>';
        $r.='<option value="Posición 4">Posición 4</option>';
        return $r;
    }
    function get_categorias(){
        $sql="SELECT a.* FROM `can_categorias` as a inner join can_secciones as b on a.idseccion=b.id where b.idnumero=".$_SESSION["num_activo"];
        //echo $sql;
        $res=$this->datos->ejecutar($sql);
        $cad='';
        while($r = mysql_fetch_object($res)){
            //echo $r->nombre."R";
            $cad.='<option value="'.$r->id.'">'.utf8_encode($r->nombre).'</option>'."\n";
        }
        return $cad;
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
            array("label"=>"Destacar en:","campo"=>"position","tipo"=>"select","opciones"=>$this->get_posiciones()),
            array("label"=>"Imagen","campo"=>"iniimagen","tipo"=>"archivogg",
                "tooltip"=>"Formatos permitidos: jpg<br/>Tamaño ideal: 225px x 350px",
                "extensiones"=>"*.jpg",
                "descripcion"=>"Imágenes (*.jpg)"
                ),
            array("label"=>"Categoría","campo"=>"idarticulo","tipo"=>"select","opciones"=>$this->get_categorias()),
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select a.*,b.nombre from can_portada as a inner join can_categorias as b on a.idarticulo=b.id where a.idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Categoría","campo"=>"nombre"),
                array("titulo"=>"Posición","campo"=>"position"),
                array("titulo"=>"Imagen","campo"=>"iniimagen"),
        );
        return $r->ver();
    }
    function pre_ins(){
        $this->datos->agregar("position",utf8_encode($_POST["position"]));
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
    function pre_upd(){
        //die($_POST["position"]);
        $this->datos->agregar("position",utf8_encode($_POST["position"]));
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
}
?>
