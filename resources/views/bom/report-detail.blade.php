<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan BOM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
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
        <h1>Laporan BOM {{ '#' . $bom->id . '-' . $bom->nama }}</h1>

        <div style="display: grid;">
            <div>
                <p style="font-size: 0.8rem; mb: 0.4rem;">Nama Bom</p>
                <p>{{ $bom->nama }}</p>

                <p style="font-size: 0.8rem; mb: 0.4rem;">Referensi Internal</p>
                <p>{{ $bom->referensi_internal }}</p>
            </div>
            <div>
                <p style="font-size: 0.8rem; mb: 0.4rem;">Produk</p>
                <p>{{ $bom->produk->nama }}</p>

                <p style="font-size: 0.8rem; mb: 0.4rem;">Harga Jual</p>
                <p>{{ $bom->produk->harga_jual }}</p>

                <p style="font-size: 0.8rem; mb: 0.4rem;">Biaya Produk</p>
                <p>{{ $bom->produk->biaya_produk }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bahan Baku</th>
                    <th>Kuantitas</th>
                    <th>Harga Asli</th>
                    <th>Harga Bom</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bom->bom_detail as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->bahan_baku->nama }}</td>
                        <td>{{ $item->kuantitas ?? 'Tidak Ada' }}</td>
                        <td>{{ $item->harga_asli }}</td>
                        <td>{{ $item->harga_bom }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data BOM.</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="3"></td>
                    <td>Total Biaya</td>
                    <td>{{ format_rupiah($bom->grand_total) }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>Interval Biaya</td>
                    <td>{{ format_rupiah($bom->produk->biaya_produk - $bom->grand_total) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
