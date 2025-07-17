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

        <!-- Enhanced Stats Section with Month Selector -->
        <div class="dashboard-stats-section">
            <!-- Month Selector -->
            <div class="dashboard-month-selector mb-6">
                <div class="bg-white/95 backdrop-blur-xl rounded-xl shadow-lg border border-gray-200 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-gray-700">Filter Bulan:</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <select id="monthSelector" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            <select id="yearSelector" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for($year = now()->year - 2; $year <= now()->year + 1; $year++)
                                    <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            <button id="resetToCurrentMonth" class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors">
                                Bulan Ini
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-stats-grid">
                
                <!-- Total Pengeluaran Card -->
                <div class="dashboard-stats-card-enhanced dashboard-stats-card-money-enhanced dashboard-bounce-in">
                    <div class="dashboard-stats-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="dashboard-stats-value">Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}</div>
                    <div class="dashboard-stats-label">Total Pengeluaran</div>
                    <div class="dashboard-stats-trend">
                        <span class="text-blue-600">💰</span>
                        <span class="text-gray-500">Semua waktu</span>
                    </div>
                </div>

                <!-- Total Transaksi Card -->
                <div class="dashboard-stats-card-enhanced dashboard-stats-card-transaction-enhanced dashboard-bounce-in" style="animation-delay: 0.1s;">
                    <div class="dashboard-stats-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="dashboard-stats-value">{{ isset($expenses) ? $expenses->count() : 0 }}</div>
                    <div class="dashboard-stats-label">Total Transaksi</div>
                    <div class="dashboard-stats-trend">
                        <span class="text-emerald-600">📊</span>
                        <span class="text-gray-500">Jumlah entri</span>
                    </div>
                </div>

                <!-- Average per Transaction -->
                <div class="dashboard-stats-card-enhanced dashboard-bounce-in" style="animation-delay: 0.2s;">
                    <div class="dashboard-stats-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    @php
                        $totalExpenses = $totalExpenses ?? 0;
                        $expenseCount = isset($expenses) ? $expenses->count() : 0;
                        $average = $expenseCount > 0 ? $totalExpenses / $expenseCount : 0;
                    @endphp
                    <div class="dashboard-stats-value">Rp {{ number_format($average, 0, ',', '.') }}</div>
                    <div class="dashboard-stats-label">Rata-rata per Transaksi</div>
                    <div class="dashboard-stats-trend">
                        <span class="text-indigo-600">📈</span>
                        <span class="text-gray-500">Per pengeluaran</span>
                    </div>
                </div>

                <!-- This Month Expenses -->
                <div class="dashboard-stats-card-enhanced dashboard-bounce-in" style="animation-delay: 0.3s;">
                    <div class="dashboard-stats-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @php
                        $currentMonth = now()->month;
                        $currentYear = now()->year;
                        $monthlyExpenses = 0;
                        $monthlyTransactions = 0;
                        
                        if (isset($expenses) && $expenses->count() > 0) {
                            $filteredExpenses = $expenses->filter(function($expense) use ($currentMonth, $currentYear) {
                                return $expense->date->month == $currentMonth && $expense->date->year == $currentYear;
                            });
                            $monthlyExpenses = $filteredExpenses->sum('amount');
                            $monthlyTransactions = $filteredExpenses->count();
                        }
                    @endphp
                    <div class="dashboard-stats-value" id="monthlyExpensesValue">Rp {{ number_format($monthlyExpenses, 0, ',', '.') }}</div>
                    <div class="dashboard-stats-label">Pengeluaran Bulan Terpilih</div>
                    <div class="dashboard-stats-trend">
                        <span class="text-purple-600">🗓️</span>
                        <span class="text-gray-500" id="selectedMonthText">{{ now()->format('M Y') }}</span>
                    </div>
                </div>

                <!-- Monthly Transactions Count -->
                <div class="dashboard-stats-card-enhanced dashboard-stats-card-monthly dashboard-bounce-in" style="animation-delay: 0.4s;">
                    <div class="dashboard-stats-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="dashboard-stats-value" id="monthlyTransactionsValue">{{ $monthlyTransactions }}</div>
                    <div class="dashboard-stats-label">Transaksi Bulan Terpilih</div>
                    <div class="dashboard-stats-trend">
                        <span class="text-purple-600">📝</span>
                        <span class="text-gray-500">Total entri</span>
                    </div>
                </div>

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
                            <div class="dashboard-table-scroll">
                                <table class="dashboard-table">
                                    <thead class="dashboard-table-header">
                                        <tr>
                                            <th class="dashboard-table-cell-date">Tanggal</th>
                                            <th class="dashboard-table-cell-category">Kategori</th>
                                            <th class="dashboard-table-cell-amount">Jumlah</th>
                                            <th class="dashboard-table-cell-description">Deskripsi</th>
                                            <th class="dashboard-table-cell-actions">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expenses as $expense)
                                            <tr class="dashboard-table-row">
                                                <td class="dashboard-table-cell-date">
                                                    <div class="font-semibold text-gray-800">
                                                        {{ $expense->date->format('d/m/Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $expense->date->format('l') }}
                                                    </div>
                                                </td>
                                                <td class="dashboard-table-cell-category">
                                                    @switch($expense->category)
                                                        @case('makanan')
                                                            <span class="dashboard-category-badge dashboard-category-food">
                                                                🍽️ Makanan
                                                            </span>
                                                            @break
                                                        @case('transportasi')
                                                            <span class="dashboard-category-badge dashboard-category-transport">
                                                                🚗 Transportasi
                                                            </span>
                                                            @break
                                                        @case('belanja')
                                                            <span class="dashboard-category-badge dashboard-category-shopping">
                                                                🛍️ Belanja
                                                            </span>
                                                            @break
                                                        @case('hiburan')
                                                            <span class="dashboard-category-badge dashboard-category-entertainment">
                                                                🎬 Hiburan
                                                            </span>
                                                            @break
                                                        @case('kesehatan')
                                                            <span class="dashboard-category-badge dashboard-category-health">
                                                                🏥 Kesehatan
                                                            </span>
                                                            @break
                                                        @default
                                                            <span class="dashboard-category-badge dashboard-category-other">
                                                                📝 {{ ucfirst($expense->category) }}
                                                            </span>
                                                    @endswitch
                                                </td>
                                                <td class="dashboard-table-cell-amount">
                                                    <div class="font-bold text-gray-800">
                                                        Rp {{ number_format($expense->amount, 0, ',', '.') }}
                                                    </div>
                                                </td>
                                                <td class="dashboard-table-cell-description">
                                                    <div class="text-gray-700" title="{{ $expense->description ?: 'Tidak ada deskripsi' }}">
                                                        {{ $expense->description ?: '-' }}
                                                    </div>
                                                </td>
                                                <td class="dashboard-table-cell-actions">
                                                    <div class="flex space-x-2">
                                                        <button class="dashboard-btn dashboard-btn-small dashboard-btn-secondary" 
                                                                onclick="editExpense({{ $expense->id }})" 
                                                                title="Edit">
                                                            ✏️
                                                        </button>
                                                        <button class="dashboard-btn dashboard-btn-small dashboard-btn-danger" 
                                                                onclick="deleteExpense({{ $expense->id }})" 
                                                                title="Hapus">
                                                            🗑️
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
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
        // Data untuk JavaScript
        const expensesData = @json($expenses ?? collect());
        
        // Function to update monthly stats
        function updateMonthlyStats() {
            const selectedMonth = parseInt(document.getElementById('monthSelector').value);
            const selectedYear = parseInt(document.getElementById('yearSelector').value);
            
            // Filter expenses for selected month/year
            const filteredExpenses = expensesData.filter(expense => {
                const expenseDate = new Date(expense.date);
                return expenseDate.getMonth() + 1 === selectedMonth && expenseDate.getFullYear() === selectedYear;
            });
            
            // Calculate totals
            const monthlyTotal = filteredExpenses.reduce((sum, expense) => sum + parseFloat(expense.amount), 0);
            const monthlyCount = filteredExpenses.length;
            
            // Update UI with formatted currency
            document.getElementById('monthlyExpensesValue').textContent = 'Rp ' + monthlyTotal.toLocaleString('id-ID');
            document.getElementById('monthlyTransactionsValue').textContent = monthlyCount;
            
            // Update month text
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            document.getElementById('selectedMonthText').textContent = months[selectedMonth - 1] + ' ' + selectedYear;
        }
        
        // Event listeners
        document.getElementById('monthSelector').addEventListener('change', updateMonthlyStats);
        document.getElementById('yearSelector').addEventListener('change', updateMonthlyStats);
        
        // Reset to current month
        document.getElementById('resetToCurrentMonth').addEventListener('click', function() {
            const now = new Date();
            document.getElementById('monthSelector').value = now.getMonth() + 1;
            document.getElementById('yearSelector').value = now.getFullYear();
            updateMonthlyStats();
        });

        // Functions for edit and delete actions
        function editExpense(id) {
            // TODO: Implement edit functionality
            alert('Edit functionality will be implemented soon!');
        }

        function deleteExpense(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengeluaran ini?')) {
                // TODO: Implement delete functionality
                alert('Delete functionality will be implemented soon!');
            }
        }

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.dashboard-alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(-50%) translateY(-100px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
        
        // Card animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card, .dashboard-stats-card-enhanced');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Initialize monthly stats
            updateMonthlyStats();
        });
    </script>
</body>
</html>
