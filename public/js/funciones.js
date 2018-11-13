$(document).ready(function(){
            $("#boton").click(function (e){
                e.preventDefault();
                $.post(""), {"var":2})
                    .done(function (data) {
                    $("#espacio").html("data");
                });
            });
});   