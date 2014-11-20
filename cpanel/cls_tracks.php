<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_tracks","id");
    }
    function get_radios(){
        $sql="select can_radio.* from  can_radio where can_radio.idnumero=".$_SESSION["num_activo"];
        $res=$this->datos->ejecutar($sql);
        $cad='';
        while($r=mysql_fetch_object($res)){
            $cad.='<option value="'.$r->id.'">'.$r->canal.'</option>';
        }
        return $cad;
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre del canal:","campo"=>"idradio","tipo"=>"select","opciones"=>$this->get_radios()),
                array("label"=>"Título:","campo"=>"nombre"),
                array("label"=>"Audio","campo"=>"sonido","tipo"=>"archivogg",
                    'tooltip'=>"Formatos permitidos: mp3",
                    "extensiones"=>"*.mp3",
                    "descripcion"=>"Audios (*.mp3)"
                ),

                //array("label"=>"Información","campo"=>"informacion","tipo"=>"fck"),
                
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select can_tracks.*,can_radio.canal from can_tracks inner join can_radio on can_tracks.idradio=can_radio.id where can_radio.idnumero=".$_SESSION["num_activo"];
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"tracks.php","url"=>"tracks.php");
        $r->columnas=array(
                //array("titulo"=>"Autor","campo"=>"idautor"),
                array("titulo"=>"Canal","campo"=>"canal"),
                array("titulo"=>"Nombre del canal","campo"=>"nombre"),
                array("titulo"=>"Archivo","campo"=>"sonido"),
        );

        return $r->ver();
    }
    function pre_ins(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
    function pre_upd(){
        $this->datos->agregar("idnumero",$_SESSION["num_activo"]);
    }
}
?>
