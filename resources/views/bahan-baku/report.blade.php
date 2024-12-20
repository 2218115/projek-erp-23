<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bahan Baku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5d87ff;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e8f5e9;
        }

        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            color: #fff;
            background-color: #5d87ff;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }

        .btn:hover {
            background-color: #5d87ff;
        }

        @media (max-width: 768px) {

            table th,
            table td {
                font-size: 12px;
                padding: 8px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Laporan Bahan Baku</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bahan Baku</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Ukuran</th>
                    <th>Model</th>
                    <th>Referensi</th>
                    <th>Harga Beli</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bahan_baku as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if (file_exists(public_path('storage/gambar_bahan_baku/' . $item->gambar)))
                                <img style="width: 3rem; height: 3rem;"
                                    src="data:image/{{ pathinfo($item->gambar, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents(public_path('storage/gambar_bahan_baku/' . $item->gambar))) }}"
                                    alt="{{ $item->nama }}">
                            @endif
                        </td>
                        <td>{{ $item->kategori_produk->nama ?? 'Tidak Ada' }}</td>
                        <td>{{ $item->ukuran->nama ?? 'Tidak Ada' }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->referensi_internal }}</td>
                        <td>Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $item->stock ? $item->stock : 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center;">Tidak ada data bahan baku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
