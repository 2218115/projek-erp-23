<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for Quotation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $nama_perusahaan }}</h1>
        <p>{{ $alamat_penerima }}</p>
    </div>

    <div>
        <p>{{ $rfq->vendor->nama }}</p>
        <b>{{ $alamat_pengirim }}</b>
    </div>

    <div>
        <p>{{ $rfq->status->nama }}</p>
    </div>



    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Harga Satuan</th>
                <th>Pajak</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rfq->rfq_detail as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->bahan_baku->nama }}</td>
                    <td>{{ $item->kuantitas }}</td>
                    <td>{{ format_rupiah($item->harga_satuan) }}</td>
                    <td>{{ $item->pajak }}%</td>
                    <td>{{ format_rupiah($item->subtotal) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">
                </td>
                <td>Total Tanpa Total</td>
                <td>{{ format_rupiah($rfq->total_tanpa_pajak) }}</td>
            </tr>
            <tr>
                <td colspan="4">
                </td>
                <td>Total Pajak</td>
                <td>{{ format_rupiah($rfq->total_pajak) }}</td>
            </tr>
            <tr>
                <td colspan="4">
                </td>
                <td>Grand Total</td>
                <td>{{ format_rupiah($rfq->grand_total) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>
