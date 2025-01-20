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

<body>
    <div class="container">
        <div class="profile-header">
            <h1>Profile</h1>
            <div class="profile-picture">
                <i>👤</i>
            </div>
            <button class="change-photo-btn">Ubah foto</button>
        </div>

        <form action="/update-profile" method="POST">
            <div class="form-group">
                <label for="firstName">nama</label>
                <input type="text" class="form-control" id="firstName" placeholder="enter your first name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="enter your email">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="enter your address">
            </div>

            <div class="form-group">
                <label for="phone">No. Handphone</label>
                <input type="tel" class="form-control" id="phone" placeholder="enter your Number">
            </div>

            <div class="form-group">
                <label for="birthDate">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthDate" placeholder="enter your Birth Date">
            </div>

            <div class="form-group">
                <label for="gender">Jenis kelamin</label>
                <select class="form-control" id="gender">
                    <option value="">Masukan Jenis Kelamin</option>
                    <option value="male">Pria</option>
                    <option value="female">Wanita</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="enter your password">
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-edit">Edit</button>
                <button type="submit" class="btn btn-save">Save</button>
            </div>
        </form>
    </div>

    <!-- Tambahkan navigation bar di bawah -->
    <div class="nav-bottom">
        <a href="/berandauser" class="nav-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 2L3 9V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V9L12 2Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Beranda
        </a>
        <a href="/pesanan" class="nav-item">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9 5H7C6.46957 5 5.96086 5.21071 5.58579 5.58579C5.21071 5.96086 5 6.46957 5 7V19C5 19.5304 5.21071 20.0391 5.58579 20.4142C5.96086 20.7893 6.46957 21 7 21H17C17.5304 21 18.0391 20.7893 18.4142 20.4142C18.7893 20.0391 19 19.5304 19 19V7C19 6.46957 18.7893 5.96086 18.4142 5.58579C18.0391 5.21071 17.5304 5 17 5H15"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Pesanan
        </a>
        <a href="/detailprofile" class="nav-item active">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Profil
        </a>
    </div>
</body>

</html>
