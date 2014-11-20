<?php
include("includes/contenido.php")
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html charset=utf-12" />
        <title><?php echo $config_sitename ?></title>
        <meta name="Description" content="<?php echo $config_MetaDesc ?>" />
        <meta name="Keywords" content="<?php echo $config_MetaKeys ?>" />
        <meta name="author" content="<?php echo $config_author ?>" />
        <meta name="owner" content="Cantártica" />
        <meta name="robots" content="index, follow" />
        <meta HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT"/>
        <meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
        <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache"/>
        <link rel="stylesheet" type="text/css" href="css/nav.css" />
        <!--[if IE ]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
        <![endif]-->
        <!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
        <![endif]-->
        <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.pngFix.pack.js"></script>
        <script type="text/javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" src="js/generales.js"></script>
    </head>
    <body>
        <div id="page">
            <!--inicio top-->
            <div id="bannertop">
                <a id="logo" href="<?=$config_live_site?>" title="<?=$config_sitename?>"></a>
                <div id="menuscol2">
                    <a href="#" id="siguenosen"><span class="subpuntado">SÍGUENOS</span> EN +</a><br/>
                    <br/>
                    <span id="mnivel1">
                        <a href="<?=$config_live_site?>?opc=editorial" title="editorial">editorial</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=agenda" title="agenda">agenda</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=suscribirse" title="suscribirse">suscribirse</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=archivo" title="archivo">archivo</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=radio-cantartica" title="radio cantártica">radio cantártica</a>
                    </span><br/>
                    <br/>
                    <span id="mnivel2">
                        <a href="<?=$config_live_site?>?opc=letras" title="">letras</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=artes-plasticas" title="">artes plásticas</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=musica" title="">música</a>&nbsp;&nbsp;
                        <a href="<?=$config_live_site?>?opc=film-video" title="">film/vídeo</a>
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
                        <a href="<?=$config_live_site?>?opc=que-es-cantartica" title="">¿Qué es cantártica?</a>
                        <a href="<?=$config_live_site?>?opc=contactanos" title="">Contáctanos</a>
                        <a href="<?=$config_live_site?>?opc=convocatoria" title="">Convocatoria</a>
                    </div>
                    <div class="fooder">
                        <a href="<?=$config_live_site?>?opc=politica-de-privacidad" title="">Política de privacidad</a>
                        <a>@<?=date("Y")?></a>
                    </div>
                </div>
                <div id="foo3">
                    Éste número es posible gracias al apoyo de:
                </div>
                <div id="foo4">
                    <a class="#"><img src="images/sponsor1.jpg"/></a>
                    <a class="#"><img src="images/sponsor2.jpg"/></a>
                    <a class="#"><img src="images/sponsor3.jpg"/></a>
                    <a class="#"><img src="images/sponsor4.jpg"/></a>
                    <a class="#"><img src="images/sponsor5.jpg"/></a>
                    <a class="#"><img src="images/sponsor6.jpg"/></a>
                    <a class="#"><img src="images/sponsor7.jpg"/></a>
                    <a class="#"><img src="images/sponsor8.jpg"/></a>
                </div>
            </div>
        </div>
    </body>
</html>
