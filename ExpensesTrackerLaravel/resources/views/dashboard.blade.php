<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Expenses Tracker</title>
    @vite(['resources/css/app.css', 'resources/css/dashboard.css'])
</head>
<body class="dashboard-container">
    <header class="dashboard-header">
        <nav class="dashboard-nav">
            <div class="dashboard-brand">
                <div class="dashboard-logo">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="dashboard-title">Expenses Tracker</h1>
                    <p class="dashboard-subtitle">Personal Finance Management</p>
                </div>
            </div>
            
            <div class="dashboard-user-info">
                <div class="text-right">
                    <p class="dashboard-welcome">Welcome back,</p>
                    <p class="dashboard-user-email">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dashboard-btn dashboard-btn-danger">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <main class="dashboard-main">
        @if(session('success'))
            <div class="dashboard-alert dashboard-alert-success dashboard-fade-in">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="dashboard-alert dashboard-alert-error dashboard-fade-in">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-0.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="dashboard-stats">
            <div class="dashboard-stat-card dashboard-scale-in">
                <div class="dashboard-stat-value text-blue-600">
                    Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}
                </div>
                <div class="dashboard-stat-label">Total Pengeluaran</div>
            </div>
            <div class="dashboard-stat-card dashboard-scale-in" style="animation-delay: 0.1s;">
                <div class="dashboard-stat-value text-indigo-600">
                    {{ isset($expenses) ? $expenses->count() : 0 }}
                </div>
                <div class="dashboard-stat-label">Total Transaksi</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="lg:col-span-1">
                <div class="dashboard-card dashboard-fade-in">
                    <div class="dashboard-card-header">
                        <h2 class="dashboard-card-title">
                            <svg class="dashboard-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Tambah Pengeluaran</span>
                        </h2>
                    </div>
                    
                    <form method="POST" action="{{ route('expenses.store') }}" class="dashboard-form">
                        @csrf
                        
                        <div class="dashboard-form-group">
                            <label class="dashboard-label">Tanggal</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" 
                                   class="dashboard-input" required>
                        </div>
                        
                        <div class="dashboard-form-group">
                            <label class="dashboard-label">Kategori</label>
                            <select name="category" class="dashboard-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>🍽️ Makanan</option>
                                <option value="transportasi" {{ old('category') == 'transportasi' ? 'selected' : '' }}>🚗 Transportasi</option>
                                <option value="belanja" {{ old('category') == 'belanja' ? 'selected' : '' }}>🛍️ Belanja</option>
                                <option value="hiburan" {{ old('category') == 'hiburan' ? 'selected' : '' }}>🎬 Hiburan</option>
                                <option value="kesehatan" {{ old('category') == 'kesehatan' ? 'selected' : '' }}>🏥 Kesehatan</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>📝 Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="dashboard-form-group">
                            <label class="dashboard-label">Jumlah (Rupiah)</label>
                            <input type="number" step="0.01" min="0.01" name="amount" 
                                   value="{{ old('amount') }}" placeholder="0" 
                                   class="dashboard-input" required>
                        </div>
                        
                        <div class="dashboard-form-group">
                            <label class="dashboard-label">Deskripsi (Optional)</label>
                            <textarea name="description" rows="3" 
                                      placeholder="Catatan tambahan untuk pengeluaran ini..." 
                                      class="dashboard-textarea">{{ old('description') }}</textarea>
                        </div>
                        
                        <button type="submit" class="dashboard-btn dashboard-btn-primary w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Simpan Pengeluaran
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="dashboard-card dashboard-fade-in" style="animation-delay: 0.2s;">
                    <div class="dashboard-card-header">
                        <h2 class="dashboard-card-title">
                            <svg class="dashboard-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>Riwayat Pengeluaran</span>
                        </h2>
                    </div>
                    
                    @if(isset($expenses) && $expenses->count() > 0)
                        <div class="dashboard-table-container">
                            <table class="dashboard-table">
                                <thead class="dashboard-table-header">
                                    <tr>
                                        <th class="dashboard-table-th">Tanggal</th>
                                        <th class="dashboard-table-th">Kategori</th>
                                        <th class="dashboard-table-th">Jumlah</th>
                                        <th class="dashboard-table-th">Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $expense)
                                        <tr class="dashboard-table-row">
                                            <td class="dashboard-table-td">
                                                <div class="font-semibold">
                                                    {{ $expense->date->format('d/m/Y') }}
                                                </div>
                                                <div class="text-xs text-slate-500">
                                                    {{ $expense->date->format('l') }}
                                                </div>
                                            </td>
                                            <td class="dashboard-table-td">
                                                <span class="category-{{ $expense->category }}">
                                                    {{ ucfirst($expense->category) }}
                                                </span>
                                            </td>
                                            <td class="dashboard-table-td">
                                                <div class="font-bold text-slate-800">
                                                    Rp {{ number_format($expense->amount, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="dashboard-table-td">
                                                <div class="max-w-xs">
                                                    {{ $expense->description ?: '-' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="dashboard-empty">
                            <svg class="dashboard-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <h3 class="dashboard-empty-title">Belum Ada Pengeluaran</h3>
                            <p class="dashboard-empty-text">Mulai dengan menambahkan pengeluaran pertama Anda menggunakan form di sebelah kiri.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.dashboard-alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
        
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
