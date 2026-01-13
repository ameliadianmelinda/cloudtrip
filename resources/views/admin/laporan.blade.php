@extends('layout.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-0">Laporan Transaksi CloudTrip</h2>
        <div class="text-muted small">Ringkasan dan daftar transaksi CloudTrip</div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <form class="d-flex align-items-center" onsubmit="return false;">
            <div class="input-group" style="width:360px;">
                <span class="input-group-text bg-white border-end-0" style="border-top-left-radius:24px;border-bottom-left-radius:24px;">
                    <i class="bi bi-search"></i>
                </span>
                <input id="trans-search" type="text" class="form-control form-control-sm border-start-0" placeholder="Cari transaksi (kode / nama / bandara / status)...">
                <button id="trans-clear" class="btn btn-outline-secondary btn-sm" style="border-top-right-radius:24px;border-bottom-right-radius:24px;">✕</button>
            </div>
        </form>
        <a href="{{ route('laporan.print') }}" target="_blank" class="btn btn-outline-secondary btn-sm">Print / PDF</a>
    </div>
</div>

<div class="card-section mt-3">
    <div class="mb-3">
        <strong>Total Transaksi:</strong> {{ $transSummary['total_transactions'] }}
        &nbsp;&nbsp; <strong>Total Pendapatan:</strong> {{ number_format($transSummary['total_revenue'],0,',','.') }}
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle jadwal-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Bayar</th>
                    <th class="text-end">Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->kode_pemesanan }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->jadwal->bandaraAsal->nama_bandara ?? '-' }}</td>
                    <td>{{ $p->jadwal->bandaraTujuan->nama_bandara ?? '-' }}</td>
                    <td>{{ $p->tanggal_pesan }}</td>
                    <td>{{ $p->pembayaran && $p->pembayaran->tanggal_bayar ? $p->pembayaran->tanggal_bayar : '-' }}</td>
                    <td class="text-end">{{ $p->total_harga ? number_format($p->total_harga,0,',','.') : '-' }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    (function(){
        const input = document.getElementById('trans-search');
        const clearBtn = document.getElementById('trans-clear');
        const table = document.querySelector('.jadwal-table tbody');
        if(!input || !table) return;

        function filterRows(){
            const q = input.value.trim().toLowerCase();
            for(const row of table.rows){
                const text = row.innerText.toLowerCase();
                row.style.display = q === '' ? '' : (text.indexOf(q) !== -1 ? '' : 'none');
            }
        }

        input.addEventListener('input', filterRows);
        clearBtn.addEventListener('click', function(e){ e.preventDefault(); input.value=''; filterRows(); });
    })();
</script>

@endsection
