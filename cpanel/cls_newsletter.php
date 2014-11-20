<?php
include("cls_MantixBase20.php");

class Registro extends MantixBase {
    var $de;
    function __construct() {
        $this->de="no-reply@cantartica.es";
        $_POST["quiensoy"]="W";
        $this->ini_datos("can_newsletter","id");
    }
    function lista() {
        $r = new MantixGrid();
        $sql="select *,date(inserted) as inserted2 from can_newsletter";
        $r->atributos=array("sql"=>$sql,"nropag"=>"20","ordenar"=>"id","url_form"=>"newsletter.php","url"=>"newsletter.php");
        $r->columnas=array(
                array("titulo"=>"T&iacute;tulo","campo"=>"titulo", "obligatorio"=>"1"),
                array("titulo"=>"Enviado","campo"=>"sent"),
                array("titulo"=>"Fecha","campo"=>"inserted2", "obligatorio"=>"1")
        );

        return $r->ver();
    }

    function formulario() {
        $m_Form = new MantixForm();
        $m_Form->atributos=array("texto_submit"=>"Newsletter");
        $m_Form->datos=$this->datos;
        $m_Form->controles=array(
                array("label"=>"T&iacute;tulo:","campo"=>"titulo", "obligatorio"=>"1"),
                array("label"=>"Descripci&oacute;n:","campo"=>"descripcion", "tipo"=>"fck1"),
        );
        return $m_Form->ver();
    }
    function pre_upd() {
        $this->datos->agregar("estado","1");
        if($_POST["opcenviar"]=="1") {
            $this->enviarmail();
        }
        if($_POST["opcenviar"]=="2") {
            $this->enviarmail2();
        }
    }
    function general_enviarmail($de,$para,$asunto,$mensaje) {
        $eol="\r\n";
        $now = mktime().".".md5(rand(1000,9999));
        $headers = "From:".$de.$eol."To:".$para.$eol;
        $headers .= 'Return-Path: '.$de.'<'.$de.'>'.$eol;
        $headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
        $headers .= "X-Mailer: PHP v".phpversion().$eol;
        $headers .= "Content-Type: text/html; charset=iso-8859-1".$eol;
        $resultado=mail($para, $asunto, $mensaje, $headers);
        return $resultado;
    }
    function enviarmail() {
        //desde aqui los correos
        $this->datos->agregar("sent","Enviado");
        $titulo=$_POST["titulo"];
        $descripcion=$_POST["descripcion"];
        //enviar correo
        $bd=new MantixOaD();
        $res=$bd->ejecutar("select email from can_news where estado=1");
        while($fila=mysql_fetch_row($res)) {
            $correo=$fila[0];
            $resultado=$this->general_enviarmail($this->de,$correo,"Cantartica - ".$titulo,$descripcion);
        }
    }
    function enviarmail2() {
        //desde aqui los correos
        $titulo=$_POST["titulo"];
        $descripcion=$_POST["descripcion"];
        $dests=$_POST["destinatarios"];
        //enviar correo
        foreach($dests as $d) {
            $correo=$d;
            $resultado=$this->general_enviarmail($this->de,$correo,"Cantartica - ".$titulo,$descripcion);
            $this->datos->agregar("sent","Enviado");
        }
    }
    function pre_ins() {
        $this->datos->agregar("updated",getdate());
        $this->datos->agregar("estado","1");
        if($_POST["opcenviar"]=="1") {
            $this->enviarmail();
        }
    }
}
?>