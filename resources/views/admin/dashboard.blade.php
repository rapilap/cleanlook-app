<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #b6e5a5;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            color: white;
        }
        .search-box {
            margin: 20px auto;
            width: 80%;
            display: flex;
            justify-content: center;
        }
        .search-box input {
            width: 90%;
            padding: 10px;
            border-radius: 20px;
            border: none;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin: 20px;
        }
        .card {
            height: 100px;
            background: white;
            border-radius: 10px;
        }
        .overview {
            margin: 20px;
        }
        .chart {
            height: 200px;
            background: white;
            border-radius: 10px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #e0ffe0;
            display: flex;
            justify-content: space-around;
            padding: 10px;
        }
        .footer a {
            text-align: center;
            color: black;
            text-decoration: none;
        }
        
        .header img {
            width: 100%; /* Gambar akan menyesuaikan lebar kontainer */
            max-width: 200px; /* Ukuran maksimal gambar, bisa disesuaikan */
            height: auto; /* Menjaga rasio aspek gambar */
            border-radius: 100px;
            
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="rounded-2xl">
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search" />
        </div>
        <div class="cards">
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
        </div>
        <div class="overview">
            <h3>Overview</h3>
            <div class="chart"></div>
        </div>
    </div>
    <div class="footer">
        <img src="">Dashboard</a>
        <a href="#">Pendapatan</a>
        <a href="#">Pengguna</a>
        <a href="#">Account</a>
      </div>
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 25" width="300" height="75">
  <g transform="translate(5, 5)">
    <circle cx="5" cy="5" r="4" fill="black" />
    <circle cx="15" cy="5" r="4" fill="black" />
    <circle cx="5" cy="15" r="4" fill="black" />
    <circle cx="15" cy="15" r="4" fill="black" />
  </g>

  <g transform="translate(35, 5)">
    <rect x="0" y="4" width="20" height="12" rx="2" ry="2" fill="none" stroke="black" stroke-width="2" />
    <line x1="6" y1="10" x2="14" y2="10" stroke="black" stroke-width="2" />
  </g>

  <circle cx="18" cy="5" r="4" fill="none" stroke="black" stroke-width="2" />
    <path d="M14 12c0-3 4-3 8 0" fill="none" stroke="black" stroke-width="2" />
  </g>


  <g transform="translate(95, 5)">
    <circle cx="10" cy="7" r="5" fill="none" stroke="black" stroke-width="2" />
    <path d="M3 15c0-4 6-4 14 0" fill="none" stroke="black" stroke-width="2" />
  </g>
</svg> -->
</body>
</html>
