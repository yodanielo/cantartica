<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    function __construct() {
        $this->ini_datos("can_numeros","id");
    }
    function get_activo() {
        $r='';
        $r.='<option value="0">No</option>';
        $r.='<option value="1">Sí</option>';
        return $r;
    }
    function get_edicion() {
        $r='';
        $r.='<option value="1">Sí</option>';
        $r.='<option value="0">No</option>';
        return $r;
    }
    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Registro");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"Nombre:","campo"=>"nombre","tipo"=>"text"),
                array("label"=>"Fecha de Publicación (Ref.):","campo"=>"fechapub","tipo"=>"fecha"),
                array("label"=>"Llave:","campo"=>"llave","tipo"=>"text"),
                array("label"=>"URL de acceso:","campo"=>"llave","tipo"=>"canlink","pref"=>"http://www.edmultimedia.biz/ddesarrollo/cantartica/index.php?numero="),
                array("label"=>"Activo Front-end:","campo"=>"activo","tipo"=>"select","opciones"=>$this->get_activo()),
                array("label"=>"En edición:","campo"=>"edicion","tipo"=>"select","opciones"=>$this->get_edicion()),
        );
        return $m_Form->ver();
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,if(activo=1,'Activo','') as esactivo,if(edicion=1,'Editando','') as eseditando,concat('http://www.cantartica.es?numero=',llave) as url from can_numeros";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id desc","url_form"=>"numeros.php","url"=>"numeros.php","ver_estado"=>"0");
        $r->columnas=array(
                array("titulo"=>"Nombre","campo"=>"nombre"),
                array("titulo"=>"Fecha de publicación","campo"=>"fechapub"),
                array("titulo"=>"Llave","campo"=>"llave"),
                array("titulo"=>"URL de acceso","campo"=>"url"),
                array("titulo"=>"Activo","campo"=>"esactivo"),
                array("titulo"=>"En edición","campo"=>"eseditando"),
        );

        return $r->ver();
    }
    function pre_ins() {

    }
    function post_ins() {
        $idnumero=$this->id;
        $_SESSION["num_activo"]=$this->id;
        $cates=array("Letras","Artes","Música","Film / Vídeo","Artes Plásticas");
        foreach($cates as $cate) {
            $sql="insert into can_secciones values(null,'".$cate."','','','','',now(),null,1,null,1,'plantilla1',".$idnumero.",'')";
            $this->datos->ejecutar($sql);
            if(mysql_error())
                die(mysql_error());
        }
        $sql="insert into can_agenda_portada values(null,'','',now(),null,1,1,1,".$idnumero.")";
        $this->datos->ejecutar($sql);
        $sql="insert into can_radio_portada values(null,'',now(),null,1,1,1,".$idnumero.")";
        $this->datos->ejecutar($sql);
        $sql="insert into can_editorial(
recurso1	,
descripcion	,
inserted	,
updated	,
user_inserted	,
user_updated	,
estado	,
idnumero) values('','',now(),null,1,1,1,".$idnumero.")";
        $this->datos->ejecutar($sql);
        $this->hacer_activo($this->id);
    }
    function pre_upd() {
        $this->hacer_activo($_POST["idobj"]);
    }
    function hacer_activo($num) {
        if($_POST["activo"]==1) {
            $this->datos->ejecutar("update can_numeros set activo=0");
            $this->datos->ejecutar("update can_numeros set activo=1 where id=".$num);

            //$_SESSION["num_activo"]=$this->datos->get_simple("select max(id) from can_numeros");
            //$_SESSION["num_activo"]=$num;
        }
        if($_POST["edicion"]==1){
            $this->datos->ejecutar("update can_numeros set edicion=0");
            $this->datos->ejecutar("update can_numeros set edicion=1 where id=".$num);
            $_SESSION["num_activo"]=$num;
        }
    }
}
?>
