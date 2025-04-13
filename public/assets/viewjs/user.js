$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#user-form").ajaxForm({
        type: "POST",
        dataType: "JSON",
        beforeSubmit: function () {
            Swal.fire({
                title: "Aguarde!",
                html: "Gravando as informações...",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (response) {

            // console.log(response);return;
            Swal.close();
            if(response.errors) {
                handleAjaxErrors(response)
            }else{
                Swal.fire({
                    title: "Tudo Certo!",
                    icon: "success",
                    text: "Conta criada com sucesso! Você será redirecionado."
                }).then((result) => {
    
                    if (result.isConfirmed) {
                        setTimeout(function () {
                            window.location.href = '/users-list';
                        }, 1000);
                    }
                });
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


    function handleAjaxErrors(response) {
        const messages = response.messages;
    
        $('.booking').each(function(index) {
            const booking = $(this);
            const inputs = booking.find('input, select, textarea');

            $.each(messages, function(field, message) {
                var $input = $('[name="' + field + '"]');
                var $formGroup = $input.closest('.form-outline');
                var $label = $formGroup.find('label');
        
                $input.addClass('is-invalid');
                $label.after('<span class="invalid-feedback d-inline ms-2">' + message + '</span>');
            });
        });
    }
    

});