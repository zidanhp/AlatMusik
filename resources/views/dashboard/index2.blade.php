@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
    <div class="bg-white rounded-lg shadow-xl p-5">
        <h2 class="text-2xl font-bold mb-5">Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <!-- Card Total Alat Musik -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Alat Musik</p>
                        <h3 class="text-3xl font-bold">1</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card Total Users -->
            <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg p-6 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-light">Total Pengguna</p>
                        <h3 class="text-3xl font-bold">2</h3>
                    </div>
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel atau konten lain -->
    </div>
</div>
@endsection