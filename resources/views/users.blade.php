@extends('layouts.header')

@if(isset($user))
@include('layouts.navbar')
@endif

@section('content')
<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-12">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form id="user-form" method="POST" action="/users">
                                    <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Criar Conta</h5>

                                    <div class="bookings-container">
                                        <div class="booking">
                                            <div class="row">
                                                <div data-mdb-input-init class="form-outline mb-4 col-6">
                                                    <label class="form-label" for="name">Nome</label> 
                                                    <input type="text" id="name" name='name' class="form-control form-control-lg is-invalid" placeholder="Informe o nome"/>
                                                </div>
                                                <div data-mdb-input-init class="form-outline mb-4 col-6">
                                                    <label class="form-label" for="email">E-mail</label> 
                                                    <input type="email" id="email" name='email' class="form-control form-control-lg is-invalid" placeholder="Informe o e-mail"/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div data-mdb-input-init class="form-outline mb-4 col-6">
                                                    <label class="form-label" for="password">Senha</label> 
                                                    <input type="password" id="password" name='password' class="form-control form-control-lg is-invalid" placeholder="Insira uma senha"/>
                                                </div>

                                                @if(isset($user) && $user->master)
                                                <div data-mdb-input-init class="form-outline mb-8 col-6">
                                                    <input class="form-check-input" type="checkbox" name="master" id="master">
                                                    <label class="form-check-label" for="master">
                                                        Master
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4 pt-2">

                                        <input type="submit" class="btn btn-dark btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Gravar">
                                            
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
<script type="module" src="{{ asset('assets/viewJs/user.js') }}"></script>

@endsection