$(document).ready(function() {

    $('#bookings-table tbody tr').each(function(index) {
        let $row = $(this); 

        $(`.edit-booking-${index}`).click(function() {
            let idBooking = $(this).data('id_booking');

            $.ajax({
                url: `/booking-register/${idBooking}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function (response) {
                    
                    window.location.href = `/booking-register/${idBooking}`;
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Não foi possível carregar os dados do agendamento.'
                    });
                }
            });
        });

        $(`.delete-booking-${index}`).click(function() {
            let idBooking = $(this).data('id_booking');

            Swal.fire({
                
                title: "Atenção",
                text: "Deseja excluir agendamento?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/booking-delete/${idBooking}`,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: "Aguarde!",
                                html: "Excluindo agendamento...",
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function (response) {

                            Swal.close();

                            if(!response.errors) {

                                Swal.fire({
                                    title: "Tudo certo!",
                                    text: response.messages,
                                    icon: "success"
                                });

                                $row.fadeOut(300, function () {
                                    $(this).remove();
                                });
                            }
                        }
                    });
                }
            });
        });

    });

    $('#bookings-table').DataTable({
        ordering: false, 
        language: {
            decimal: ",",
            thousands: ".",
            emptyTable: "Nenhum dado disponível na tabela",
            info: "Mostrando _START_ até _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 até 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros no total)",
            infoPostFix: "",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Carregando...",
            processing: "Processando...",
            search: "Buscar:",
            zeroRecords: "Nenhum registro encontrado",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            },
            aria: {
                sortAscending: ": ativar para ordenar a coluna em ordem crescente",
                sortDescending: ": ativar para ordenar a coluna em ordem decrescente"
            }
        }
    });
    
});