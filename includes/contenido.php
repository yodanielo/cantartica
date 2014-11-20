<?php
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.gc_maxlifetime', 172800);
session_cache_limiter('private,must-revalidate');
session_start();
header("Cache-control: private");

if(mosgetparam($_POST,"content","")=="")
    $path="./";
else
    $path="../";
include ($path.'config.php');
$protects = array('_REQUEST', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_ENV', 'GLOBALS', '_SESSION');
foreach ($protects as $protect) {
    if ( in_array($protect , array_keys($_REQUEST)) ||
            in_array($protect , array_keys($_GET)) ||
            in_array($protect , array_keys($_POST)) ||
            in_array($protect , array_keys($_COOKIE)) ||
            in_array($protect , array_keys($_FILES))) {
        die("Invalid Request.");
    }
}

/**
 * used to leave the input element without trim it
 */
define( "_MOS_NOTRIM", 0x0001 );
/**
 * used to leave the input element with all HTML tags
 */
define( "_MOS_ALLOWHTML", 0x0002 );
/**
 * used to leave the input element without convert it to numeric
 */
define( "_MOS_ALLOWRAW", 0x0004 );
/**
 * used to leave the input element without slashes
 */
define( "_MOS_NOMAGIC", 0x0008 );

function mosgetparam( &$arr, $name, $def=null, $mask=0 ) {
    if (isset( $arr[$name] )) {
        if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) $result[$key] = mosGetParam ($arr[$name], $key, $def, $mask);
        else {
            $result = $arr[$name];
            if (!($mask&_MOS_NOTRIM)) $result = trim($result);
            if (!is_numeric( $result)) {
                if (!($mask&_MOS_ALLOWHTML)) $result = strip_tags($result);
                if (!($mask&_MOS_ALLOWRAW)) {
                    if (is_numeric($def)) $result = intval($result);
                }
            }
            if (!get_magic_quotes_gpc()) {
                $result = addslashes( $result );
            }
        }
        return $result;
    } else {
        return $def;
    }
}
require_once ($path.'includes/database.php');
require_once ($path.'includes/helpers.php');

$db=new database($config_host,$config_user,$config_password,$config_db,$config_dbprefix);

/**
 * el que inicializa el ajax
 */
if($_POST["content"]) {
    $funcionesprimarias=array("set_archivo");
    if(in_array(mosgetparam($_POST,"content","noexiste"),$funcionesprimarias)) {
        $funcion=mosgetparam($_POST,"content","noexiste");
        if(function_exists($funcion)) {
            echo $funcion();
        }
    }
}
/**
 * funciones de contenido
 */
