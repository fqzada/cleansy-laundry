@extends('layouts.admin')

@section('content')
<!-- HEADER PERSIS MOCKUP -->
<header class="h-20 flex justify-between items-center px-10 border-b border-gray-800 flex-shrink-0 bg-[#161922]">
    <div class="text-sm text-gray-400 font-medium">
        Owner > <span class="text-[#4bd3b6]">Dashboard Analitik</span>
        <span class="ml-4 text-[#4bd3b6] font-mono tracking-widest" id="realtime-clock"></span>
    </div>
    
    <div class="flex items-center gap-6">
        <div class="text-right">
            <div class="text-xs text-gray-400 mb-0.5">Sesi: Owner</div>
            <div class="text-sm font-bold text-[#4bd3b6]">{{ strtoupper(auth()->user()->name ?? 'BOS RAFI') }}</div>
        </div>
        <div class="flex items-center gap-4 text-gray-400">
            <div class="relative cursor-pointer hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.02 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-0 right-0.5 w-2 h-2 bg-red-500 rounded-full border border-[#161922]"></span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 cursor-pointer hover:text-white transition">
                @csrf
                <button type="submit" class="bg-transparent border-none p-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>
</header>

<div class="flex-1 overflow-y-auto p-10 flex flex-col gap-8 bg-[#161922]">
    
    <!-- 3 KARTU ATAS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-[#1a1d26] border border-gray-800 p-6 rounded-2xl flex justify-between items-start">
            <div>
                <p class="text-[13px] text-gray-400">Total Pendapatan Bersih</p>
                <h3 class="text-xl font-bold text-white mt-3 mb-2">Rp {{ number_format($totalPendapatan ?? 0, 2, '.', ',') }}</h3>
                <p class="text-[11px] text-[#4bd3b6] font-semibold">↑ 0.00% <span class="text-gray-500">vs bulan lalu</span></p>
            </div>
            <div class="p-2 bg-[#1b4340]/50 rounded-lg text-[#4bd3b6]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
        </div>
        
        <div class="bg-[#1a1d26] border border-gray-800 p-6 rounded-2xl flex justify-between items-start">
            <div>
                <p class="text-[13px] text-gray-400">Arus Kas Tunai (Cash)</p>
                <h3 class="text-xl font-bold text-white mt-3 mb-2">Rp {{ number_format($arusKasTunai ?? 0, 0, ',', '.') }}</h3>
                <p class="text-[11px] text-gray-400 italic font-medium">{{ $notaTunaiCount ?? 0 }} Nota Terinput</p>
            </div>
            <div class="p-2 bg-gray-800 rounded-lg text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
        
        <div class="bg-[#1a1d26] border border-gray-800 p-6 rounded-2xl flex justify-between items-start">
            <div>
                <p class="text-[13px] text-gray-400">Arus Kas Non-Tunai (QRIS)</p>
                <h3 class="text-xl font-bold text-white mt-3 mb-2">Rp {{ number_format($arusKasQRIS ?? 0, 0, ',', '.') }}</h3>
                <p class="text-[11px] text-[#4bd3b6] font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Electronic Success Rate 100%
                </p>
            </div>
            <div class="p-2 bg-[#1b4340]/50 rounded-lg text-[#4bd3b6]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
            </div>
        </div>
    </div>

    <!-- AREA BAWAH -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start flex-1">
        
        <!-- GRAFIK -->
        <div class="lg:col-span-8 bg-[#1a1d26] border border-gray-800 rounded-2xl p-6 flex flex-col h-full">
            <div class="flex justify-between items-start mb-6 border-b border-gray-800/50 pb-4">
                <div>
                    <h4 class="text-white text-base font-medium">Grafik Produktivitas & Kapasitas Harian</h4>
                    <p class="text-xs text-gray-500 mt-1">Volume Produksi per Staf (Kg)</p>
                </div>
                <div class="flex border border-gray-800 rounded-md text-[10px] font-bold overflow-hidden">
                    <button id="btn-harian" onclick="setChartType('harian')" class="bg-gray-700 text-white px-4 py-2 transition">HARIAN</button>
                    <button id="btn-mingguan" onclick="setChartType('mingguan')" class="bg-[#1a1d26] text-gray-500 hover:text-white px-4 py-2 transition">MINGGUAN</button>
                </div>
            </div>
            <div class="relative w-full overflow-hidden flex-1 min-h-[300px] flex items-center justify-center">
                <canvas id="analyticsLineChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- NOTIFIKASI (Desain Dikembalikan ke Mockup) -->
        <div class="lg:col-span-4 bg-[#1a1d26] border border-gray-800 rounded-2xl p-6 flex flex-col h-full">
            <h4 class="text-white text-base font-medium flex items-center gap-2 mb-6 border-b border-gray-800/50 pb-4">
                <svg class="w-5 h-5 text-[#f17a5d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Pusat Notifikasi & Alarm
            </h4>

            <div class="flex flex-col gap-4 overflow-y-auto">
                <!-- Warning Lembur -->
                @if(($stafLemburCount ?? 0) > 0)
                <div class="bg-transparent border border-gray-700 rounded-xl p-5 flex flex-col gap-3">
                    <div class="text-[#f17a5d] text-sm font-bold flex items-center gap-2">
                        ⚠️ [WARNING]
                    </div>
                    <p class="text-sm text-gray-300 leading-relaxed">
                        Terdeteksi {{ $stafLemburCount }} staf bekerja melewati batas jam operasional reguler (Potensi Lembur Tanpa Izin)
                    </p>
                    <button class="bg-[#f17a5d] hover:bg-[#d6674a] text-white text-xs font-bold py-2.5 rounded-md transition mt-2">
                        LIHAT DETAIL PERSONEL
                    </button>
                </div>
                @else
                <div class="bg-transparent border border-gray-700 rounded-xl p-5 flex flex-col gap-3">
                    <div class="text-[#4bd3b6] text-sm font-bold flex items-center gap-2">
                        ✅ [AMAN]
                    </div>
                    <p class="text-sm text-gray-300 leading-relaxed">0 staf bekerja melewati batas jam reguler.</p>
                </div>
                @endif

                <!-- Info System -->
                <div class="bg-[#1f2937]/50 border border-gray-800 rounded-xl p-5 flex flex-col gap-2">
                    <div class="text-[#4bd3b6] text-sm font-bold">
                        🔄 [SYSTEM]
                    </div>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Sinkronisasi data transaksi outlet berjalan lancar. Cloud backup diperbarui 2 menit yang lalu.
                    </p>
                </div>

                <!-- Notif Biasa -->
                <div class="bg-[#1a1d26] border border-gray-800 rounded-xl p-4 flex items-start gap-3">
                    <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xs text-gray-400 flex-1">Update stok deterjen berhasil dilakukan oleh Kasir.</p>
                    <span class="text-[10px] text-gray-600 font-mono">10:45</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(() => {
        const now = new Date();
        document.getElementById('realtime-clock').textContent = `${now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })} || ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
    }, 1000);

    const dataHarian = @json($staffPerformanceHarian);
    const dataMingguan = @json($staffPerformanceMingguan);
    let chartInstance;

    document.addEventListener("DOMContentLoaded", function() {
        const chartCtx = document.getElementById('analyticsLineChart').getContext('2d');
        const gradientLine = chartCtx.createLinearGradient(0, 0, 0, 300);
        gradientLine.addColorStop(0, 'rgba(75, 211, 182, 0.25)');
        gradientLine.addColorStop(1, 'rgba(75, 211, 182, 0.0)');

        chartInstance = new Chart(chartCtx, {
            type: 'line',
            data: {
                labels: Object.keys(dataHarian),
                datasets: [{
                    label: 'Total (Rp)',
                    data: Object.values(dataHarian),
                    borderColor: '#1f2937', borderWidth: 2, backgroundColor: 'transparent', tension: 0.45, pointBackgroundColor: '#4bd3b6', pointBorderColor: '#161922', pointBorderWidth: 2, pointRadius: 4
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#4b5563', font: { size: 10 } } },
                    y: { grid: { color: '#1f2937' }, ticks: { color: '#4b5563', font: { size: 10 }, callback: value => value } }
                }
            }
        });
    });

    function setChartType(type) {
        document.getElementById('btn-harian').className = type === 'harian' ? "bg-gray-700 text-white px-4 py-2 transition" : "bg-[#1a1d26] text-gray-500 hover:text-white px-4 py-2 transition";
        document.getElementById('btn-mingguan').className = type === 'mingguan' ? "bg-gray-700 text-white px-4 py-2 transition" : "bg-[#1a1d26] text-gray-500 hover:text-white px-4 py-2 transition";
        
        const activeData = type === 'harian' ? dataHarian : dataMingguan;
        chartInstance.data.labels = Object.keys(activeData);
        chartInstance.data.datasets[0].data = Object.values(activeData);
        chartInstance.update();
    }
</script>
@endsection