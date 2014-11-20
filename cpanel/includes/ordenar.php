<?php
class grid_ordenar {
    private $ord;
    private $ord_ant;
    private $datos;
    private $tabla;
    private $campo;
    //el campo predeterminado para ordenar es "orden"
    function __construct($db,$tabla,$campo="posicion") {
        $this->datos=$db;
        $this->tabla=$tabla;
        $this->campo=$campo;
        $this->ord=$_POST["ord"];
        $this->ord_ant=$_POST["ord_ant"];
    }
    function ordenar_todos() {
        foreach($this->ord as $key=>$o) {
            if($this->ord[$key]!=$this->ord_ant[$key]) {
                $this->ordenar_uno($key);
            }
        }
                //die(" ");

    }
    private function rellenar_orden() {
        $res=$this->datos->ejecutar("select * from mtf_jugadores");
        $i=1;
        while($r=mysql_fetch_object($res)) {
            $sql="update mtf_jugadores set orden=".$i." where id=".$r->id;
            $this->datos->ejecutar($sql);
            $i++;
        }
    }
    private function ordenar_uno($key) {
        $asf=array(
            "categorias_letras.php"=>"Letras",
            "categorias_artes.php"=>"Artes Plásticas",
            "categorias_musica.php"=>"Música",
            "categorias_film.php"=>"Film / Vídeo"
        );
        $orden=$this->ord[$key];
        if((int)$orden<=0) {
            $orden=1;
        }
        $d2=$this->datos;
        $campo=$this->campo;
        //obtener el id
        $sql="select a.id from ".$this->tabla." as a inner join can_secciones as b on a.idseccion=b.id and b.nombre='".$asf[basename($_SERVER["PHP_SELF"])]."' and idnumero='".$_SESSION["num_activo"]."' where a.".$campo."=".$this->ord_ant[$key];
        $id=$d2->get_simple($sql);
        //obtego un array de todos los registros qu evoy a modificar
        $sql="select a.id from can_categorias as a inner join can_secciones b on a.idseccion=b.id and b.nombre='".$asf[basename($_SERVER["PHP_SELF"])]."' and b.idnumero=".$_SESSION["num_activo"];
        $res1=$d2->ejecutar($sql);
        $xyz=array();
        while($cata=mysql_fetch_object($res1)){
            array_push($xyz, $cata->id);
        }
        $permitidos=implode(",",$xyz);
        //eliminar el que tengo
        if((int)$this->ord_ant[$key]>=1) {
            $sql="update ".$this->tabla." set ".$campo."=".$campo."-1 where ".$campo.">=".$this->ord_ant[$key]." and id in (".$permitidos.")";//." and estado=1";
            //echo $sql."<br/>";
            $d2->ejecutar($sql);
        }
        $sql="select max(".$campo.")+1 as conteo from ".$this->tabla." where ".$campo."<".$orden." and id in (".$permitidos.")";//." and estado=1";
        //echo $sql."<br/>";
        $r=$d2->get_simple($sql);
        //die("E");
        $orden=$r;
        if((int)$orden<=0) {
            $orden=1;
        }
        $d2->ejecutar("update ".$this->tabla." set ".$campo."=".$campo."+1 where ".$campo.">=".$orden." and id in (".$permitidos.")");//." and estado=1");
        //echo "update ".$this->tabla." set ".$campo."=".$campo."+1 where ".$campo.">=".$orden." and id in (".$permitidos.")"."<br/>";
        $d2->ejecutar("update ".$this->tabla." set ".$campo."=".$orden." where id=".$id);
        //echo "update ".$this->tabla." set ".$campo."=".$orden." where id=".$id."<br/>";
    }
    public function insertar_orden() {
        //obtengo el maximo mas 1
        $sql="select max(orden)+1 from ".$this->tabla;
        $r=$this->datos->get_simple($sql);
        $sql="select id from ".$this->tabla." order by id desc limit 1";
        $id=$this->datos->get_simple($sql);
        $sql="update ".$this->tabla." set ".$this->campo."=".$r." where id=".$id;
        $this->datos->ejecutar($sql);
    }
    public function eliminar_orden($id) {
        $sql="update ".$this->tabla." set ".$this->campo."=".$this->campo."-1 where id>".$id;
        $this->datos->ejecutar($sql);
    }
}
?>