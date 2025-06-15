
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Kelola Pesanan (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Produk</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Jumlah</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Dipesan Pada</th> {{-- Tambah ini --}}
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status & Estimasi</th> {{-- Gabung --}}
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->product->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $order->created_at->format('d M Y, H:i') }}
                                    </td> {{-- Format tanggal --}}
                                    <td class="px-4 py-2">
                                       <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
    class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
    @csrf
    @method('PUT')

    <select name="status" 
        class="border px-2 py-1 pr-8 rounded text-sm mb-2 sm:mb-0 appearance-none bg-white">
        <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Process" {{ $order->status === 'Process' ? 'selected' : '' }}>Process</option>
        <option value="Success" {{ $order->status === 'Success' ? 'selected' : '' }}>Success</option>
    </select>

                                            @php
                                    $estimated = null;
                                     if ($order->estimated_completion) {
                                      if ($order->estimated_completion instanceof \Illuminate\Support\Carbon) {
                                        $estimated = $order->estimated_completion->format('Y-m-d');
                                     } else {
                                       $estimated = \Carbon\Carbon::parse($order->estimated_completion)->format('Y-m-d');
                                        }
                                    } elseif ($order->status === 'Process') {
                                        $estimated = \Carbon\Carbon::now()->addDays(3)->format('Y-m-d');
                                    }
                                    @endphp
                                    <input type="date" name="estimated_completion"
                                                value="{{ $estimated ?? '' }}" class="border px-2 py-1 rounded text-sm"
                                                placeholder="Estimasi Selesai" />

                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm w-full sm:w-auto mt-2 sm:mt-0">
                                            Ubah
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-gray-500 px-4 py-3">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>