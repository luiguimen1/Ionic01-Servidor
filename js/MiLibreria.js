$(document).ready(function () {
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


    var loading = '<img src="img/loading.gif">';

    function irlunes() {
        $("#contenido").html("Loading...." + loading);
        var request = "FormuCrea.php";
        var parametros = "hola=mundo";
        var metodo = function (datos) {
            $("#contenido").html(datos);
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
                    apellido:{
                        required:true,
                        maxlength:40,
                        minlength:3
                    },
                    Genero:{
                        required:true,
                        minlength:1
                    }
                },
                messages: {},
                submitHandler: function () {
                   var request = "crPersona";
                   var parametros = $("#regisPais").serialize()+"&pc=true";
                   var metodo = function(datos){
                       var res = $.parseJSON(datos);
                       if(res.resp=="ok"){
                           alert("Los datos fueron registrados");
                           $("#regisPais").LimpiarFor();
                       }else{
                           alert("Error #01\n !!! huuuspppp !!! \n Hay un error en la comunicación");
                       }
                   };
                    f_ajax(request,parametros,metodo);
                }
            });
        };
        f_ajax(request, parametros, metodo);
    }

    function irMartes() {
        $("#contenido").html("Loading...." + loading);
        var request = "view/Martes.php";
        var parametros = "hola=mundo";
        var metodo = function (datos) {
            $("#contenido").html(datos);
        };
        f_ajax(request, parametros, metodo);
    }


    function irMiercoles() {
        $("#contenido").html("Loading...." + loading);
        var request = "view/miercoles.php";
        var parametros = "hola=mundo";
        var metodo = function (datos) {
            $("#contenido").html(datos);
        };
        f_ajax(request, parametros, metodo);
    }


    $("#lunes").click(function () {
        irlunes();
    });


    $("#martes").click(function () {
        irMartes();
    });

    $("#miercoles").click(function () {
        irMiercoles();
    });
});