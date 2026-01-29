<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tarik Saldo (Withdraw)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 text-gray-700">Form Pengajuan</h3>
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                            <p class="text-sm text-gray-500">Saldo Tersedia</p>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('withdraw.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Metode Pencairan</label>
                                <select name="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="GOPAY">GoPay</option>
                                    <option value="DANA">DANA</option>
                                    <option value="OVO">OVO</option>
                                    <option value="SHOPEEPAY">ShopeePay</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor HP / Rekening</label>
                                <input type="number" name="account_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="08xxxxxx" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nominal (Min. 10.000)</label>
                                <input type="number" name="amount" min="10000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                @error('amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-md hover:bg-gray-800 transition">
                                Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 text-gray-700">Riwayat Penarikan</h3>
                        <div class="overflow-y-auto max-h-[400px]">
                            @forelse($history as $item)
                            <div class="flex justify-between items-center p-3 mb-2 border-b border-gray-100 last:border-0">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->payment_method }} - {{ $item->account_number }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">- Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                    <span class="text-xs px-2 py-1 rounded-full {{ $item->status == 'completed' ? 'bg-green-100 text-green-600' : ($item->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <p class="text-center text-gray-400 text-sm mt-10">Belum ada riwayat penarikan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>