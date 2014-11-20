<?php
include("includes/contenido.php")
        ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=<?=$config_charset?>" />
        <title><?php echo $config_sitename ?></title>
        <meta name="Description" content="<?php echo $config_MetaDesc ?>" />
        <meta name="Keywords" content="<?php echo $config_MetaKeys ?>" />
        <meta name="author" content="<?php echo $config_author ?>" />
        <meta name="owner" content="Cant&aacute;rtica" />
        <meta name="robots" content="index, follow" />
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.1.css" />
        <link rel="stylesheet" type="text/css" href="css/flexcroll.css" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" />
        <!--[if IE ]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
        <![endif]-->
        <!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox-1.3.1.pack.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.min.js"></script>
        <script type="text/javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" src="js/flexcroll.js"></script>
        <script type="text/javascript" src="js/generales.js"></script>
    </head>
    <body>
        <div id="page">
            <!--inicio top-->
            <div id="bannertop">
                <a id="logo" href="<?=$config_live_site?>" title="<?=$config_sitename?>">
                    <?php nroactivo()?>
                </a>
                <div id="menuscol2">
                    <a href="#" id="siguenosen"><span class="subpuntado">S&Iacute;GUENOS EN</span> +</a><br/>
                    <br/>
                    <span id="mnivel1">
                        <a href="<?=$config_live_site?>?opc=editorial" <?php if($_GET["opc"]=="editorial") echo 'class="activo"'?> title="editorial">editorial</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=agenda" <?php if($_GET["opc"]=="agenda") echo 'class="activo"'?> title="agenda">agenda</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=suscribirse" <?php if($_GET["opc"]=="suscribirse") echo 'class="activo"'?> title="suscribirse">suscribirse</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=archivo" <?php if($_GET["opc"]=="archivo") echo 'class="activo"'?> title="archivo">archivo</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=radio-cantartica" <?php if($_GET["opc"]=="radio-cantartica") echo 'class="activo"'?> title="radio cant&aacute;rtica">radio cant&aacute;rtica</a>
                    </span><br/>
                    <br/>
                    <span id="mnivel2">
                        <a id="link_letras<?=($_GET["opc"]=="letras"?"_selected":"")?>" href="<?=$config_live_site?>?opc=letras" title="">letras</a>&nbsp;&nbsp;
                        <a id="link_artes_plasticas<?=($_GET["opc"]=="artes-plasticas"?"_selected":"")?>" href="<?=$config_live_site?>?opc=artes-plasticas" title="">artes pl&aacute;sticas</a>&nbsp;&nbsp;
                        <a id="link_musica<?=($_GET["opc"]=="musica"?"_selected":"")?>" href="<?=$config_live_site?>?opc=musica" title="">m&uacute;sica</a>&nbsp;&nbsp;
                        <a id="link_film_video<?=($_GET["opc"]=="film-video"?"_selected":"")?>" href="<?=$config_live_site?>?opc=film-video" title="">film/v&iacute;deo</a>
                    </span>
                </div>
            </div>
            <!--fin top-->
            <div id="contenido">
                <?php contenido() ?>
            </div>
            <div id="footer">
                <div id="foo1">
                    <div class="fooizq">
                        <a <?php if($_GET["opc"]=="que_es_cantartica") echo ' class="selected" '?> href="<?=$config_live_site?>?opc=que-es-cantartica" title="">&iquest;Qu&eacute; es cant&aacute;rtica?</a>
                        <a <?php if($_GET["opc"]=="contactanos") echo ' class="selected" '?> href="<?=$config_live_site?>?opc=contactanos" title="">Cont&aacute;ctanos</a>
                        <a <?php if($_GET["opc"]=="convocatoria") echo ' class="selected" '?> href="<?=$config_live_site?>?opc=convocatoria" title="">Convocatoria</a>
                    </div>
                    <div class="fooder">
                        <a class="a<?php if($_GET["opc"]=="politica_de_privacidad") echo ' selected'?>" href="<?=$config_live_site?>?opc=politica-de-privacidad" title="">Pol&iacute;tica de Privacidad</a>
                        <a>&copy;<?=date("Y")?> Cant&aacute;rtica</a>
                    </div>
                </div>
                <div id="foo3">
                    &Eacute;ste n&uacute;mero es posible gracias al apoyo de:
                </div>
                <div id="foo4">
                    <?=get_sponsors()?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).resize(function(){
                $("#page").css({
                    "margin-left":($(document).width()-$("#page").width())/2,
                    "left":0
                });
            })
            $("#page").css({
                "margin-left":($(document).width()-$("#page").width())/2,
                "left":0
            });
        </script>
    </body>
</html>
