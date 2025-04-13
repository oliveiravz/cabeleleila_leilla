@extends('layouts.header')
<link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">

@section('content')

@include('layouts.navbar')
<div class="screen">
    <p class="message">Bem-vinda (o), {{ $user->name }}!</p>

    <div class="grid">
        <a href="/booking">
            <div class="item-menu">
                <p class="sub-item-menu">Agendar</p>
            </div>
        </a>
        
        <a href="my-bookings">
            <div class="item-menu">
                <p class="sub-item-menu">Meus Agendamentos</p>
            </div>
        </a>
        @if($user->master == 1)
            <a href="/dashboard">
                <div class="item-menu">
                    <p class="sub-item-menu">Dashboard</p>
                </div>
            </a>

            <a href="users">
                <div class="item-menu">
                    <p class="sub-item-menu">Cadastrar usuário</p>
                </div>
            </a>
            
            <a href="users-list">
                <div class="item-menu">
                    <p class="sub-item-menu">Consultar usuários</p>
                </div>
            </a>
        @endif
    </div>
</div>
@endsection
