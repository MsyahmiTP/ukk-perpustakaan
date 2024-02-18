<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Library') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }

            .text-2xl {
                font-size: 1.5rem;
            }

            .font-semibold {
                font-weight: 600;
            }

            .text-primary {
                color: #50A4FF;
            }

            .mt-10 {
                margin-top: 2.5rem;
            }

            .text-right {
                text-align: right;
            }

            .mb-2 {
                margin-bottom: 0.5rem;
            }

            .underline {
                text-decoration: underline;
            }

            .w-full {
                width: 100%;
            }

            .h-10 {
                height: 2.5rem;
            }

            .my-5 {
                margin-top: 1.25rem;
                margin-bottom: 1.25rem;
            }

            .font-semibold {
                font-weight: 600;
            }

            .text-lg {
                font-size: 1.125rem;
            }

            .mb-2 {
                margin-bottom: 0.5rem;
            }
        </style>
    </head>
    <body>
        <div>
            <h1 class="text-2xl font-semibold text-primary">E-Library</h1>
            <div class="mt-10">
                <div style="float: left;">
                    <p class="mb-2"><span class="font-semibold">Dilaporkan Oleh :</span> <span class="underline underline-offset-[6px]">{{ Auth::user()->nama_lengkap }}</span></p>
                    <p><span class="font-semibold">Jenis Laporan :</span> <span class="underline underline-offset-[6px]">Laporan Pendataan Buku</span></p>
                </div>
                <div style="float: right;">
                    <p><span class="font-semibold">Tanggal Laporan :</span> <span class="underline underline-offset-[6px]">{{ now()->format('d-m-Y') }}</span></p>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="bg-primary w-full h-10 my-5"></div>
            <div>
                <h2 class="font-semibold text-lg mb-2">Daftar Buku</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td>{{ $item->penerbit }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>