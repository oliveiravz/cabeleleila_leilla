$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#booking-form").ajaxForm({
        type: "POST",
        dataType: "JSON",
        beforeSubmit: function () {
            Swal.fire({
                title: "Aguarde!",
                html: "Estamos realizando seu agendamento...",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (response) {

            Swal.close();

            if(response.errors) {

                handleAjaxErrors(response);
            } else {

                Swal.fire({
                    title: "Tudo Certo!",
                    icon: "success",
                    text: "Seu agendamento foi realizado com sucesso."
                }).then((result) => {

                    if (result.isConfirmed) {
                        setTimeout(function () {
                            window.location.href = '/my-bookings';
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

    $('#add-booking').click(function () {
        let clone = $('.booking').first().clone();
    
        clone.find('input, select').val('');
        clone.find('select').prop('selectedIndex', 0);
    
        clone.find('input, select, textarea').each(function () {
            let name = $(this).attr('name');
            
            if (name) {
                
                let baseName = name.replace(/booking\[\d+\]/, 'booking[0]');
                $(this).attr('name', baseName);
            }
        });
    
        $('#bookings-container').append(clone);
        updateIndexes();
    });
    

    function updateIndexes() {
        $('#bookings-container .booking').each(function(index) {
            $(this).find('input, select, textarea').each(function() {
                let name = $(this).attr('name');
                if (name && name.includes('0')) {
                    let newName = name.replace('0', index);
                    $(this).attr('name', newName);
                }
            });
        });
    }

    function handleAjaxErrors(response) {
        const messages = response.messages;
    
        $('.booking').each(function (index) {
            const booking = $(this);
            const bookingErrors = messages[index];
    
            if (!bookingErrors) return;
    
            $.each(bookingErrors, function(field, message) {
                const input = booking.find(`[name="booking[${index}][${field}]"]`);
                const formGroup = input.closest('.form-outline');
                const label = formGroup.find('label');
    
                input.removeClass('is-invalid');
                formGroup.find('.invalid-feedback').remove();
    
                if (message) {
                    input.addClass('is-invalid');
                    label.after(`<span class="invalid-feedback d-block">${message}</span>`);
                }
            });
        });
    }
    
});