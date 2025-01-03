<x-app title="Akun" bodyClass="relative h-screen bg-gray-50"> {{-- Tambahkan relative untuk container utama --}}
    <div class="p-3">
        <div class="justify-between flex flex-row items-center">
            <div class="gap-3">
                <x-button variant="primary" class="max-w-fit">Akun kurir</x-button>
                <x-button variant="primary" class="max-w-fit">Akun pengguna</x-button>
            </div>
            <div>
                <input type="search" class="p-3 rounded-lg border max-w-fit bg-white hover:border-secondary" placeholder="Search">
            </div>
            <div class="">
                <x-button as='a' href="/admin/tambah" variant="secondary">Tambah Kurir</x-button>
            </div>
        </div>

        <table class="w-full border-collapse border border-gray-300 mt-3">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-2 font-normal text-center">ID</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Email</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Nama</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">No Telepon</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Domisili</th>
                    <th class="border border-gray-300 p-2 font-normal text-center">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2 text-center">1</td>
                    <td class="border border-gray-300 p-2">ahmad@gmail.xyz</td>
                    <td class="border border-gray-300 p-2">Ahmad</td>
                    <td class="border border-gray-300 p-2">Jalan jalan</td>
                    <td class="border border-gray-300 p-2">Pangandaran</td>
                    <td class="border border-gray-300 p-2 text-center"><x-button variant="secondary">Detail</x-button></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="absolute bottom-0 inset-x-0 flex justify-between p-3 bg-white">
        <span>1</span>
        <span>2</span>
        <span>3</span>
    </div>
</x-app>
