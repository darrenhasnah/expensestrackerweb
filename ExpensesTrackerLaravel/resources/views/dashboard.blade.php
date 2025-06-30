
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Expenses Tracker</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header with Logout -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard - Expenses Tracker</h1>
                    <p class="text-gray-600">Welcome, {{ Auth::user()->email }}!</p>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <x-button type="submit" variant="danger">
                        Logout
                    </x-button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Input Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Input Pengeluaran</h2>
                <form method="POST" action="/expenses" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal:</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori:</label>
                        <select name="category" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="transportasi">Transportasi</option>
                            <option value="belanja">Belanja</option>
                            <option value="hiburan">Hiburan</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah (Rp):</label>
                        <input type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi (Opsional):</label>
                        <textarea name="description" rows="3" placeholder="Catatan tambahan..."
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    </div>
                    <x-button type="submit" variant="primary" class="w-full">
                        Simpan Pengeluaran
                    </x-button>
                </form>
            </div>

            <!-- Expense History -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Riwayat Pengeluaran</h2>
                <p class="text-lg font-medium mb-4">Total Pengeluaran: Rp {{ number_format($totalExpenses ?? 0, 2, ',', '.') }}</p>
                
                @if(isset($expenses) && $expenses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $expense->date->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($expense->category) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">Rp {{ number_format($expense->amount, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $expense->description ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada data pengeluaran.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>