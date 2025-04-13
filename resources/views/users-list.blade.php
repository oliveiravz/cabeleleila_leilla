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
                                <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Usuários Cadastrados</h5>
                                <table id="users-table" class="table table-striped display">
                                    <thead class="table-dark">
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Administrador</th>
                                        <th>Ações</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{$users[$key]['name']}}</td>
                                            <td>{{$users[$key]['email']}}</td>
                                            <td>{{ isset($users[$key]['master']) && $users[$key]['master'] == 1 ? 'Sim' : 'Não'}}</td>
                                            <td id="acoes">
                                                <button class="btn btn-danger delete-user-{{$key}} " data-id_user="{{ $users[$key]['user_id'] }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-4 pt-2">
                                    <a href="/home" class="btn btn-danger btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Voltar">Voltar</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VIEW JS -->
<script type="module" src="{{ asset('assets/viewJs/users-list.js') }}"></script>

<!-- DATATABLE -->
<link href="{{ asset('assets/datatable/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
@endsection