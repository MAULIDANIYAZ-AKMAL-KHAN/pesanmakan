<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-5xl mx-auto py-10 px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Menu Restoran</h1>
            <p class="text-gray-600">Pilih menu makanan dan masukkan nomor meja Anda</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm font-medium">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.checkout') }}" method="POST">
            @csrf

            <!-- 1. Informasi Pemesan -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
                <h2 class="text-lg font-semibold mb-4">1. Informasi Pemesan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="customer_name" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan nama pemesan">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Meja</label>
                        <input type="number" name="table_number" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: 05">
                    </div>
                </div>
            </div>

            <!-- 2. Pilih Menu -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4">2. Pilih Menu</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($foods as $food)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col justify-between p-4">
                            <!-- Hidden Input untuk ID Makanan (Wajib ada di dalam form) -->
                            <input type="hidden" name="food_id[]" value="{{ $food->id }}">

                            <div>
                                <div class="h-36 bg-gray-200 rounded-md mb-3 flex items-center justify-center text-gray-400 text-sm">
                                    @if(isset($food->image) && $food->image)
                                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="h-full w-full object-cover rounded-md">
                                    @else
                                        Tanpa Gambar
                                    @endif
                                </div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded font-semibold">{{ ucfirst($food->category ?? 'Makanan') }}</span>
                                    <span class="text-green-600 font-bold text-sm">Rp {{ number_format($food->price) }}</span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $food->name }}</h3>
                                <p class="text-gray-500 text-xs mt-1">{{ $food->description }}</p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-gray-100">
                                <label class="block text-xs font-medium text-gray-500 mb-1">Jumlah Porsi</label>
                                <input type="number" name="quantity[]" value="0" min="0" class="w-full border border-gray-300 rounded-md p-1.5 text-center font-bold text-gray-700">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Pesan -->
            <div class="text-center">
                <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-700 transition">
                    Pesan Sekarang
                </button>
            </div>
        </form>
    </div>

</body>
</html>