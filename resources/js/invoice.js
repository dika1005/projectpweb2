function showInvoice(orderData) {
    // Format tanggal agar lebih mudah dibaca
    const orderDate = new Date(orderData.created_at).toLocaleDateString(
        "id-ID",
        {
            day: "numeric",
            month: "long",
            year: "numeric",
        }
    );
    const completionDate = new Date(orderData.updated_at).toLocaleDateString(
        "id-ID",
        {
            day: "numeric",
            month: "long",
            year: "numeric",
        }
    );

    // Format angka menjadi format Rupiah
    const totalPrice = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(orderData.total_price);
    const productPrice = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(orderData.product.price);

    // Template HTML untuk Invoice
    const invoiceHTML = `
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice #${String(orderData.id).padStart(6, "0")}</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                @media print {
                    .no-print {
                        display: none !important;
                    }
                    body {
                        -webkit-print-color-adjust: exact;
                    }
                }
            </style>
        </head>
        <body class="bg-gray-100 font-sans">
            <div class="container mx-auto max-w-4xl my-8 p-8 md:p-12 bg-white shadow-2xl rounded-lg">
                <!-- Header -->
                <div class="flex justify-between items-start pb-8 border-b">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">INVOICE</h1>
                        <p class="text-gray-500">Nomor: #${String(
                            orderData.id
                        ).padStart(6, "0")}</p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-2xl font-bold text-gray-800">Toko Sepatu MassDik</h2>
                        <p class="text-gray-500">Jl. H. Ebo Bahar Muncangela<br>JKuningan, Jawa Barat</p>
                    </div>
                </div>

                <!-- Informasi Pelanggan dan Tanggal -->
                <div class="grid md:grid-cols-2 gap-8 my-8">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Ditagihkan Kepada:</h3>
                        <p class="font-bold text-gray-800">${
                            orderData.user.name
                        }</p>
                        <p class="text-gray-600">${orderData.address}</p>
                        <p class="text-gray-600">${orderData.user.email}</p>
                        <p class="text-gray-600">${orderData.phone}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <h3 class="font-semibold text-gray-700 mb-2">Detail Pesanan:</h3>
                        <p class="text-gray-600"><span class="font-semibold">Tanggal Pesanan:</span> ${orderDate}</p>
                        <p class="text-gray-600"><span class="font-semibold">Tanggal Selesai:</span> ${completionDate}</p>
                        <p class="text-gray-600"><span class="font-semibold">Status:</span> <span class="text-green-600 font-bold">Selesai</span></p>
                    </div>
                </div>

                <!-- Tabel Item Pesanan -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-800">${
                                        orderData.product.name
                                    }</p>
                                    <p class="text-sm text-gray-500">Ukuran: ${
                                        orderData.product.size
                                    }</p>
                                </td>
                                <td class="px-6 py-4 text-center">${
                                    orderData.quantity
                                }</td>
                                <td class="px-6 py-4 text-right">${productPrice}</td>
                                <td class="px-6 py-4 text-right font-semibold">${totalPrice}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Total -->
                <div class="flex justify-end mt-8">
                    <div class="w-full max-w-sm">
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-800">${totalPrice}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Pajak (0%)</span>
                            <span class="font-semibold text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between py-4 bg-gray-100 px-4 rounded-b-lg">
                            <span class="font-bold text-lg text-gray-800">TOTAL</span>
                            <span class="font-bold text-lg text-gray-800">${totalPrice}</span>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="mt-12 text-center text-sm text-gray-500">
                    <p>Terima kasih telah berbelanja di Toko Sepatu MassDik!</p>
                    <p>Ini adalah invoice yang dibuat secara otomatis oleh sistem.</p>
                </div>

                <!-- Tombol Cetak -->
                <div class="text-center mt-8 no-print">
                    <button onclick="window.print()" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-indigo-700 transition">
                        Cetak Invoice
                    </button>
                </div>
            </div>
        </body>
        </html>
    `;

    // Buka jendela baru dan tulis HTML invoice ke dalamnya
    const invoiceWindow = window.open("", "", "width=800,height=800");
    invoiceWindow.document.write(invoiceHTML);
    invoiceWindow.document.close();
    invoiceWindow.focus(); // Fokus ke jendela baru
}
document.addEventListener("DOMContentLoaded", function () {
    const invoiceButtons = document.querySelectorAll(".show-invoice-btn");

    invoiceButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const orderData = JSON.parse(this.dataset.order);
            showInvoice(orderData); // Fungsi ini harus kamu definisikan sendiri
        });
    });
});
