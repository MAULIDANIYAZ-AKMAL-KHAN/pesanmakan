<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Flash Message (jika ada) -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Bagian Header: Judul & Tombol Aksi (Kelola Menu & Lihat Menu Customer) -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h3 class="text-xl font-bold text-gray-800">Daftar Pesanan Masuk</h3>
                
                <div class="flex items-center gap-3">
                    <!-- Tombol Kelola Menu (Ungu) -->
                    <a href="{{ route('admin.foods.index') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow transition">
                        KELOLA MENU
                    </a>

                    <!-- Tombol Lihat Menu Customer (Gelap) -->
                    <a href="{{ route('customer.index') }}" target="_blank" class="px-4 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-bold text-sm rounded-lg shadow transition">
                        LIHAT MENU CUSTOMER
                    </a>
                </div>
            </div>

            <!-- Tabel Daftar Pesanan Masuk -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="py-3 px-4"># ID</th>
                                <th class="py-3 px-4">Pelanggan</th>
                                <th class="py-3 px-4">No. Meja</th>
                                <th class="py-3 px-4">Rincian Pesanan</th>
                                <th class="py-3 px-4">Total Harga</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Aksi Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <!-- Contoh Looping Pesanan Anda (Sesuaikan dengan variabel backend Anda) -->
                            @forelse($orders ?? [] as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-4 font-semibold text-gray-700">#{{ $order->id }}</td>
                                    <td class="py-4 px-4 text-gray-800 font-medium">{{ $order->customer_name }}</td>
                                    <td class="py-4 px-4">
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded-md text-xs font-semibold">
                                            Meja {{ $order->table_number }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-gray-600">
                                        <!-- Rincian pesanan -->
                                        @foreach($order->details as $detail)
                                            <div class="text-xs">• {{ $detail->food->name ?? 'Menu' }} x{{ $detail->quantity }} (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})</div>
                                        @endforeach
                                    </td>
                                    <td class="py-4 px-4 font-bold text-gray-800">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($order->status == 'pending')
                                            <span class="px-2.5 py-1 bg-amber-100 text-amber-800 rounded text-xs font-bold">PENDING</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">SELESAI</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        <!-- Form update status pesanan -->
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-md text-xs p-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai / Lunas</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-500">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>