<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <META content="MSHTML 6.00.2900.2180" name=GENERATOR/>
        <link rel="stylesheet" type="text/css" href="css/cpanel.css"/>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" type="text/css" />
        <!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" type="text/css" />-->
        <link rel="stylesheet" type="text/css" href="css/cpanel_complementos.css" />
        <!--[if lte IE 7]>
        <style type="text/css">
            .uploadifyQueueItem {
                margin-left:-96px;
            }
        </style>
        <![endif]-->
        <script src="scripts/validaciones.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js" type="text/javascript"></script>
        <script src="scripts/cpanel_scripts.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //alertas y errores
                $("#linkalerta").fancybox({
                    overlayOpacity:0.90,
                    overlayColor:"#000",
                    showCloseButton:false,
                    modal:true,
                    centerOnScroll:true,
                    padding:7,
                    onStart:function(){
                        $("#fancybox-overlay").height=$(document).height();
                    }
                });
                //autosize
                //$("textarea").resizable();
                //irpagina
                $("#irpag").keypress(function(e){
                    if(e.keyCode==13){
                        grid_pagina_ajax(this.value);
                        return false;
                    }
                });
                //scrollers
                $.localScroll();
                //combobox
                $("select").msDropDown();
                //actualizar
                $(".icono_actualizar").click(function(){
                    url='<?=$_SERVER["PHP_SELF"]?>';
                    window.location.href=url+"?scrollto="+$(this).position().top;
                    return false;
                })
                //ocultar / mostrar columnas
                $(".listacolumnas input").change(function(){
                    col=$(this).attr("rel");
                    if(this.checked){
                        $("#grilladatos .col"+col).show();
                    }else{
                        $("#grilladatos .col"+col).hide();
                    }
                });
                $(".icono_columnas").hover(function(){
                    $(".listacolumnas").fadeIn(450, function(){});
                }, function(){
                    $(".listacolumnas").fadeOut(450, function(){});
                });
                //buscador
                buscar_activo=false;
                $(".icono_buscar").click(function(){
                    buscar_activo=!buscar_activo;
                    if(buscar_activo){
                        $(".field_buscador .form_fila").fadeIn(450,function(){})
                        $(".field_buscador").slideDown(450, function(){});
                    }else{
                        $(".field_buscador .form_fila").fadeOut(450,function(){})
                        $(".field_buscador").slideUp(450, function(){});
                    }
                })
                //maximizar / minizar
                maximizar_activo=true;
                $(".icono_maxmin").click(function(){
                    maximizar_activo=!maximizar_activo;
                    if(maximizar_activo){
                        $("#grilladatos").slideDown(450, function(){});
                        $(".grillabar:last").fadeIn(450, function(){});
                    }
                    else{
                        $("#grilladatos").slideUp(450, function(){})
                        $(".grillabar:last").fadeOut(450, function(){});
                    }
                });
                $(".field_buscador").slideUp(450, function(){});
                $(".field_buscador .form_fila").fadeOut(450,function(){})
                //ordenar registros
                ordenactivo=false;
                $(".icono_ordenar").click(function(){
                    $(".icono_ordenar img").attr("src","images/icono-orden-guardar.png");
                    ordenactivo=!ordenactivo;
                    if(ordenactivo){
                        $(".itemordenar").each(function(){
                            num=parseInt($(this).html());
                            cad='<input type="text" class="inputordenar" value="'+num.toString()+'" name="ord[]" />';
                            cad+='<input type="hidden" class="hiddenordenar" value="'+num.toString()+'" name="ord_ant[]" />';
                            $(this).html(cad);
                        }).css("background", "#E3E6E1");
                        $(".inputordenar").focus(function(){
                            $(this).val("");
                        })
                        $(".inputordenar").blur(function(){
                            if($(this).val()==""){
                                $(this).val($(this).parent().find(".hiddenordenar:first").val());
                            }
                        })
                    }
                    else{
                        $("#form_grid #accion").val(11);
                        $("#form_grid #idobj").val("");
                        $("#form_grid").attr("action",window.location.href);
                        $("#form_grid").submit();
                    }
                    return false;
                })
                //tooltip para plantillas
                $(".optionplantilla label:eq(0)").attr("title", '<img src="images/layout1.gif"/>')
                $(".optionplantilla label:eq(1)").attr("title", '<img src="images/layout2.gif"/>')
                $(".optionplantilla label:eq(2)").attr("title", '<img src="images/layout3.gif"/>')
                $(".optionplantilla label:eq(3)").attr("title", '<img src="images/layout4.gif"/>')
                $(".optionplantilla label").tooltip({
                    effect: 'slide',
                    tipClass:'tooltip2',
                    position:'bottom center'
                });
            })
            //ajax columnas
            function grid_pagina_ajax(obj) {
                //var f=document.form_grid;
                nro=$(obj).attr("rel");
                $.ajax({
                    url:"ajaxgrid.php",
                    data:"pag="+nro+"&tipo=ajax&pagina=<?=basename($_SERVER["PHP_SELF"])?>",
                    type:"POST",
                    success:function(data){
                        $("#gridajax").html(data);
                    }
                });
                /*f.action ='jugadores.php#grid';
            f.pag.value=nro;
            f.accion.value='';
            f.submit();*/
                return false;
            }
            function grid_desactivar_ajax(id){
                $.ajax({
                    url:"ajaxgrid.php",
                    data:"tipo=ajax&pagina=<?=basename($_SERVER["PHP_SELF"])?>&pag="+$("#irpag").val()+"&desactivar=1&idobj="+id,
                    type:"POST",
                    success:function(data){
                        $("#gridajax").html(data);
                    }
                });
            }
            function grid_activar_ajax(id){
                $.ajax({
                    url:"ajaxgrid.php",
                    type:"POST",
                    data:"tipo=ajax&pagina=<?=basename($_SERVER["PHP_SELF"])?>&pag="+$("#irpag").val()+"&activar=1&idobj="+id,
                    success:function(data){
                        $("#gridajax").html(data);
                    }
                });
            }
            function grid_eliminar_ajax(id){
                $.ajax({
                    url:"ajaxgrid.php",
                    type:"POST",
                    data:"tipo=ajax&pagina=<?=basename($_SERVER["PHP_SELF"])?>&pag="+$("#irpag").val()+"&eliminar=1&idobj="+id,
                    success:function(data){
                        $("#gridajax").html(data);
                    }
                });
            }
            configdatetime={
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                showOn: 'both',
                buttonImage: 'images/b-calendario.jpg',
                buttonImageOnly: true,
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre']
            };
            function quitarerror(id){
                $(id).change(function(){
                    if($(this).val().length>0){
                        $(this).removeClass("form_fila_err");
                    }
                })
            }
            function hacerupload(id,extensiones,descripcion){
                if(extensiones==null){
                    extensiones="*.*";
                    descripcion="Todos los archivos";
                }
                $("#udf_"+id).uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_'+id+'.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'buttonImg'   :    'images/subir-archivo.gif',
                    'auto'        :    true,
                    'fileExt'     :    extensiones,
                    'fileDesc'    :    descripcion,
                    'height'      :    21,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        $("#"+id).val(d);
                    }
                });
                $("#udfborrar_"+id).click(function(){
                    $("#"+id).val("");
                    return false;
                })
                $("#udfsubir_"+id+"").tooltip({effect: 'slide'});
            }
            function archivogg_multi(){

                function agregar_archivogg_multi(d){
                    if(d.toString().substr(d.length-3, 3)=="jpg")
                        ext="ico-imagen.png";
                    else
                        ext="ico-video.png";
                    cad='<div class="pl23_item"><input type="hidden" name="recurso1[]" value="'+d+'" /><input type="hidden" class="agg_htitle" name="agg_title[]" value="" /><a></a><img src="images/'+ext+'"/>'+d+'</div>';
                    $(".agg_contenedor").append(cad);
                    $(".pl23_item a").click(function(){
                        $(this).parent().remove();
                    });
                    $(".agg_contenedor").sortable();
                    $(".pl23_item").click(pl123_click);
                    $(".pl23_item").hover(pl123_show, pl123_hide);
                }
                //tooltip p123
                esfirme=false;
                elfirme=null;
                textodef="Ingresa el texto descriptivo.";
                function pl123_click(){
                    $("#agg_titletag").show();
                    esfirme=true;
                    elfirme=this;
                    $("#agg_titlebutton").click(function(){
                        $(elfirme).find(".agg_htitle").val($("#agg_titleinput").val());
                        esfirme=false;
                        $("#agg_titletag").hide();
                    });

                    $("#agg_titlebutton").show();
                    if($("#agg_titleinput").val()==textodef)
                        $("#agg_titleinput").val("");
                    $("#agg_titleinput").focus();
                }
                $("#agg_titletag").blur(function(){
                    alert("p");
                    esfirme=false;
                    $(this).hide();
                });
                function pl123_show(){
                    if(!esfirme){
                        if($(this).find(".agg_htitle").length==0){
                            $(this).append('<input type="hidden" class="agg_htitle" name="title[]" value="" />');
                        }
                        $("#agg_titletag").show();
                        if($(this).find(".agg_htitle").val()=="")
                            $("#agg_titletag #agg_titleinput").val(textodef);
                        else
                            $("#agg_titletag #agg_titleinput").val($(this).find(".agg_htitle").val());

                        $("#agg_titlebutton").hide();
                    }
                }
                function pl123_hide(){
                    if(!esfirme){
                        $("#agg_titletag").hide();
                        $("#agg_titletag #agg_titleinput").val("");
                    }
                }

                $(".pl23_item").click(pl123_click);
                $(".pl23_item").hover(pl123_show, pl123_hide);
                $("#udf_recurso_agg").uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_recurso1.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'buttonImg'   :    'images/subir-archivo.gif',
                    'auto'        :    true,
                    'fileExt'     :    ($(".agg_contenedor").hasClass("solovideos")?"*.flv":"*.jpg; *.flv"),
                    'fileDesc'    :    ($(".agg_contenedor").hasClass("solovideos")?"Vídeos (*.flv)":"Imágenes (*.jpg), Vídeos (*.flv)"),
                    'width'       :    107,
                    'height'      :    21,
                    'multi'       :    true,
                    'simUploadLimit':  2,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        agregar_archivogg_multi(d);
                    }
                });
                $(".agg_contenedor").sortable();
                $(".pl23_item a").click(function(){
                    $(this).parent().remove();
                });
            }
            function hacerupload_multiple(id,extensiones,descripcion){
                if(extensiones==null){
                    extensiones="*.*";
                    descripcion="Todos los archivos";
                }
                function multiarch(){
                    cad='';
                    $("#banct_"+id+" ul li").each(function(){
                        cad+=","+$(this).html();
                    })
                    $("#"+id).val(cad.substr(1));
                }
                $("#udf_"+id).uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_'+id+'.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'buttonImg'   :    'images/subir-archivo.gif',
                    'auto'        :    true,
                    'fileExt'     :    extensiones,
                    'fileDesc'    :    descripcion,
                    'height'      :    21,
                    'multi'    :    true,
                    'simUploadLimit':  2,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        $("#banct_"+id+" ul").append("<li>"+d+"</li>");
                        $("#banct_"+id+" ul").sortable({update:function(a,b){
                                multiarch();
                            }});
                        multiarch();
                    }
                });
                $("#udfborrarm_"+id).click(function(){
                    $("#banct_"+id+" ul").html("");
                    $("#"+id).val("");
                    return false;
                })
                $("#udfsubir_"+id+"").tooltip({effect: 'slide'});
            }
            function hacerupload_pl1(id,extensiones,descripcion,cdt){
                vista_selected="lista";
                function do_noestan(){
                    $("#noestan").empty();
                    if(vista_selected=="lista"){
                        $("#listado_imagenes div").each(function(){
                            $("#noestan").append('<input type="hidden" name="noestan[]" value="'+$(this).text()+'"/>');
                            //.html().split("<a></a>").join("")
                        })
                    }else{
                        $("#listado_imagenes img").each(function(){
                            $("#noestan").append('<input type="hidden" name="noestan[]" value="'+$(this).attr("src").split("../images/recursos/").join("").split("\n").join("").split("tumber.php?w=64&h=64&src=").join("")+'"/>');
                        });
                    }
                    $('#noestan input[value=""]').remove();
                }
                function agregar_vlista(d){
                    d=d.split("tumber.php?w=64&h=64&src=").join("");
                    //primro hag el proceso y luego cambio la bandera
                    $("#listado_imagenes").append('<div class="padrag"><a></a>'+d+'</div>');
                    $("#listado_imagenes div a").click(function(){
                        $(this).parent().remove();
                        do_noestan();
                    })
                    multiarch_pl1();
                    do_noestan()
                }
                function agregar_vgal(d){
                    $("#listado_imagenes").append('<div class="padrag padraggal"><img src="tumber.php?w=64&h=64&src=../images/recursos/'+d+'"/></div>');
                    multiarch_pl1();
                    do_noestan();
                }
                function toggle_vlista(){
                    $("#listado_imagenes img").each(function(){
                        d=$(this).attr("src");
                        agregar_vlista(d.split("../images/recursos/").join("").split("tumber.php?w=30&h=30&src=").join(""));
                        $(this).parent().remove();
                    })
                    vista_selected="lista";
                    do_noestan();
                }
                function toggle_vgal(){
                    $("#listado_imagenes div a").each(function(){
                        a=this;
                        b=$(this).parent();
                        $(a).remove();
                        agregar_vgal($(b).html());
                        $(b).remove();
                    })
                    vista_selected="gal";
                    do_noestan();
                }
                $("#pl_vlista").click(toggle_vlista);
                $("#pl_vgal").click(toggle_vgal);
                function multiarch_pl1(){
                    //$("#matriz div").draggable("destroy");
                    $(".pl1_selected").draggable({
                        cursorAt:{
                            left:0,
                            top:0
                        },
                        //cursor:"move",
                        revert:true,
                        refreshPositions: true
                    });
                    $("#listado_imagenes div").draggable({
                        revert: 'valid',
                        cursorAt:{
                            left:0,
                            top:0
                        },
                        helper:function(event){
                            return $('<div class="cazul" style="position:relative;z-index:99999"></div>')
                        }

                    });
                    //$("#matriz div").droppable("destroy");
                    $("#matriz div:not(.pl1_selected)").droppable({
                        tolerance: 'pointer',
                        drop: function(event, ui) {
                            if(!$(ui.draggable).hasClass("cuadromatriz")){
                                if(!$(this).hasClass("pl1_selected")){
                                    $(this).addClass("pl1_selected");
                                    if(vista_selected=="lista"){
                                        $(this).append('<input type="hidden" value="'+ui.draggable.text()+'" class="pl1_img" name="pl1_img[]" />');
                                        $(this).append('<input type="hidden" value="'+$(this).attr("id")+'" name="pl1_cdr[]" />');
                                        paponer="../images/recursos/"+ui.draggable.text();
                                        todo=this;
                                        $("#precargas").append('<img src="'+paponer+'"/>');
                                        $(todo).css("background","url(images/loading.gif) no-repeat center");
                                        $("#precargas img").ready(function(){
                                            $(todo).css("background","url(tumber.php?w=30&h=30&src="+paponer+")");
                                        });
                                    }else{
                                        $(this).append('<input type="hidden" value="'+$(ui.draggable).find("img").attr("src").split("../images/recursos/").join("").split("tumber.php?w=64&h=64&src=").join("")+'" class="pl1_img" name="pl1_img[]" />');
                                        $(this).append('<input type="hidden" value="'+$(this).attr("id")+'" name="pl1_cdr[]" />');
                                        paponer="../images/recursos/"+$(ui.draggable).find("img").attr("src").split("../images/recursos/").join("").split("tumber.php?w=64&h=64&src=").join("");
                                        todo=this;
                                        $("#precargas").append('<img src="'+paponer+'"/>');
                                        $(todo).css("background","url(images/loading.gif) no-repeat center");
                                        $("#precargas img").ready(function(){
                                            $(todo).css("background","url(tumber.php?w=30&h=30&src="+paponer+")");
                                        });
                                        //$(this).css("background","url(tumber.php?w=30&h=30&src="++")");
                                    }
                                    ui.draggable.remove();
                                    do_noestan();
                                }
                            }
                            else{
                                if(!$(this).hasClass("pl1_selected")){
                                    $(this).addClass("pl1_selected").html($(ui.draggable).html());
                                    $(this).find("input:eq(1)").val($(this).attr("id"));
                                    $(this).css("background", "url(tumber.php?w=30&h=30&src=../images/recursos/"+$(this).find(".pl1_img").val()+")");
                                    $(ui.draggable).removeClass("pl1_selected").removeAttr("style");
                                    $(ui.draggable).empty();
                                }
                            }
                            multiarch_pl1();
                            $(".cazul").remove();
                        }/*,
                out:function(event,ui){
                    //multiarch_pl1();
                }*/
                    });
                    $("#listado_imagenes div a").click(function(){
                        $(this).parent().remove();
                    })
                }
                $("#udf_"+id).uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_'+id+'.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'auto'        :    true,
                    'fileExt'     :    extensiones,
                    'fileDesc'    :    descripcion,
                    'height'      :    21,
                    'width'       :    106,
                    'buttonImg'   :    'images/pla1.gif',
                    'multi'       :    true,
                    'simUploadLimit':  2,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        //$("#listado_imagenes").append('<div class="padrag"><a></a>'+d+'</div>');
                        if(vista_selected=="lista"){
                            agregar_vlista(d);
                        }else{
                            agregar_vgal(d);
                        }
                        multiarch_pl1();

                    }
                });
                $("#togglegrid").click(function(){
                    if($("#matriz").css("display")=="none"){
                        $("#matriz").slideDown(450, function(){});
                    }
                    else{
                        $("#matriz").slideUp(450, function(){});
                    }
                    $("#matriz").next().slideToggle(450, function(){});
                });
                $("#udfsubir_"+id+", #pl_vlista, #pl_vgal").tooltip({effect: 'slide'});
                $(".cuadromatriz").dblclick(function(){
                    $(this).removeClass("pl1_selected");
                    $(this).removeAttr("style");
                    if(vista_selected=="lista"){
                        agregar_vlista($(this).find(".pl1_img").val());
                    }else{
                        agregar_vgal($(this).find(".pl1_img").val());
                    }
                    $(this).html("");
                    $(this).empty();
                })
                if(cdt){
                    for(i=0;i<cdt.length;i++){
                        agregar_vlista(cdt[i]);
                    }
                    do_noestan();
                }
                multiarch_pl1();
            }

            //transferencias
            function upd_lista(idc){
                cad='';
                $("#trans_r_"+idc+" input").each(function(){
                    cad+=","+$(this).val();
                })
                $("#"+idc).val(cad.substr(1));
            }
            function script_transferencia(idc){
                upd_lista(idc)
                $("#trans_r_"+idc).sortable({
                    update:function(){
                        upd_lista(idc)
                    }
                });
                trans_btn_verify(idc);
            }
            function trans_btn_r(idc){
                $("#trans_l_"+idc+" input").each(function(){
                    if($(this).attr("checked")==true){
                        $(this).parent().appendTo("#trans_r_"+idc);
                    }
                })
                script_transferencia(idc)
                //$("#trans_r_"+idc).sortable();
            }
            function trans_btn_l(idc){
                $("#trans_r_"+idc+" input").each(function(){
                    if($(this).attr("checked")==true){
                        $(this).parent().appendTo("#sombra_trans_"+idc);
                    }
                })
                script_transferencia(idc)
                //$("#trans_r_"+idc).sortable();
            }
            function trans_btn_verify(idc){
                $(".trans_l input[type=checkbox]").each(function(){
                    $(this).removeAttr("checked");
                    $(this).removeAttr("selected");
                })
                r=$("#trans_r_"+idc+" .trans_li2_r").length;
                l=$("#trans_l_"+idc+" .sombra_trans .trans_li2_r").length;
                if(r==0){
                    $(".trans_btn:eq(1)").hide();
                }else{
                    $(".trans_btn:eq(1)").show();
                }
                if(l==0){
                    $(".trans_btn:eq(0)").hide();
                }else{
                    $(".trans_btn:eq(0)").show();
                }
            }
            //posicion en portada
            //    function script_ctposicion(){
            //        $(".pdm_sitocar").click(function(){
            //            $(".pdm_tocado").removeClass("pdm_tocado").addClass("pdm_sitocar");
            //            $(this).removeClass("pdm_sitocar").addClass("pdm_tocado");
            //            $("#pospl").val($(this).attr("id"));
            //        });
            //    }
            //imagen de categoria
            function hacer_imagenmenu(){
                id="im";
                extensiones="*.jpg";
                descripcion="Imágenes (*.jpg)";
                $("#udf_"+id).uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_'+id+'.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'buttonImg'   :    'images/subir-archivo_peque.gif',
                    'auto'        :    true,
                    'fileExt'     :    extensiones,
                    'fileDesc'    :    descripcion,
                    'width'       :    99,
                    'height'      :    21,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        $(".im_contenedor").html('<img src="../images/recursos/'+d+'" />');
                        redo_imagenmenu();
                    }
                });
                $(".im_btn_t").tooltip({effect: 'slide'});
                $("#im_asignar").click(function(){
                    $("#im_matriz").slideToggle(450, function(){});
                    $("#im_matriz").next().slideToggle(450, function(){});
                })
                function remover_img_sitocar(){
                    $(".menuactual").dblclick(function(){
                        if($(this).find("input:eq(0)").length!=0){
                            $(".im_contenedor").html('<img src="../images/recursos/'+$(this).find("input:eq(0)").val()+'" />')
                            $(this).removeClass("pdm_activo").removeClass("pdm_tocado").addClass("pdm_sitocar").removeAttr("style").html("");
                            redo_imagenmenu();
                        }
                        $(this).empty();
                    })
                }
                function redo_imagenmenu(){
                    //$("#im_matriz .ui-draggable").removeClass("ui-draggable");
                    //$(".im_contenedor img, .pdm_activo,.pdm_tocado").draggable("destroy");
                    $(".im_contenedor img, .pdm_activo,.pdm_tocado").draggable({
                        cursorAt:{
                            left:0,
                            top:0
                        },
                        helper:function(event){
                            return $('<div class="cazul"></div>')
                        },
                        //cursor:"move",
                        revert:'valid'
                    });
                    $(".pdm_sitocar").droppable({
                        accept:".im_contenedor img, .pdm_activo, .pdm_tocado",
                        tolerance: 'pointer',
                        drop: function(event, ui) {
                            if($(ui.draggable).parent().hasClass("im_contenedor")){
                                //viene de la lista
                                $(".menuactual").removeClass("menuactual").removeClass("pdm_tocado").addClass("pdm_sitocar").removeAttr("style").html("");
                                $(this).removeClass("pdm_sitocar").addClass("pdm_tocado").addClass("menuactual");
                                //inicia loading
                                paponer=$(ui.draggable).attr("src");
                                todo=this;
                                $("#precargas").append('<img src="'+paponer+'"/>');
                                $(todo).css("background","url(images/loading.gif) no-repeat center");
                                $("#precargas img").ready(function(){
                                    $(todo).css("background","url(tumber.php?w=30&h=30&src="+paponer+")");
                                });
                                //fin loading
                                $(".menuactual").css("background", "url(tumber.php?w=30&h=30&src="+$(ui.draggable).attr("src")+")");
                                $(this).html('<input type="hidden" name="porimagen" value="'+$(ui.draggable).attr("src").split("../images/recursos/").join("")+'"/>');
                                $(this).append('<input type="hidden" name="pospl" value="'+$(this).attr("id")+'"/>');
                                $(this).addClass("im_desdematriz");
                                $(ui.draggable).remove();
                                if($(ui.draggable).hasClass("im_desdematriz")){
                                    $(this).addClass("im_desdematriz");
                                }
                                remover_img_sitocar();
                            }else{
                                if(!$(ui.draggable).hasClass("pdm_tocado")){
                                    //quien sabe de donde venga
                                    $(this).html($(ui.draggable).html());
                                    $(ui.draggable).html("");
                                    $(this).find("[name=pospl]").val($(this).attr("id"));
                                    //inicia loading
                                    paponer="../images/recursos/"+$(this).find("[name=porimagen]").val();
                                    todo=this;
                                    $("#precargas").append('<img src="'+paponer+'"/>');
                                    $(todo).css("background","url(images/loading.gif) no-repeat center");
                                    $("#precargas img").ready(function(){
                                        $(todo).css("background","url(tumber.php?w=30&h=30&src="+paponer+")");
                                    });
                                    //fin loading
                                    //$(this).css("background","url(tumber.php?w=30&h=30&src="+")")
                                    //$(this).css("background","url(tumber.php?w=30&h=30&src=../images/recursos/"+$(this).find("[name=porimagen]").val()+")")
                                    $(".pdm_activo").removeClass("pdm_activo").removeClass("pdm_tocado").addClass("pdm_sitocar").removeAttr("style").html("");
                                    $(this).removeClass("pdm_sitocar").addClass("pdm_tocado").addClass("pdm_activo");
                                }
                                else{
                                    //viene de la matriz
                                    s=$(ui.draggable).attr("style"),
                                    $(this).html($(ui.draggable).html());
                                    $(ui.draggable).html("");
                                    $(this).attr("style", s);
                                    $(this).removeClass("pdm_sitocar").addClass("pdm_tocado").addClass("pdm_activo");
                                    $(this).find("input:eq(1)").val($(this).attr("id"));
                                    if($(ui.draggable).hasClass("menuactual")){
                                        $(this).addClass("menuactual");
                                    }
                                    $(ui.draggable).removeClass("menuactual").removeClass("pdm_tocado").addClass("pdm_sitocar").removeAttr("style").html("");
                                    remover_img_sitocar();
                                }
                            }
                            redo_imagenmenu();
                            $(".cazul").remove();
                        }
                    });
                }
                redo_imagenmenu();
                remover_img_sitocar()
                $("#im_eliminar").click(function(){
                    $(".im_contenedor").html("");
                })
            }
            //archivogg_multi
            function load_archivoggmulti(id,extensiones,descripcion,valor){
                $(".ggm_btn").tooltip({"effect":"slide"});
                function reordenar(){
                    $("#ggm_container_"+id).sortable({
                        update:function(){
                            reordenar();
                        }
                    });
                    cad='';
                    $("#ggm_container_"+id+" .ggm_item").each(function(){
                        cad+=","+$(this).text();
                    });
                    $("#"+id).val(cad.substr(1, cad.length-1));
                }
                function eliminar_ggm(){
                    $(this).parent().remove();
                }
                function add_ggm(d){
                    cad='<div class="ggm_item"><a></a>'+d+'</div>';
                    $("#ggm_container_"+id).append(cad);
                    $("#ggm_container_"+id+" a").click(eliminar_ggm);
                    reordenar();
                }
                $("#udf_"+id).uploadify({
                    'uploader'    :    'uploadify/uploadify.swf',
                    'script'      :    'upload_'+id+'.php',
                    'folder'      :    '',
                    'cancelImg'   :    'uploadify/cancel.png',
                    'auto'        :    true,
                    'fileExt'     :    extensiones,
                    'fileDesc'    :    descripcion,
                    'height'      :    21,
                    'width'       :    110,
                    'buttonImg'   :    'images/subir-archivo.gif',
                    'multi'       :    true,
                    'simUploadLimit':  2,
                    'cancelImg'   :    'images/cerrar-precarga.png',
                    'onComplete'  :    function(a,b,c,d,e){
                        add_ggm(d);
                    }
                });
                if(valor!=""){
                    r=valor.split(",");
                    for(i=0;i<r.length;i++){
                        add_ggm(r[i]);
                    }
                }
            }
<?php if($_POST["accion"]=="20" || $_POST["accion"]=="2") { ?>
    $(document).ready(function(){
        $("#im_matriz").show();
        $(".leyenda_matriz").show();

    })
    <?php } ?>

        </script>
    </head>
    <body>
        <div style="display:none;" id="precargas"></div>
        <a id="linkalerta" href="#capa_errores"></a>
        <a name="inicio"></a>
        <div id="img_top">
            <div id="imgtopcontainer">
                <img src="images/<?=$img_top?>" border="0" />
                <div id="linkstopbar">
                    <div id="main_cerrar"><a id="main_cerrar" href="logout.php"><img src="images/ico_csesion.png"/>Cerrar Sesi&oacute;n</a></div>
                    <div id="main_modificar"><a href="mod_pass.php"><img src="images/ico_pass.png"/>Modificar Contrase&ntilde;a</a></div>
                    <div id="main_usuario"><img src="images/ico_usuario.png"/><?=$_SESSION["user"]["nombre"];?></div>
                </div>
            </div>
        </div>
        <div id="main_menu" align="center"><?=$menu->ver()?></div>
        <div id="main_titulo" align="center"><?=($titulo)?></div>