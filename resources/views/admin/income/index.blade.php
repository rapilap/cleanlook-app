<x-app title="Pendapatan" bodyClass="p-4 flex h-screen">
    <div class="container text-5xl text-secondary">
        Pendapatan
    </div>
    <div class="flex w-full flex-row gap-3 justify-between">

        <div class="mt-5 flex flex-col w-1/4">
            <label for="start">Tanggal Awal</label>
            <input type="date" name="start-date" id="start-date" class="mt-2 p-2 w-full border border-black rounded-lg hover:border-primary">
        </div>
        <div class="mt-5 flex flex-col w-1/4">
            <label for="end">Tanggal Akhir</label>
            <input type="date" name="end-date" id="end-date" class="mt-2 p-2 w-full border border-black rounded-lg hover:border-primary">
        </div>
        <div class="w-full text-end mt-5 flex items-end justify-end">
            <input type="text" name="search" id="search" placeholder="Cari di sini" class="p-2 w-2/6 items-end border border-black rounded-lg hover:border-primary">
        </div>
    </div>

    <div class="overflow-x-auto mt-5">
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th>ID Pesanan</th>
              <th>Tanggal</th>
              <th>Tipe Sampah</th>
              <th>Berat Sampah</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->
            <tr>
              <th>1</th>
              <td>03-03-2023</td>
              <td>Organik</td>
              <td>2</td>
              <td>Rp. 35,000</td>
            </tr>
            <!-- row 2 -->
            <tr class="hover">
              <th>2</th>
              <td>03-03-2023</td>
              <td>Organik</td>
              <td>2</td>
              <td>Rp. 35,000</td>
            </tr>
            <!-- row 3 -->
            <tr>
              <th>3</th>
              <td>03-03-2023</td>
              <td>Organik</td>
              <td>2</td>
              <td>Rp. 35,000</td>
            </tr>
          </tbody>
        </table>
      </div>
</x-app>