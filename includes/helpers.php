<?php
function cie($str) {
    if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) {
        return utf8_decode($str);
    }else {
        return $str;
    }
}
function separar_nombres($str,$espacios) {
    $min=explode(" ",$str);
    if(count($min)>1){
        $cad='';
        foreach($min as $m) {
            if(strlen($m)>$espacios)
                $cad.=' '.separar_nombres($m, $espacios);
            else
                $cad.=' '.$m;
        }
        return $cad;
    }else{
        if(count($min)==1){
            $min=str_split($str, $espacios);
            $str=implode($min, "-<br/>");
            return $str;
        }
        else{
            return "";
        }
    }
//    if(strlen($str)>0){
//        $r=explode(" ",$str);
//        return $r[0]." ".$r[1];
//    }else
//        return "";
}
function esp_char($cadena) {
    $traducciones=array(
            "Á"=>"Aacute;",
            "É"=>"Eacute;",
            "Í"=>"Iacute;",
            "Ó"=>"Oacute;",
            "Ú"=>"Uacute;",
            "á"=>"aacute;",
            "é"=>"eacute;",
            "í"=>"iacute;",
            "ó"=>"oacute;",
            "ú"=>"uacute;",
            "Ñ"=>"&Ntilde;",
            "ñ"=>"&ntilde;",
            "¡"=>"&iexcl;",
            "¿"=>"&iquest;",
    );
    strtr($cadena,$traducciones);
}
function contar_palabras($str,$conetiquetas=0) {
    if(conetiquetas==1)
        $str=strip_tags($str);
    $reemplazar=array(",",".","-","+","(",")","{","}","_",";",":","  ");
    foreach ($reemplazar as $rr) {
        $str=str_replace($rr,"",$str);
    }
    return sizeof(explode(" ", $str));
}

function limitar_palabras($str, $limit = 100, $end_char = '&#8230;') {

    if (trim($str) == '') {
        return $str;
    }

    preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

    if (strlen($str) == strlen($matches[0])) {
        $end_char = '';
    }

    return rtrim($matches[0]).$end_char;
}

function limitar_letras($str, $n = 500, $end_char = '&#8230;') {
    if (strlen($str) < $n) {
        return $str;
    }

    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

    if (strlen($str) <= $n) {
        return $str;
    }

    $out = "";
    foreach (explode(' ', trim($str)) as $val) {
        $out .= $val.' ';

        if (strlen($out) >= $n) {
            $out = trim($out);
            return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
        }
    }
}
/**
 * hace la paginacion de una consulta
 * @param Database $db la conexion a ala base de datos
 * @param <type> $sql la sentenia sql a la cual paginar
 * @param <type> $numresults numero de resultados por pagina
 * @param <type> $pag_atual ingresa y devuelve la pagina de la cual retornar los resultados
 * @param <type> $numpags devuelve el numero de paginas en la paginacion
 * @return <type> retorna la paginacion
 */
function sacar_paginacion(Database $db,$sql,$numresults,&$pag_actual,&$numpags) {
    //saco el numero de resultados total
    $db->setQuery($sql);
    $numpags=ceil(count($db->loadObjectList())/$numresults);
    if($pag_actual>=$numpags)
        $pag_actual=$numpags;
    $lmin=($pag_actual-1)*$numresults;
    $lmax=$numresults;
    //saco los resultados de la paginacion
    $db->setQuery($sql." limit ".$lmin.",".$lmax);
    return $db->loadObjectList();
}
function fechatexto($fecha,$delimiter="-") {
    $meses=array(
            "",
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
    );
    $ff=explode($delimiter, $fecha);
    $dia=$ff[2];
    $mes=$ff[1];
    $anio=$ff[0];
    $cad=str_pad($dia, 2, STR_PAD_LEFT)." de ".$meses." de ".$anio;
    return $cad;
}
function aurl($l) {
    return strtolower(str_replace(array("/"," ","--","á","é","í","ó","ú"),array("","-","-","a","e","i","o","u"),$l));
}
?>
