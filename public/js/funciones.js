$(document).ready(function(){
            $("#boton-submit").click(function (e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "datos.php",
                    data: $("#form_1").serialize(),
                    success: function(data){
                        
                    }
                });
                //$.post("datos.php", {"id":2})
                    //.done(function (data) {
                    //$("#espacio").html(data);
                //});
            });
});   