$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#login-form").ajaxForm({
        type: "POST",
        dataType: "JSON",
        beforeSubmit: function () {
            Swal.fire({
                title: "Aguarde!",
                html: "Estamos validando suas informações, aguarde...",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (response) {
            
            if(response.error) {

                Swal.fire({
                    title: "Atenção!",
                    text: response.message,
                    icon: "warning"
                });

            }else{

                if(response.redirect) {

                    setTimeout(function () {
                        window.location.href = '/home';
                    }, 1000);
                }

            }

        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                title: "Erro inesperado!",
                text: "Não foi possível processar a requisição.",
                icon: "error"
            });
        }
    });

});