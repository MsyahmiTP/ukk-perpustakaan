<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Peminjaman') }}
                </h2> 
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto">     
                        <button onclick="window.open('{{ route('peminjaman.pdf') }}','_blank')" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Cetak PDF</button>              
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Buku
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Peminjaman
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Pengembalian
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($peminjaman as $peminjaman)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-6 py-3">
                                        {{ $peminjaman->users->name }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $peminjaman->buku->judul }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $peminjaman->tgl_peminjaman }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $peminjaman->tgl_pengembalian }}
                                    </td>
                                    <td class="px-6 py-3">
                                        @if ($peminjaman->status_peminjaman == 'N')
                                            <span class="text-white bg-red-500 rounded p-1">Dipinjam</span>
                                        @else
                                            <span class="text-white bg-green-500 rounded p-1">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 mt-2">
                                        @if ($peminjaman->status_peminjaman == 'N')
                                        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" class="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button data-modal-target="ModalEdit" data-modal-toggle="ModalEdit" type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5">Edit</a>
                                        </form>
                                        @else
                                        <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button data-modal-target="ModalHapus" data-modal-toggle="ModalHapus" type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5">Hapus</a>
                                        </form>
                                        @endIF
                                    </td>
                                </tr>          
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>