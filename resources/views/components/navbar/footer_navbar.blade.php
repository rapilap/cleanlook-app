@php
    $user = Auth::guard('courier')->check() ? Auth::guard('courier')->user() : Auth::guard('web')->user();
@endphp

<div class="fixed bottom-0 z-0 left-0 w-full bg-white border-t border-gray-300">
    <div class="flex justify-around items-center py-3">
      {{-- @if (Auth::user() && Auth::user()->role === 'user') --}}
      @if (Auth::guard('web')->check())
      <a href="/home" class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('home*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <path d="M9 22V12h6v10"></path>
        </svg>
        <span class="text-sm text-gray-600">Beranda</span>
      </a>
          
      <a href="/history" class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('history*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
        <span class="text-sm text-gray-600">Riwayat</span>
      </a>

      {{-- <a href="{{ route('user.profile', ['id'=>auth()->user()->id]) }}" class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('profile*') ? 'bg-primary text-white' : '' }}"> --}}
        <a href="{{ route('user.profile', ['id'=>auth()->user()->id]) }}" class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('profile*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 12c2.209 0 4-1.791 4-4s-1.791-4-4-4-4 1.791-4 4 1.791 4 4 4z"></path>
          <path d="M4 20h16"></path>
        </svg>
        <span class="text-sm text-gray-600">Profil</span>
      </a>
      
      {{-- @else --}}
      @elseif (Auth::guard('courier')->check()) 
      <a href="/courier/home" class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('courier/home*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
          <path d="M9 22V12h6v10"></path>
        </svg>
        <span class="text-sm text-gray-600">Beranda</span>
      </a>
          
      <a href="/courier/history" class="flex flex-col items-center p-2 rounded-lg hover:bg-primary hover:text-white {{ Request::is('courier/history*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
        <span class="text-sm text-gray-600">Riwayat</span>
      </a>

      {{-- <a href="{{ route('user.profile', ['id' => $user->id ?? '']) }}" class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('courier/profile*') ? 'bg-primary text-white' : '' }}"> --}}
      <a href="{{ route('courier.profile', ['id'=>auth()->user()->id]) }}" class="flex flex-col items-center py-2 px-4 rounded-lg hover:bg-primary hover:text-white {{ Request::is('courier/profile*') ? 'bg-primary text-white' : '' }}">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 12c2.209 0 4-1.791 4-4s-1.791-4-4-4-4 1.791-4 4 1.791 4 4 4z"></path>
          <path d="M4 20h16"></path>
        </svg>
        <span class="text-sm text-gray-600">Profil</span>
      </a>
          
      @endif
    </div>
  </div>
  