if($_GET["numero"]){
    $num=$_GET["numero"];
    $db->setQuery("select id from can_numeros where estado=1 and llave='$num'");
    $r=$db->loadResult();
    if($r!=null && $r!=""){
        $_SESSION["numero"]=$r;
    }
}
if(!$_SESSION["numero"]) {
    $db->setQuery("select id from can_numeros where estado=1 and activo=1");
    $_SESSION["numero"]=$db->loadResult();
}
function contenido() {
    /*inicio codigo custom*/
    global $db;
    /*fin codigo custom*/
    $_GET["opc"]=str_replace("-","_",mosgetparam($_GET,"opc","inicio"));
    $funciones=array("inicio","letras","agenda","radio_cantartica","artes_plasticas","musica","film_video","editorial","suscribirse","archivo","que_es_cantartica","contactanos","convocatoria","politica_de_privacidad");
    if(in_array(mosgetparam($_GET,"opc","inicio"),$funciones)) {
        if(function_exists(mosgetparam($_GET,"opc","inicio"))) {
            $funcion=mosgetparam($_GET,"opc","inicio");
            $funcion=str_replace("-", "_", $funcion);
            echo $funcion();
        }
        else {
            echo "El contenido no est&aacute; disponible";
        }
    }
    else {
        echo "El contenido que desea no existe";
    }
}
?>
<?php
function set_archivo() {
    $_SESSION["numero"]=$_POST["numero"];
    echo "ok";
}
function nroactivo() {
    global $db;
    $db->setQuery("select nombre from can_numeros where estado=1 and activo=1 and id=".$_SESSION["numero"]);
    echo $db->loadResult();
}
$planrecurso=array();
function inicio() {
    global $db;
    $sql="select a.*,b.nombre,b.texto_es,c.nombre as catnombre from can_portada as a inner join can_categorias as b on a.idarticulo=b.id inner join can_secciones as c on b.idseccion=c.id where a.estado=1 and a.idnumero=".$_SESSION["numero"]." and position='Posición 1'";
    $db->setQuery($sql);
    $pos1=$db->loadObjectList();
    //echo count($pos1);

    $sql="select a.*,b.nombre,b.texto_es,c.nombre as catnombre from can_portada as a inner join can_categorias as b on a.idarticulo=b.id inner join can_secciones as c on b.idseccion=c.id where a.estado=1 and a.idnumero=".$_SESSION["numero"]." and position='Posición 2'";
    $db->setQuery($sql);
    $pos2=$db->loadObjectList();
    //echo count($pos2);

    $sql="select a.*,b.nombre,b.texto_es,c.nombre as catnombre from can_portada as a inner join can_categorias as b on a.idarticulo=b.id inner join can_secciones as c on b.idseccion=c.id where a.estado=1 and a.idnumero=".$_SESSION["numero"]." and position='Posición 3'";
    $db->setQuery($sql);
    $pos3=$db->loadObjectList();
    //echo count($pos3);

    $sql="select a.*,b.nombre,b.texto_es,c.nombre as catnombre from can_portada as a inner join can_categorias as b on a.idarticulo=b.id inner join can_secciones as c on b.idseccion=c.id where a.estado=1 and a.idnumero=".$_SESSION["numero"]." and position='Posición 4'";
    $db->setQuery($sql);
    $pos4=$db->loadObjectList();
    //echo count($pos4);

    include("pags/inicio.php");
}
function archivo() {
    global $db;
    $sql="select * from can_numeros where inserted<=now() order by inserted";
    $db->setQuery($sql);
    $res=$db->loadObjectList();
    include("pags/archivo.php");
}
function letras() {
    hacer_plantilla("Letras");
}
function artes_plasticas() {
    hacer_plantilla("Artes Plásticas");
}
function musica() {
    hacer_plantilla("Música");
}
function film_video() {
    hacer_plantilla("Film / Vídeo");
}
function editorial() {
    global $db;
    $sql="select * from can_editorial where idnumero=".$_SESSION["numero"];
    $db->setQuery($sql);
    $res=$db->loadObjectList();
    $r=$res[0];
    if($r->recurso1!="")
        include("pags/editorial.php");
}
function suscribirse() {
    global $db;
    if($_POST["nombre"]) {
        $sql="insert into can_news values(null,now(),null,1,1,1,'".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["email"]."','".$_POST["edad"]."','".$_POST["localidad"]."','".$_POST["intereses"]."','".$_POST["profesion"]."','".$_POST["comentario"]."')";
        $db->setQuery($sql);
        $db->query();
        echo $db->getErrorMsg();
    }
    include("pags/suscribe.php");
}
function hacer_plantilla($quien) {
    global $db;
    if(!isset($_GET["cat"])) {
        //portada de seccion
        $sql="select * from can_secciones where idnumero=".$_SESSION["numero"]." and nombre='$quien' limit 1";
        $db->setQuery($sql);
        $contents=$db->loadObjectList();
        $content=$contents[0];
        $sql="select * from can_".$content->plantilla."_seccion where idtabla=".$content->id;
        $db->setQuery($sql);
        $plantillas=$db->loadObjectList();
        $sql="select can_categorias.* from can_categorias inner join can_secciones on can_categorias.idseccion=can_secciones.id where can_categorias.estado=1 and idnumero=".$_SESSION["numero"]." and idseccion=".$content->id." order by can_categorias.posicion";
        $db->setQuery($sql);
        $auts=$db->loadObjectList();
        $arb=array();
        $sql='';
            if(strlen($content->banners)>0){
                $arb=explode(",",$content->banners);
                $first=true;
                foreach($arb as $a){
                    if($first)
                        $sql.='select * from can_banners where estado=1 and id='.$a.' ';
                    else
                        $sql.=' union '.'select * from can_banners where estado=1 and id='.$a;
                    $first=false;
                }
            }
        //$sql="select * from can_banners where estado=1 and id in (".$content->banners.")";
        $db->setQuery($sql);
        $agras=$db->loadObjectList();
        if($content->plantilla!="")
            include("pags/plantillas/".$content->plantilla.".php");
    }
    else {
        $sql="select a.* from can_categorias as a inner join can_secciones as b on a.idseccion=b.id where a.estado=1 and a.id=".$_GET["cat"]." and idnumero=".$_SESSION["numero"];
        $db->setQuery($sql);
        $contents=$db->loadObjectList();
        if(count($contents)>0) {
            $content=$contents[0];
            $sql="select * from can_".$content->plantilla."_categorias where idtabla=".$content->id;
            $db->setQuery($sql);
            $db->loadAssocList();
            $plantillas=$db->loadObjectList();
            $sql="select can_categorias.* from can_categorias inner join can_secciones on can_categorias.idseccion=can_secciones.id where can_categorias.estado=1 and idnumero=".$_SESSION["numero"]." and idseccion=".$content->idseccion." order by can_categorias.posicion";
            $db->setQuery($sql);
            $auts=$db->loadObjectList();
            $sql='';
            if(strlen($content->banners)>0){
                $arb=explode(",",$content->banners);
                $first=true;
                foreach($arb as $a){
                    if($first)
                        $sql.='select * from can_banners where estado=1 and id='.$a.' ';
                    else
                        $sql.=' union '.'select * from can_banners where estado=1 and id='.$a;
                    $first=false;
                }
            }
            $db->setQuery($sql);
            $agras=$db->loadObjectList();
            if($content->plantilla!="")
                include("pags/plantillas/".$content->plantilla.".php");
        }else {
            echo 'El contenido no existe.';
        }
    }
}
function agenda() {
    global $db;
    if(!$_GET["mes"])
        $_GET["mes"]=date("n");
    if(!$_GET["anio"])
        $_GET["anio"]=date("Y");
    $mes=$_GET["mes"];
    $anio=$_GET["anio"];
    $sql="select ag.banners,ag.imgseccion from can_agenda_portada as ag where ag.estado=1 and idnumero=".$_SESSION["numero"];
    $db->setQuery($sql);
    $contents=$db->loadObjectList();
    $content=$contents[0];
    $sql="select * from can_banners where estado=1 and id in (".$content->banners.")";
    $db->setQuery($sql);
    $agras=$db->loadObjectList();
    if(!$_GET["id"]) {
        //listado
        $sql="SELECT *
                FROM  `can_agenda`
                WHERE MONTH( fecha_inicio ) =".$mes."
                AND YEAR( fecha_inicio ) =".$anio."
                AND fecha_fin IS NULL and estado=1
                UNION ALL
                SELECT *
                FROM  `can_agenda`
                WHERE MONTH( fecha_inicio ) <=".$mes."
                AND YEAR( fecha_inicio ) <=".$anio."
                AND MONTH( fecha_fin ) >=".$mes."
                AND YEAR( fecha_fin ) >=".$anio."
                AND fecha_fin IS NOT NULL and estado=1
                ORDER BY id DESC ";
        $db->setQuery($sql);
        $pag_actual=mosgetparam($_GET, "pag","1");
        $res=sacar_paginacion($db, $sql, 6, $pag_actual, $numpags);
        include("pags/agenda_listado.php");
    }
    else {
        $sql="select * from can_agenda where estado=1 and id=".intval($_GET["id"]);
        $db->setQuery($sql);
        $res=$db->loadObjectList();
        $r=$res[0];
        //detalle
        include("pags/agenda_detalle.php");
    }
}
function radio_cantartica() {
    global $db,$config_live_site;
    $db->setQuery("select * from can_radio where estado=1 and idnumero=".$_SESSION["numero"]);
    $res=$db->loadObjectList();
    $id=mosgetparam($_GET, "id", $res[0]->id);

    $db->setQuery("select banners from can_radio_portada where idnumero=".$_SESSION["numero"]);
    $ban=$db->loadResult();

    $db->setQuery("select radimagen as imgseccion, radimagen as catimagen from can_radio_portada where idnumero=".$_SESSION["numero"]);
    $cc=$db->loadObjectList();
    $content=$cc[0];

    $db->setQuery("select * from can_banners where id in (".$ban.")");
    $agras=$db->loadObjectList();
    include 'pags/radio.php';
}
function generarxml($id) {
    if($id=="") {
        exit;
    }
    global $db,$config_live_site;
    $salida=array();
    $db->setQuery("select * from can_radio where estado=1 and id=".intval($id));
    $res=$db->loadObjectList();
    $r=$res[0];
    $salida["canal"]=$r;
    $db->setQuery("select * from can_tracks where estado=1 and idradio=".intval($id));
    $tracks=$db->loadObjectList();
    $salida["tracks"]=$tracks;
    return $salida;
}
function que_es_cantartica(){
    global $db;
    $sql="select * from can_menu_footer where titulo like '¿Qué es cantartica?'";
    $db->setQuery($sql);
    $res=$db->loadObjectList();
    $r=$res[0];
    include("pags/que_es_cantartica.php");
}
function contactanos(){
    global $db;
    $sql="select descripcion from can_menu_footer where titulo like 'Contáctanos'";
    $db->setQuery($sql);
    $res=$db->loadResult();
    include("pags/contactanos.php");
}
function convocatoria(){
    global $db;
    $sql="select * from can_menu_footer where titulo like 'Convocatoria'";
    $db->setQuery($sql);
    $res=$db->loadObjectList();
    $r=$res[0];
    include("pags/convocatoria.php");
}
function politica_de_privacidad(){
    global $db;
    $sql="select descripcion from can_menu_footer where titulo like 'Política de Privacidad'";
    $db->setQuery($sql);
    $res=$db->loadResult();
    include("pags/politicas.php");
}
function get_sponsors(){
    global $db;
    $sql="select descripcion from can_sponsors";
    $db->setQuery($sql);
    $res=$db->loadResult();
    return $res;
}
?>