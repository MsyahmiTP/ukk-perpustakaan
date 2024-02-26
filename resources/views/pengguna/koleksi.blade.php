@extends('layouts.user')
@section('content')

    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <button data-modal-target="ModalTambah" data-modal-toggle="ModalTambah" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah Koleksi</button>
            </div>
        </div>
    </div>

        {{-- <div class="grid grid-cols-6 gap-5">
            @foreach ($koleksi as $index => $koleksiBuku)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="{{ route('buku.show', $koleksiBuku->buku->id) }}">
                        <img class="rounded-t-lg w-full h-[290px]" src="{{ $koleksiBuku->buku->foto }}" alt=""/>
                    </a>
                    <div class="p-3">                          
                        <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-500">{{ $koleksiBuku->buku->penulis }}</h5>
                            <div class="flex justify-between items-center">
                                <p class="mb-2 text-sm font-semibold ">{{ $koleksiBuku->buku->judul }}</p>
                            
                            <div>
                                <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiKoleksi{{ $koleksiBuku }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                    </svg>
                                </button>
                                <div id="opsiKoleksi{{ $koleksiBuku }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <form action="{{ route('koleksi.destroy', $koleksiBuku->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
        <div class="grid grid-cols-4 gap-1">
            @foreach ($koleksi as $index => $koleksiBuku)
                <div class=" bg-white border shadow ">
                    <div class="flex ml-2 mt-2 mb-2">
                        <div class="">
                            <a href="{{ route('buku.show', $koleksiBuku->buku->id) }}" class="bg-white block">
                                <img class="w-auto h-[120px]" src="{{ asset($koleksiBuku->buku->foto) }}" alt="{{ $koleksiBuku->buku->foto }}" />
                            </a>              
                        </div>
                        <div class="ml-2">
                            <div class="mb-1">
                                <p class="text-base font-semibold">{{ $koleksiBuku->buku->judul }}</p>                   
                            </div>
                            @foreach ($koleksiBuku->buku->kategoriBukuRelasi as $kategoriBuku)
                                <span class="px-2 py-1 mb-1 text-xs font-medium text-center text-white bg-teal-400 rounded-lg hover:bg-teal-500">{{ $kategoriBuku->kategori->nama_kategori }}</span>
                            @endforeach
                            <h5 class="mt-1 text-sm font-semibold tracking-tight text-gray-600">{{ $koleksiBuku->buku->penulis }}</h5>
                            <button id="dropdownMenuIconHorizontalButton" data-dropdown-toggle="opsiKoleksi{{ $koleksiBuku }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-gray-50 rounded-full hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                </svg>
                            </button>
                        </div>
                        <div>
                            <div id="opsiKoleksi{{ $koleksiBuku }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <form action="{{ route('koleksi.destroy', $koleksiBuku->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-100">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection

<!-- Modal Tambah -->
<div id="ModalTambah" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Data
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="modalTambah">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('koleksi.store') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="buku_id" class="block mb-2 text-sm font-medium text-gray-900">Judul Buku</label>
                        <select name="buku_id" id="buku_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                            <option selected="">Pilih Buku</option>
                            @foreach ($buku as $koleksiBuku)
                                <option  value="{{ $koleksiBuku->id }}">{{ $koleksiBuku->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="text-center  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5  me-2 mb-2 ">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>