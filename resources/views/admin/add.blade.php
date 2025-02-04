<x-app title="Tambah Akun" bodyClass="h-screen flex flex-col gap-3">
    {{-- Sidebar --}}
    <form action="{{ route('admin.store') }}" method="POST" class="w-full h-full flex flex-row flex-grow" enctype="multipart/form-data">
        @csrf
        <div class="w-fit flex flex-col gap-5 p-7 items-center">
            <div class="avatar">
                <div class="w-64 rounded-full items-center border">
                    <img id="previewImage" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
            <input 
            type="file" 
            name="image" 
            id="imageInput" 
            accept="image/*"
            class="file:bg-secondary
            file:px-6 file:py-2 file:m-5
            file:text-white file:font-medium
            file:border file:border-secondary
            file:rounded-lg"
            value="{{ old('image') }}">
            {{-- <x-button onclick="document.getElementById('imageInput').click()" variant='secondary'>Upload Foto</x-button> --}}
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Main Content --}}
        <div class="flex flex-col flex-grow p-7">
            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    <label for="name">
                        Nama Lengkap 
                    </label>
                    <input 
                    type="text" 
                    id="name" 
                    name="name"
                    value="{{ old('name') }}" 
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan nama lengkap">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email">
                        Email
                    </label>
                    <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan email">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-full">
                    <label for="phone">
                        No Telepon
                    </label>
                    <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan no telepon">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-2 w-full text-xl flex flex-row justify-between gap-3">
                <div class="w-4/6">
                    <label for="birthdate">
                        Tanggal Lahir
                    </label>
                    <input 
                    type="date" 
                    id="birthdate" 
                    name="birthdate" 
                    value="{{ old('birthdate') }}"
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan tanggal lahir">
                    @error('birthdate')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
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
                    <textarea 
                    id="address" 
                    name="address" 
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="city">
                        Kota
                    </label>
                    <input 
                    type="text" 
                    id="city" 
                    name="city" 
                    value="{{ old('city') }}"
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan kota">
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="plate_number">
                        Plat Nomor
                    </label>
                    <input 
                    type="text" 
                    id="plate_number" 
                    name="plate_number" 
                    value="{{ old('plate_number') }}"
                    class="w-full p-2 rounded-xl border-2 drop-shadow-lg hover:border-secondary" 
                    placeholder="Masukkan plat nomor">
                    @error('plate_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Footer Section --}}
            <div class="mt-auto">
                <x-button variant="secondary" class="w-full" type="submit">Simpan</x-button>
            </div>
        </div>
    </form>
</x-app>

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function(){
            let output = document.getElementById('previewImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>