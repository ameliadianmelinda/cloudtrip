<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan - CloudTrip</title>
    <style>
        body { font-family: Arial, sans-serif; color: #222; }
        .container { width: 100%; max-width: 1100px; margin: 0 auto; }
        .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        h2 { margin:0; }
        table { width:100%; border-collapse: collapse; margin-top:10px; }
        th, td { border:1px solid #ddd; padding:8px; font-size:13px; }
        th { background:#f5f5f5; text-align:left; }
        .text-right { text-align:right; }
        @media print { .no-print { display:none; } }
    </style>
    </head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h2>CloudTrip</h2>
            <div>Laporan Pemesanan</div>
        </div>
        <div class="no-print">
            <button onclick="window.print()">Print / Save as PDF</button>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Customer</th>
                <th>Tanggal Pesan</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th class="text-right">Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pemesanan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->kode_pemesanan }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td>{{ $p->tanggal_pesan }}</td>
                <td>{{ $p->jadwal->bandaraAsal->nama_bandara ?? '-' }}</td>
                <td>{{ $p->jadwal->bandaraTujuan->nama_bandara ?? '-' }}</td>
                <td class="text-right">{{ $p->total_harga ? number_format($p->total_harga,0,',','.') : '-' }}</td>
                <td>{{ ucfirst($p->status) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><strong>Total Keseluruhan</strong></td>
                <td class="text-right"><strong>{{ number_format($total_revenue ?? $pemesanan->sum('total_harga'),0,',','.') }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
