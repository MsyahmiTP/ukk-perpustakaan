@extends('layouts.user')
@section('content')
    
<div class=" flex  mx-auto">   
    <div class="w-[100%]">
        <div class="flex">
            <div class="col-md-4">
                <div class="sticky top-3">
                    <div class="w-[220px]">
                        <img class=" h-[300px] rounded-lg shadow" src="{{ asset($buku->foto) }}" alt="">
                    </div>
                    {{-- <div class="book-carousel" data-flickity=''>
                        <div class="items-left carousel-cell">
                            <img class="h-[50px] rounded-lg shadow" src="{{ asset($buku->foto) }}" alt="">
                        </div>
                        <div class="items-left carousel-cell">
                        </div>
                        <div class="items-left carousel-cell">
    
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="ml-5 mt-4 text-sm">
                <div class="texl-2xl text-gray-500 font-semibold">
                    {{ $buku->penulis }}
                </div>
                <div class="text-2xl font-bold">
                    {{ $buku->judul }}
                </div>
                <div class="mb-2">
                    @foreach ($buku->kategoriBukuRelasi as $kategoriBuku)
                        <span class="">{{ $kategoriBuku->kategori->nama_kategori }}</span> 
                    @endforeach
                </div>
                
                <div class=" font-semibold mt-6">
                    Deskripsi Buku
                </div>
                <div class="mb-7">                    
                    {{ $buku->deskripsi  }}
                </div>
                <div class="text-sm flex gap-5">
                    <div>
                        <div class="mb-1 font-semibold">Tahun Terbit</div>
                        <div>{{ $buku->tahun_terbit }}</div>
                    </div>
                    <div>
                        <div class="mb-1 font-semibold">Stok</div>
                        <div>{{ $buku->stok }}</div>
                    </div>
                    <div>
                        <div class="mb-1 font-semibold">Penerbit</div>
                        <div>{{ $buku->penerbit }}</div>
                    </div>
                </div>
                <div>
                    @if (Auth::check())
                        @php
                            $userActiveBorrowingsCount = Auth::user()->peminjaman()->where('status_peminjaman', 'N')->count();
                            $maxAllowedBorrowings = 3;
                            $userHasReachedMaxBorrowings = $userActiveBorrowingsCount >= $maxAllowedBorrowings;
                        @endphp

                        @if ($buku->stok > 0 && !$userHasReachedMaxBorrowings)
                            {{-- Book is available for borrowing and user hasn't reached the maximum borrowings --}}
                            <form action="{{ route('peminjaman.store', $buku->id) }}" method="POST">
                                @csrf
                                <div>
                                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                </div>
                                <div class="mt-10">
                                    <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2">Pinjam Buku</button>
                                </div>
                            </form>
                        @elseif ($userHasReachedMaxBorrowings)
                            {{-- User has reached the maximum borrowings --}}
                            <div class="mt-10">
                                <span class="text-red-600">Anda sudah mencapai batas maksimal peminjaman ({{ $maxAllowedBorrowings }} buku).</span>
                            </div>
                        @else
                            {{-- Book is not available for borrowing --}}
                            <div class="mt-10">
                                <button type="button" onclick="history.back()" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Buku Tidak Tersedia</button>
                            </div>
                        @endif
                        @else
                        {{-- Non-authenticated user --}}
                        <div class="mt-10">
                            <button type="button" onclick="window.location.href='{{ route('login') }}'" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login untuk meminjam</button>
                        </div>
                    @endif
                </div>
                <div class="mt-14">
                    <div class="text-2xl font-bold mb-5">Ulasan</div>
                    <div class="flex gap-20 mb-10">
                        <div>
                            <div class="mb-2 font-semibold">Total Ulasan</div>
                            <div class="text-xl font-bold flex gap-2 items-center">{{ $ulasan->total() }} <span class="px-2 py-1 text-xs font-medium text-center text-white bg-green-400 rounded-lg hover:bg-green-500">Ulasan</span> </div>
                        </div>
                        <div>
                            <div class="mb-2 font-semibold">Rating</div>
                            <div class="text-xl font-bold flex gap-2 items-center">
                                {{ number_format($avg, 1) }}
                                <input type="radio" disabled class="mask mask-star-2 bg-yellow-300" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="container w-full p-4 shadow">
                            <div class="text-xl font-medium mb-5">Ulasan</div>
                            <div>
                                <form action="{{ route('tampilan.store', $buku->id) }}" method="POST">
                                    @csrf
                                    <div>
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                    </div>
                                    <div class="rating">
                                        <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-yellow-300" />
                                        <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-yellow-300" />
                                        <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-yellow-300" />
                                        <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-yellow-300" checked/>
                                        <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-yellow-300" />
                                    </div>
                                    <div class="mt-2">
                                        <textarea id="ulasan" name="ulasan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Berikan Komentar..."></textarea>
                                    </div>
                                    <div class="mt-5 text-end">
                                        <button type="submit" class="w-36 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-9">
                        @if ($ulasan->count() > 0)
                            <div class="container w-full p-4 shadow mb-2">
                                @foreach ($ulasan as $data)
                                    <div class="flex justify-between">
                                        <div class="text-xl font-medium mb-5">
                                            <div>{{ $data->users->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $data->users->email }}</div>
                                        </div>
                                        <div class="text-xl font-bold flex gap-2 items-center">
                                            {{ $data->rating }}
                                            <input type="radio" disabled class="mask mask-star-2 bg-yellow-300" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mt-2">
                                            <p class="border rounded-lg p-4">{{ $data->ulasan }}</p>
                                        </div>
                                    </div>
                                    @if(Auth::user() && Auth::user()->id == $data->users->id)
                                        <form action="{{ route('tampilan.destroy', $data->id) }}" method="POST" class="ml-1 mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 focus:outline-none">Hapus</button>
                                        </form>
                                    @endif
                                @endforeach
                            </div>
                            {{ $ulasan->links() }}
                        @else
                            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                <div>
                                    Belum ada ulasan untuk buku ini.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>           
        </div>       
    </div>
</div>
@endsection