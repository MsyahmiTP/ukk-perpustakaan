<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Data Kategori Buku') }}
                </h2> 
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="relative overflow-x-auto">
                    <button data-modal-target="ModalTambah" data-modal-toggle="ModalTambah" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah+</button>                   
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Buku
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kategori
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
                                @foreach ($kategoribuku as $kategoribuku)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $no++ }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $kategoribuku->buku->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $kategoribuku->kategori->nama_kategori }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form id="deleteForm{{$kategoribuku->id}}" action="{{ route('kategori-buku.destroy', $kategoribuku->id) }}" class="mt-4" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button action="{{ route('kategori-buku.update', $kategoribuku->id) }}" data-modal-target="ModalEdit{{$kategoribuku->id}}" data-modal-toggle="ModalEdit{{$kategoribuku->id}}" type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 ">Edit</button>
                                            <button type="button" onclick="confirmAction('delete', 'deleteForm{{$kategoribuku->id}}')" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div id="ModalEdit{{$kategoribuku->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Kategori Buku Edit
                                            </h3>
                                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                                <div class="p-6 text-gray-900">
                                                    <form action="{{ route('kategori-buku.update', $kategoribuku->id) }}" method="POST" class="max-w-sm mx-auto">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-5">
                                                            <label for="buku_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Buku</label>
                                                            <select name="buku_id" id="buku_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                @foreach ($buku as $j)
                                                                    @if ($j->id == $kategoribuku->buku_id)
                                                                        <option value="{{ $j->id }}" selected>{{ $j->judul }}</option>
                                                                    @else
                                                                        <option value="{{ $j->id }}">{{ $j->judul }}</option>
                                                                    @endif
                                                                @endforeach                           
                                                            </select>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kategori</label>
                                                            <select name="kategori_id" id="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                @foreach ($kategori as $k)
                                                                    @if ($k->id == $kategoribuku->kategori_id)
                                                                        <option value="{{ $k->id }}" selected>{{ $k->nama_kategori }}</option>
                                                                    @else
                                                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                                                    @endif
                                                                @endforeach 
                                                            </select>
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
                    Kategori Buku Tambah
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 text-gray-900">
                <form class="max-w-sm mx-auto" action="{{ route('kategori-buku.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="buku_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($buku as $buku)
                                <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                            @endforeach                           
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
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