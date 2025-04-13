$(document).ready(function() {

    $('#users-table tbody tr').each(function(index) {
        let $row = $(this); 

        $(`.delete-user-${index}`).click(function() {
            let idUser = $(this).data('id_user');

            Swal.fire({
                
                title: "Atenção",
                text: "Deseja excluir usuário?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar"

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/user-delete/${idUser}`,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: "Aguarde!",
                                html: "Excluindo Usuário...",
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

    $('#users-table').DataTable({
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