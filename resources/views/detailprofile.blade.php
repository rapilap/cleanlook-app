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
<form action="{{ route('user.update', ['id'=>$data->id]) }}" method="POST">
    
    @method('PUT')
    @csrf

    <div class="container">
        <div class="profile-header">
            <h1>Profile</h1>
            <div class="profile-picture">
                <i>👤</i>
            </div>
            <button class="change-photo-btn">Ubah foto</button>
        </div>

        <div>
            <div class="form-group">
                <label for="firstName">nama</label>
                <input value="{{ $data->name }}" name="name" type="text" class="form-control" id="firstName" placeholder="enter your first name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input value="{{ $data->email }}" name="email" type="email" class="form-control" id="email" placeholder="enter your email">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input value="{{ $data->address }}" name="address" type="text" class="form-control" id="alamat" placeholder="enter your address">
            </div>

            <div class="form-group">
                <label for="phone">No. Handphone</label>
                <input value="{{ $data->phone }}" name="phone" type="tel" class="form-control" id="phone" placeholder="enter your Number">
            </div>

            <div class="form-group">
                <label for="birthDate">Tanggal Lahir</label>
                <input value="{{ $data->birthdate }}" name="birthdate" type="date" class="form-control" id="birthDate" placeholder="enter your Birth Date">
            </div>

            <div class="form-group">
                <label for="gender">Jenis kelamin</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">Masukan Jenis Kelamin</option>
                    <option value="P" {{ old('gender', $data->gender ?? '') == 'P' ? 'selected' : '' }}>Wanita</option>
                    <option value="L" {{ old('gender', $data->gender ?? '') == 'L' ? 'selected' : '' }}>Pria</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="enter your password">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm new password">
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-edit">Edit</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </div>
    </div>
</form>
</x-app_user>

</html>
