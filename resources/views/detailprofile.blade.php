<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: white;
            padding-bottom: 70px;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #f0f0f0;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-picture i {
            font-size: 50px;
            color: #999;
        }

        .change-photo-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-save {
            background-color: #4CAF50;
            color: white;
        }

        /* Update style navbar */
        .nav-bottom {
            background: white;
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            max-width: 480px;
            margin: 0 auto;
            border-top: 1px solid #eee;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #666;
            font-size: 12px;
            gap: 4px;
        }

        .nav-item.active {
            color: #4CAF50;
        }

        .nav-item svg {
            width: 24px;
            height: 24px;
        }
    </style>
</head>

{{-- @dump($data); --}}
<x-app_user title="Profil">
<form action="{{ route('user.update', ['id'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
    
    @method('PUT')
    @csrf

    <div class="container">
        <div class="profile-header flex-col flex items-center">
            <h1 class="text-secondary text-5xl font-medium text-start mb-3 w-full">Profil pengguna</h1>
            <div class="avatar">
                <div class="w-32 rounded-full items-center border">
                    {{-- <img id="previewImage" src="{{ $data->image ? asset('storage/' . $data->image) : asset('images/default-avatar.png') }}"> --}}
                    <img id="previewImage" src="{{ $data->image ? asset('storage/' . $data->image) : asset('assets/default-avatar.png') }}">

                </div>
            </div>
            @if (Auth::guard('web')->check())
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
            @endif
        </div>

        <div>
            <div class="form-group">
                <label for="firstName">Nama</label>
                <input value="{{ $data->name }}" name="name" type="text" class="form-control border border-primary hover:border-secondary" id="firstName" placeholder="Masukkan nama" disabled>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input value="{{ $data->email }}" name="email" type="email" class="form-control border border-primary hover:border-secondary" id="email" placeholder="Masukkan email" disabled>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input value="{{ $data->address }}" name="address" type="text" class="form-control border border-primary hover:border-secondary" id="alamat" placeholder="Masukkan alamat" disabled>
            </div>

            <div class="form-group">
                <label for="phone">No. Telepon</label>
                <input value="{{ $data->phone }}" name="phone" type="tel" class="form-control border border-primary hover:border-secondary" id="phone" placeholder="Masukkan no telepon" disabled>
            </div>

            <div class="form-group">
                <label for="birthDate">Tanggal Lahir</label>
                <input value="{{ $data->birthdate }}" name="birthdate" type="date" class="form-control border border-primary hover:border-secondary" id="birthDate" placeholder="Masukkan tanggal lahir" disabled>
            </div>

            <div class="form-group">
                <label for="gender">Jenis kelamin</label>
                <select class="form-control border border-primary hover:border-secondary" id="gender" name="gender" disabled>
                    <option value="">Masukan Jenis Kelamin</option>
                    <option value="P" {{ old('gender', $data->gender ?? '') == 'P' ? 'selected' : '' }}>Wanita</option>
                    <option value="L" {{ old('gender', $data->gender ?? '') == 'L' ? 'selected' : '' }}>Pria</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input name="password" type="password" class="form-control border border-primary hover:border-secondary" id="password" placeholder="Masukkan password baru" disabled>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="form-control border border-primary hover:border-secondary" id="password_confirmation" placeholder="Konfirmasi password" disabled>
            </div>

            <div class="button-group">
                <x-button variant='warning' type="button" class="btn btn-edit text-xl" id="edit-btn">Ubah</x-button>
                <x-button variant='secondary' type="submit" class="btn btn-save text-xl" id="save-btn">Simpan</x-button>
            </div>
        </div>
    </div>
</form>
</x-app_user>

</html>

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
<script>
    document.getElementById('edit-btn').addEventListener('click', function () {
        document.querySelectorAll('.form-control').forEach(input => {
            input.removeAttribute('disabled');
        });
    
        document.getElementById('edit-btn').classList.add('hidden');
        document.getElementById('save-btn').classList.remove('hidden');
    });
    </script>
    
