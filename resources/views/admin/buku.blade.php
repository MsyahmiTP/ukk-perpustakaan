<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Data Buku') }}
                </h2> 
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">       
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="relative overflow-x-auto">
                    <button data-modal-target="ModalTambah" data-modal-toggle="ModalTambah" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah+</button>                   
                    <button onclick="window.open('{{ route('bukus.pdf') }}','_blank')" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">PDF</button>                   
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Judul
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Foto
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Deskripsi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Penulis
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Penerbit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tahun Terbit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stok
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
                                @foreach ($buku as $buku)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-6 py-3">
                                        {{ $buku->judul }}
                                    </td>
                                    <td class="px-6 py-3">
                                        <img src="{{ asset($buku->foto) }}"  width="80" alt="Img" class="rounded-lg" />
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ Str::limit($buku->deskripsi,50) }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $buku->penulis }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $buku->penerbit }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $buku->tahun_terbit }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $buku->stok }}
                                    </td>
                                    <td>
                                    <form id="deleteForm{{$buku->id}}" action="{{ route('bukus.destroy', $buku->id) }}" class="mt-4" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button action="{{ route('bukus.update', $buku->id) }}" data-modal-target="ModalEdit{{$buku->id}}" data-modal-toggle="ModalEdit{{$buku->id}}" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5  ">Edit</button>
                                        <button type="button" onclick="confirmAction('delete', 'deleteForm{{$buku->id}}')" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                                    </form>
                                </td>
                                </tr>
                                <div id="ModalEdit{{$buku->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Buku Tambah
                                                </h3>
                                                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                                <div class="p-6 text-gray-900">
                                                    <form action="{{ route('bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto ">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-5">
                                                            <label for="judul" class="block text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                                            <input type="text" id="judul" name="judul" value="{{ $buku->judul }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="foto" class="block text-sm font-medium text-gray-900">Foto</label>
                                                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="foto" id="foto" aria-describedby="foto_help"  type="file">
                                                          </div>
                                                        <div class="mb-5">
                                                            <label for="deskripsi" class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                                            <input type="text" id="deskripsi" name="deskripsi" value="{{ $buku->deskripsi }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="penulis" class="block text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                                                            <input type="text" id="penulis" name="penulis" value="{{ $buku->penulis }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="penerbit" class="block text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                                                            <input type="text" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="tahun_terbit" class="block text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit</label>
                                                            <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="stok" class="block text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                                            <input type="number" id="stok" name="stok" value="{{ $buku->stok }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        </div>
                                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


<!-- Main modal -->
<div id="ModalTambah" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Buku Tambah
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 text-gray-900">
                <form class="max-w-sm mx-auto" action="{{ route('bukus.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-5">
                      <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                      <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    </div>
                    <div class="mb-5">
                      <label for="foto" class="block mb-2 text-sm font-medium text-gray-900">Foto</label>
                      <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="foto" id="foto" aria-describedby="foto_help"  type="file" required>
                    </div>
                    <div class="mb-5">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-5">
                      <label for="penulis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                      <input type="text" name="penulis" id="penulis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-5">
                        <label for="penerbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-5">
                        <label for="tahun_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" id="tahun_terbit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-5">
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input type="number" name="stok" id="stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="mb-5">
                        <button type="submit" class="block mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>                                    
                  </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    function confirmAction(actionType, formId) {
        var confirmation = false;

        if (actionType === 'delete') {
            confirmation = confirm('Ada Yakin Ingin Menghapus?');
        } else if (actionType === 'edit') {
            // Add custom confirmation logic for edit if needed
            confirmation = true; // Set to true for now
        }

        if (confirmation) {
            document.getElementById(formId).submit();
        }
    }
</script>

</x-app-layout>