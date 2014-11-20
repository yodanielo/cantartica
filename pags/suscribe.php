<div id="sus_todo">
    <form action="index.php?opc=suscribirse" name="frm_sus" id="frm_sus" method="post" >
        <div id="sus_title">Suscribete</div>
        <div class="sus_col" style="float:left;clear:both;">
            <div class="susfila">
                <label>Nombre:</label><input type="text" alt="Nombre" name="nombre" id="nombre" class="sus_input required"/><span>*</span>
            </div>
            <div class="susfila">
                <label>Apellidos:</label><input type="text" alt="Apellidos" name="apellidos" id="apellidos" class="sus_input required"/><span>*</span>
            </div>
            <div class="susfila">
                <label>Email:</label><input type="text" name="email" alt="E-mail" id="email" class="sus_input required email"/><span>*</span>
            </div>
            <div class="susfila">
                <label>Edad:</label><input type="text" name="edad" id="edad" class="sus_input"/>
            </div>
            <div class="susfila">
                <label>Localidad:</label><input type="text" name="localidad" id="localidad" class="sus_input"/>
            </div>
            <div class="susfila">
                <label>Intereses:</label><input type="text" name="intereses" id="intereses" class="sus_input"/>
            </div>
            <div class="susfila">
                <label>Profesi&oacute;n:</label><input type="text" name="profesion" id="profesion" class="sus_input"/>
            </div>
        </div>
        <div class="sus_col" style="float:right">
            <div class="susfila">
                <label style="clear:both;">Comentario:</label>
                <textarea name="comentario" id="comentario"></textarea>
            </div>
            <div class="susfila">
                <input class="sus_submit" type="submit" name="submit" value="Enviar" />
                <input class="sus_submit" type="button" id="borrar" value="Borrar" />
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("#frm_sus").formvalidator(function(a,b){
        if(a==0){
            alert(b);
        }else{
            alert("Gracias por suscribirse.");
        }
    })
    $("#borrar").click(function(){
        $("input[type*=text],textarea").val("");
    });
</script>
