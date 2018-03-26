<center><h1 id="TiFor">Formulario de registro de Perosnas </h1></center>
<fieldset>
    <legend>Datos registro</legend>
    <form id="regisPais" name="regisPais">
        <label>CC<input type="texto" required id="CC" name="CC" value=""></label><br>
        <label>Nombre<input type="texto" required id="NOM" name="NOM" value=""></label><br>
        <label>Apellido<input type="texto" required id="APE" name="APE" value=""></label><br>
        <label>Foto<input type="texto" required id="URL" name="URL" value=""></label><br>
        <label>Genero
            <select id="Genero" name="Genero" required>
                <option selected value="">Seleccione</option>
                <option value="f">Femenino</option>
                <option value="m">Masculino</option>
                <option value="l">LGTBI</option>                
            </select>
        </label><br>        
        <label>Perfil<textarea id="perfil" required name="perfil"></textarea></label><br>
        <button id="BTEnvio" type="submit">Almacenar</button>
        <button id="BTCancelar" type="reset">Limpiar</button>
    </form>
    <div id="respuesta"></div>
</fieldset>
<?php
if (isset($_POST["modi"])) {
    require '../class/DAO/PersonaDAO.php';
    require '../class/VO/PersonaVO.php';
    require '../class/bd/datos.php';
    require '../class/bd/MySQLi.php';

    $PersonaDAO = new PersonaDAO();
    echo "<h2>este es el ID" . $_POST['ID'] . "</h2>";
    ?>
    <script>
        $(document).ready(function () {
            $("#TiFor").html("Formulario de actualización de datos");
            $("#BTEnvio").html("Modificar");
            $("#BTCancelar").html("Cancelar");
            $("#BTCancelar").click(function () {
                $("#contenido").html("<center>Elija una opcion del menu.</center>");
            });
            var data =<?= $PersonaDAO->listarID(json_encode($_POST)) ?>;
            $("#CC").val(data.cc);
            $("#NOM").val(data.nombre);
            $("#APE").val(data.apellido);
            $("#URL").val(data.URL);
            $("#Genero").val(data.genero);
            $("#perfil").val(data.perfil);

            $("#regisPais").append('<input type="hidden" required id="ID" name="ID" value="' + data.id + '">');


            $("#regisPais").validate({
                rules: {
                    nombre: {
                        required: true,
                        maxlength: 15,
                        minlength: 3
                    },
                    perfil: {
                        required: true,
                        maxlength: 200
                    },
                    apellido: {
                        required: true,
                        maxlength: 40,
                        minlength: 3
                    },
                    Genero: {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {

                },
                submitHandler: function () {
                    var request = "ModiPer.php";
                    var cadena = $("#regisPais").serialize() + "&pc=true";
                    var metodo = function (datos) {
                        var res = $.parseJSON(datos);
                       if(res.resp=="ok"){
                           alert("Los datos fueron Modificados");
                          // $("#regisPais").LimpiarFor();
                       }else{
                           alert("Error #01\n !!! huuuspppp !!! \n Hay un error en la comunicación");
                       }
                    };
                    f_ajax(request, cadena, metodo);
                }
            });




            var efe_aja;
            function f_ajax(request, cadena, metodo) {
                this.efe_aja = $.ajax({
                    url: request,
                    cache: false,
                    beforeSend: function () { /*httpR es la variable global donde guardamos la conexion*/
                        $(document).ajaxStop();
                        $(document).ajaxStart();
                    },
                    type: "POST",
                    dataType: "html",
                    contentType: 'application/x-www-form-urlencoded; charset=utf-8;',
                    data: cadena,
                    timeout: 8000,
                    success: function (datos) {
                        metodo(datos);
                    },
                    error: function () {
                        alert("No hay conexión");
                    }
                });
            }
        });

    </script>
    <?php
}