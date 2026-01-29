<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">IoT Device Simulator</h3>
                    <p class="text-sm text-gray-500 mb-4">Gunakan form ini untuk meniru data yang dikirim ESP32.</p>

                    <form action="{{ route('simulation.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                            <select name="waste_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="anorganic">Anorganik (Botol/Gelas)</option>
                                <option value="organic">Organik (Sisa Makanan)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah (Pcs / Kg)</label>
                            <input type="number" step="0.1" name="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                            Kirim Data (Simulate)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>