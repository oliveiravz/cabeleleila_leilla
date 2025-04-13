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
                                <form id="booking-form" method="POST" action="/booking-register">
                                    <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Faça seu
                                        agendamento</h5>

                                    <div class="alert alert-warning text-center">
                                        Para realizar seu agendamento, selecione o serviço, o dia e a hora e clique em
                                        agendar.
                                    </div>

                                    <div id="bookings-container">
                                        <div class="booking mt-4">
                                            <div class="row">
                                                <div class="form-outline col-4">
                                                    <label class="form-label" for="service">Serviço</label>
                                                    <select class="form-control is-invalid" name="booking[0][service]" id="service">
                                                        <option value="">Selecione o serviço</option>
                                                        @foreach ($services as $service)

                                                        @php
                                                            $isSelected = isset($bookingData) && $bookingData[0]['service_id'] == $service['service_id'] ? 'selected' : '' ;
                                                        @endphp
                                                        <option value="{{ $service['service_id'] }}" {{$isSelected}} data-price="{{ $service['price'] }}">
                                                            {{ $service['name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-outline col-4">
                                                    <label class="form-label" for="date">Data do agendamento</label>
                                                    @php
                                                        $date = isset($bookingData) && $bookingData[0]['date'] ? $bookingData[0]['date'] : '' ;
                                                    @endphp
                                                    <input type="date" id="date" name="booking[0][date]" class="form-control is-invalid" value="{{$date}}"/>
                                                </div>
                                                <div class="form-outline col-4">
                                                    <label class="form-label" for="date">Hora do agendamento</label>
                                                    @php
                                                        $time = isset($bookingData) && $bookingData[0]['time'] ? $bookingData[0]['time'] : '' ;
                                                    @endphp
                                                    <input type="time" id="time" name="booking[0][time]" class="form-control is-invalid" value="{{$time}}" />
                                                    
                                                </div>
                                                <input type="hidden"  name="booking[0][booking_id]" class="form-control" value="{{isset($bookingData) && $bookingData[0]['booking_id'] ? $bookingData[0]['booking_id'] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    @if(!isset($bookingData))
                                    <div class="text-right mt-4 pb-2">
                                        <input 
                                            id="add-booking"
                                            class="btn btn-dark btn-sm"
                                            style="padding-left: 1rem; padding-right: 1rem;"
                                            value="Adicionar Serviço">
                                    </div>
                                    @endif

                                    <div class="text-center mt-4 pt-2">

                                        <input type="submit" class="btn btn-dark btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Agendar">
                                            
                                        <a href="/home" class="btn btn-danger btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Voltar</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VIEW JS -->
<script type="module" src="{{ asset('assets/viewJs/booking.js') }}"></script>

@endsection