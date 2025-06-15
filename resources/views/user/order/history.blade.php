<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
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
                                    Produk</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Jumlah</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Total</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Tanggal Pesanan</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $order->product->name ?? '-' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $order->quantity }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">Rp
                                        {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ $order->status === 'Success' ? 'Selesai' : $order->status }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $order->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ $order->status === 'Success' ? $order->updated_at->format('d-m-Y H:i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 px-4 py-3">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>