@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <div class="text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Insphony" class="h-20 mx-auto mb-4">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Login Sistem Insphony
                </h1>
            </div>
            
            @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" name="username" id="username" class="