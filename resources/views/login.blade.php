@extends('layouts.header')

@section('content')
<section class="vh-100 mb-4" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form id="login-form" method="POST" action="/login">

                                    <div class="d-flex justify-content-center mb-3">
                                        <img src="{{ asset('assets/images/cabeleleila_leila.png') }}" class="img-fluid" alt="Sample image" width='100px' height='100px'>
                                    </div>

                                    <div class="d-flex justify-content-center mb-3">
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Entre na sua conta </h5>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="email">E-mail</label> 
                                        <input type="email" id="email" name='email' class="form-control form-control-lg"/>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="senha">Senha</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg"/>
                                    </div>

                                    <div class="mt-4 d-flex justify-content-center">
                                        <input type="submit" class="btn btn-dark btn-lg"
                                            style="padding-left: 4.5rem; padding-right: 4.5rem;" value="Login">
                                    </div>
                                    
                                    <div class="mt-4 pt-2">
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Não tem uma conta? <a href="/users"
                                                style="color: #393f81;">Crie uma conta</a></p>
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
<script type="module" src="{{ asset('assets/viewJs/login.js') }}"></script>

@endsection