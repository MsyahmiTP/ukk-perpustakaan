@extends('layouts.user')
@section('content')



<div class="flex">
    <!-- Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto dashboard-bg">
        <main class="p-4 bg-opacity-50 text-black text-center">
            <!-- Main content goes here -->
            <h1 class="text-2xl font-semibold mb-4">Selamat Datang di E-Library</h1>
            <p class="text-lg">Temukan berbagai koleksi buku dan nikmati pengalaman membaca yang menyenangkan di perpustakaan kami.</p>
            <p class="text-lg mt-4">Dapatkan akses ke ribuan buku dari berbagai genre dan penulis terkenal.</p>
            <a href="{{ route('beranda') }}"  class="mt-4 inline-block text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Jelajahi Beranda</a>
        </main>
    </div>
</div>


@endsection