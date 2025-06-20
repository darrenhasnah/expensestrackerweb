<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Expenses Tracker</title>
</head>
<body>
    <div>
        <div>
            <h1>Dashboard - Expenses Tracker</h1>
            <p>Welcome, {{ Auth::user()->email }}!</p>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" style="background: #dc3545; color: white; padding: 8px 16px; border: none; cursor: pointer; border-radius: 3px;">
                Logout
            </button>
        </form>
    </div>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <h2>Input Pengeluaran</h2>
        <form method="POST" action="/expenses">
            @csrf
            <div>
                <label>Tanggal:</label><br>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
            </div>
            <div>
                <label>Kategori:</label><br>
                <select name="category" required>
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
                <label>Jumlah (Rp):</label><br>
                <input type="number" step="0.01" min="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00" required>
            </div>
            <div>
                <label>Deskripsi (Opsional):</label><br>
                <textarea name="description" rows="3" placeholder="Catatan tambahan...">{{ old('description') }}</textarea>
            </div>
            <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;">
                Simpan Pengeluaran
            </button>
        </form>
    </div>

    <div>
        <h2>Riwayat Pengeluaran</h2>
        <p><strong>Total Pengeluaran: Rp {{ number_format($totalExpenses ?? 0, 2, ',', '.') }}</strong></p>
        
        @if(isset($expenses) && $expenses->count() > 0)
            <table border="1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->date->format('d/m/Y') }}</td>
                            <td>{{ ucfirst($expense->category) }}</td>
                            <td>Rp {{ number_format($expense->amount, 2, ',', '.') }}</td>
                            <td>{{ $expense->description ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada data pengeluaran.</p>
        @endif
    </div>
</body>
</html>