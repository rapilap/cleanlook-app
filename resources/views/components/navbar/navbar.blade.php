<div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-300">
  <div class="flex justify-around items-center py-3">
      <a href="/admin/dashboard" 
          class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('admin/dashboard') ? 'bg-primary text-white' : '' }}">
          <!-- SVG dan Teks -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M3 3h8a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm0 12h8a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1zm12-12h6a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm0 10h6a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1z"/>
          </svg>
          <span class="text-sm text-gray-600">Dashboard</span>
      </a>

      <a href="/admin/income" 
          class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('admin/income') ? 'bg-primary text-white' : '' }}">
          <!-- SVG dan Teks -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2zm0 2v8h16V8H4zm12 4a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            <path d="M2 8a2 2 0 0 1 2-2h12a1 1 0 0 1 1 1v2H4V8z" opacity="0.5"/>
          </svg>
          <span class="text-sm text-gray-600">Pendapatan</span>
      </a>

      <a href="/admin/location" 
          class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('admin/location*') ? 'bg-primary text-white' : '' }}">
          <!-- SVG dan Teks -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 12.75 7 12.75S19 14.25 19 9c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
          </svg>
          <span class="text-sm text-gray-600">Lokasi</span>
      </a>

      <a href="/admin/accounts" 
          class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('admin/accounts*') ? 'bg-primary text-white' : '' }}">
          <!-- SVG dan Teks -->
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M9 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 2c-3.316 0-6 1.343-6 3v2a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-2c0-1.657-2.684-3-6-3zm8-5a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 2c-1.326 0-2.52.318-3.467.855A4.954 4.954 0 0 1 17 13v1a1 1 0 0 1-.875.992A1 1 0 0 1 16 14v-1c0-1.104.895-2 2-2h2a2 2 0 0 0-2-2z"/>
        </svg>  
          <span class="text-sm text-gray-600">Daftar Akun</span>
      </a>
  </div>
</div>
