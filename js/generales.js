$(document).ready(function(){
    //$(".textoidioma:eq(1)").hide();
    $(".tidi1, .tidi2").hide();
    actual=2;
    $("#seelan").click(function(){
        $(".textoidioma").fadeOut(450, function(){
            if(actual==2){
                $("#seelan").html("English Text");
                $(".textoidioma").html($(".tidi1").html());
                actual=1
            }else{
                $("#seelan").html("Texto en Español");
                $(".textoidioma").html($(".tidi2").html());
                actual=2;
            }
            $(".textoidioma").fadeIn(450, function(){});
        })
        return false;
    })
    $("#seelan").click();
    if($.browser.msie){
        setInterval("ubicar_ie()",100);
    }
    if($("#imgautor").length>0){
        $("#imgautor").css({
            "position":"relative",
            "top":$("#imgautor").parent().height()-70
        });
    }
});
function asignar_numero(num){
    $.post("includes/contenido.php", "content=set_archivo&numero="+num, function(data,textstatus){
        window.location.href="index.php";
    }, "text");
}
function ubicar_ie(){
    if($(".barracompartir a:eq(1)").length>0){
        r=$(".barracompartir a:eq(1)").position();
        if($(".barracompartir a:eq(1)").length>0){
            $(".barracompartir a:eq(2)").css({
                position:"absolute",
                "left":r.left+60,
                "top":r.top
            });
        }else{
            $(".barracompartir a:eq(2)").css({
                position:"absolute",
                "left":60,
                "top":0
            });
        }
    }
}
function load_inicio(){
    $("#flash1").cycle({
        fx: 'fade' ,
        speed:  450,
        timeout:  7000
    });
    $("#flash2").cycle({
        fx: 'fade' ,
        speed:  450,
        timeout:  6000
    });
    $("#flash3").cycle({
        fx: 'fade' ,
        speed:  450,
        timeout:  7000
    });
    $("#flash4").cycle({
        fx: 'fade' ,
        speed:  1000,
        timeout:  8000
    });
}
function load_plantilla4(){
    $(".conbox").fancybox({
        opacity:0.9,
        onStart:function(){
            $("#fancybox-overlay").height=$(document).height();
        }
    });
    if($(".cuadromatriz").length>0)
        tot=parseInt($(".cuadromatriz:last").attr("id").split("cdm").join(""));
    else
        tot=0
    if($(".conbox").length>0){
        num=parseInt($(".conbox:last").attr("id").split("cdm").join(""));
        for(i=num+1;i<=tot;i++){
            $("#cdm"+i).remove();
        }
    }else{
        for(i=4;i<=tot;i++){
            $("#cdm"+i).remove();
        }
    }
}
function load_plantilla1(){
    if($(".cuadromatriz").length>0)
        tot=parseInt($(".cuadromatriz:last").attr("id").split("cim").join(""));
    else
        tot=0
    if($(".conbox").length>0){
        num=parseInt($(".conbox:last").attr("id").split("cim").join(""));
        for(i=num+1;i<=tot;i++){
            $("#cim"+i).remove();
        }
    }else{
        for(i=4;i<=tot;i++){
            $("#cim"+i).remove();
        }
    }
}
function agregar_matriz(pos,img){
    $("#"+pos).html('<img src="tumber.php?w=116&h=116&src=images/recursos/'+img+'"/>');
    $("#"+pos).addClass("conbox");
    $("#"+pos).attr({
        "href": "images/recursos/"+img,
        "rel":"Cantartica"
    });
}
function agregar_pl1(pos,img,id,sec){
    $("#"+pos).html('<img src="tumber.php?w=87&h=87&src=images/recursos/'+img+'" />');
    $("#"+pos).addClass("conbox");
    $("#"+pos).attr("href","index.php?opc="+sec+"&cat="+id);
}
function agregar_pl4_sec(pos,img,id,sec){
    $("#"+pos).html('<img src="tumber.php?w=116&h=116&src=images/recursos/'+img+'" />');
    $("#"+pos).addClass("conbox");
    $("#"+pos).attr("href","index.php?opc="+sec+"&cat="+id);
}
$.fn.formvalidator=function(alterminar){
    requerido="required";
    email="email";
    numero="numero";
    decimal="decimal";
    salto="\n";
    jQuery(this).each(function(){
        jQuery(this).submit(function(){
            mensaje="";
            jQuery(this).find("."+requerido).each(function(){
                if(jQuery(this).val().split(" ").join("")==""){
                    mensaje+="El campo "+jQuery(this).attr("alt")+" es obligatorio."+salto;
                }
            })
            jQuery(this).find("."+email).each(function(){
                mie=jQuery(this).val();
                arroba=mie.indexOf("@");
                punto=mie.indexOf(".");
                len=mie.length;
                if(len>0)
                    if(len<=2 || arroba>punto || arroba==-1 || punto==-1 || arroba==punto-1 || punto>=len-1){
                        mensaje+="El campo "+jQuery(this).attr("alt")+" no es correcto"+salto;
                    }
            })
            if(mensaje!=""){
                alterminar(0,mensaje)
                return false;
            }
            else
                return alterminar(1,mensaje);
        })
    })
}