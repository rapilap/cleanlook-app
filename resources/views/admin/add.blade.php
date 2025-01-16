<x-app title="Tambah Akun" bodyClass="h-screen flex flex-col gap-3">
    <div class="flex flex-row flex-grow w-full">
        {{-- Sidebar --}}
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="w-fit flex flex-col gap-5 p-7 items-center">
                <div class="avatar">
                    <div class="w-64 rounded-full items-center border">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
            </div>
            
            {{-- <div class="stats stats-vertical drop-shadow-lg w-full">
                <div class="stat">
                    <div class="stat-title">Jumlah Pesanan</div>
                    <div class="stat-value">34</div>
                </div>
                
                <div class="stat">
                    @if ($dataType === 'courier')
                        <div class="stat-title">Total Pendapatan</div>
                        @else
                        <div class="stat-title">Total Pengeluaran</div>
                    @endif
                    <div class="stat-value">Rp. 270.000</div>
                </div>
            </div> --}}
        </div>

        {{-- Main Content --}}
        <div class="flex flex-col flex-grow p-7">
            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    <label for="name">
                        Nama Lengkap 
                    </label>
                    <input type="text" id="name" name="name" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan nama lengkap">
                </div>
                <div>
                    <label for="email">
                        Email
                    </label>
                    <input type="text" id="email" name="email" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan email">
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-full">
                    <label for="phone">
                        No Telepon
                    </label>
                    <input type="text" id="phone" name="phone" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan no telepon">
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    <label for="birthdate">
                        Tanggal Lahir
                    </label>
                    <input type="date" id="birthdate" name="birthdate" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan tanggal lahir">
                </div>
                <div class="">
                    <label for="gender">
                        Jenis Kelamin
                    </label>
                    <select id="gender" name="gender" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary">
                        <option value="L" >Laki-laki</option>
                        <option value="P" >Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    <label for="address">
                        Alamat
                    </label>
                    <textarea id="address" name="address" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan alamat">
                    </textarea>
                </div>
                <div>
                    <label for="city">
                        Kota
                    </label>
                    <input type="text" id="city" name="city" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan kota">
                </div>
                <div>
                    <label for="plate_number">
                        Plat Nomor
                    </label>
                    <input type="text" id="plate_number" name="plate_number" class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" placeholder="Masukkan plat nomor">
                </div>
            </div>
            
            {{-- Footer Section --}}
            <div class="mt-auto mb-3">
                <x-button variant="secondary" class="w-full" type="submit">Simpan</x-button>
            </div>
        </div>
    </form>
    </div>
</x-app>
