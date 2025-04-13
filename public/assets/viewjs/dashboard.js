$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#booking-chart").ajaxForm({
        type: "POST",
        dataType: "JSON",
        beforeSubmit: function () {
            Swal.fire({
                title: "Aguarde!",
                html: "Estamos gerando o gráfico...",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (response) {

            console.log(response);
            Swal.close();

            $("#myChart").show('slow');
            const ctx = document.getElementById('myChart');

            const labels = response.map(item => item.day);
            const data = response.map(item => item.bookings_total);
            const sumPrices = response.map(item => item.sum_price); 

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total de Agendamentos',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const index = context.dataIndex;
                                    const total = context.dataset.data[index];
                                    const price = sumPrices[index];
            
                                    return `Agendamentos: ${total} - Total: R$ ${price}`;
                                }
                            }
                        }
                    }
                }
            });

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