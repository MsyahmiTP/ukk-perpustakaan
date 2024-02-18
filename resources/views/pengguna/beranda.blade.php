@extends('layouts.user')
@section('content')


<div class="mb-8">
    <div class="font-bold text-lg mb-3">Daftar Buku</div>
    <div class="flex space-x-0 items-center">
        <hr class="border-2 border-blue-600 cursor-pointer w-[105px]">
        <hr class="border-1 border-gray-300 cursor-pointer w-full">
    </div>
</div>

<div class="grid grid-cols-6 gap-5">
    
    @foreach ($buku as $buku)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            
            <a href="{{ route('buku.show', $buku->id) }}">
                <img class="rounded-t-lg w-full h-[290px]" src="{{ asset($buku->foto) }}" alt="{{ $buku->foto }}"/>
            </a>
            
            <div class="p-3">              
                <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-500">{{ $buku->penulis }}</h5>
                <p class="mb-2 text-sm font-semibold ">{{ $buku->judul }}</p>
            </div>
            
        </div>
        @endforeach
        
    </div>
    
    @endsection