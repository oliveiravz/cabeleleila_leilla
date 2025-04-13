@extends('layouts.header')

@include('layouts.navbar')

@section('content')
<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-12">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form id="booking-chart" method="POST" action="/booking-chart">
                                        <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Gráfico de agendamentos</h5>

                                        <div class="alert alert-warning text-center">
                                            Clique em gerar Gráfico para o relatório da semana
                                        </div>

                                        <div class="text-center mt-4 pt-2">

                                        <input type="submit" class="btn btn-dark btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Gerar Gráfico">
                                            
                                        <a href="/home" class="btn btn-danger btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Voltar</a>

                                    </form>
                                </div>
                                <canvas class="mt-4" id="myChart" style="display:none;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VIEW JS -->
<script type="module" src="{{ asset('assets/viewJs/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection