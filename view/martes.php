
<center> <h1>Listado de Usuario</h1></center>
<center> <h2>Registrados</h2></center>

<div id="ListaPais">
    <table style="width: 100%;" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>CC</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>foto</th>
                <th>genero</th>
                <th>perfil</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>    
        </thead>
        <tbody id="listado">

        </tbody>
    </table>
</div>

<script>
<?php
require '../class/DAO/PersonaDAO.php';
require '../class/VO/PersonaVO.php';
require '../class/bd/datos.php';
require '../class/bd/MySQLi.php';

$PersonaDAO = new PersonaDAO();
?>
    $(document).ready(function () {
        var data =<?php $PersonaDAO->listar(); ?>;
        function cargarData() {
            var limite = data.length;
            for (var i = 0; i < limite; i++) {
                var local = data[i];
                var insert = '<tr>' +
                        '<th>'+local.id+'</th>' +
                        '<th>'+local.cc+'</th>' +
                        '<th>'+local.nombre+'</th>' +
                        '<th>'+local.apellido+'</th>' +
                        '<th><img src="'+local.URL+'" width="50px" height="50px" /></th>' +
                        '<th>'+local.genero+'</th>' +
                        '<th>'+local.perfil+'</th>' +
                        '<th><button type="none" class="Eliminar" id="'+local.id+'">Eliminar</button></th>' +
                        '<th><button type="none" class="Modificar" id="'+local.id+'">Modificar</button></th>' +
                        '</tr>';
                $("#listado").append(insert);
            }
            
            $(".Eliminar").click(function(){
                var soyYo = $(this);
                var id = $(this).attr("id");
                var request = "EliPersona.php";
                var parametros = "pc=true&ID="+id;
                var metodo=function(datos){
                    var res = $.parseJSON(datos);
                    if(res.resp=="ok"){
                        soyYo.parent().parent().remove();
                        alert("La persona fue eliminda");
                    }else{
                        alert("Error #2\n huuuufffff\n Error de Comunicacion. \n si el error persiste comuniquese con el administrador")
                    }
                };
                f_ajax(request,parametros,metodo);
            });
            
            $(".Modificar").click(function(){
                var request = "FormuCrea.php";
                var parametros = "modi=true&ID="+$(this).attr("id");
                var metodo = function(datos){
                     $("#contenido").html(datos);
                };
                f_ajax(request,parametros,metodo);        
       // alert("el Id a Modificar es "+$(this).attr("id"));
            });
        }
        
        cargarData();
        
        
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
