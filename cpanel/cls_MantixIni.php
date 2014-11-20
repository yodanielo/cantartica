<?php
include("cls_MantixMenu.php");
$menu =new MantixMenu();
$menu->opciones = array(
        array("titulo"=>"Administradores" ,"url"=>"usuarios.php","id"=>"usuarios"),
        array("titulo"=>"Números" ,"url"=>"numeros.php","id"=>"usuarios"),
        array("titulo"=>"Portada" ,"url"=>"portada.php","id"=>"usuarios"),
        array("titulo"=>"Banners" ,"url"=>"banners.php","id"=>"usuarios"),
        array("titulo"=>"Letras" ,"url"=>"seccion_letras.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Plantilla de Sección" ,"url"=>"seccion_letras.php","id"=>"usuarios"),
                        array("titulo"=>"Artículo" ,"url"=>"categorias_letras.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Artes Plásticas" ,"url"=>"seccion_artes.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Plantilla de Sección" ,"url"=>"seccion_artes.php","id"=>"usuarios"),
                        array("titulo"=>"Artículo" ,"url"=>"categorias_artes.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Música" ,"url"=>"seccion_musica.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Plantilla de Sección" ,"url"=>"seccion_musica.php","id"=>"usuarios"),
                        array("titulo"=>"Artículo" ,"url"=>"categorias_musica.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Film / Vídeo" ,"url"=>"seccion_film.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Editorial de Sección" ,"url"=>"seccion_film.php","id"=>"usuarios"),
                        array("titulo"=>"Artículo" ,"url"=>"categorias_film.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Editorial","url"=>"editorial.php","id"=>"editorial"),
        array("titulo"=>"Agenda" ,"url"=>"agenda_portada.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Portada de Agenda" ,"url"=>"agenda_portada.php","id"=>"usuarios"),
                        array("titulo"=>"Agenda" ,"url"=>"agenda.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Radio" ,"url"=>"radio_portada.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Portada de Radio" ,"url"=>"radio_portada.php","id"=>"usuarios"),
                        array("titulo"=>"Radio" ,"url"=>"radio.php","id"=>"usuarios"),
                        array("titulo"=>"Tracks" ,"url"=>"tracks.php","id"=>"usuarios"),
                )
        ),
        array("titulo"=>"Newsletter" ,"url"=>"newsletter.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Newsletter" ,"url"=>"newsletter.php","id"=>"usuarios"),
                        array("titulo"=>"Suscriptores" ,"url"=>"news.php","id"=>"usuarios"),
                )),
        array("titulo"=>"Menú Footer" ,"url"=>"menu_footer.php","id"=>"usuarios","sub"=>array(
                        array("titulo"=>"Menú" ,"url"=>"menu_footer.php","id"=>"usuarios"),
                        array("titulo"=>"Sponsors" ,"url"=>"sponsors.php","id"=>"usuarios"),
                )),

);
$img_top="bg-top.jpg";
$usuario="";
?>