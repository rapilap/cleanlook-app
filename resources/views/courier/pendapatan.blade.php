<x-app_user title="Pendapatan">
<div class=" text-white p-6 rounded-b-full h-full"  style="background-color: #0D9276">
    <div>
        <div class="text-sm mb-4">
            <p>Selamat Pagi,</p>
            <h1 class="text-2xl font-bold">Singgih Prasetyo</h1>
        </div>
    </div>
<div class="flex justify-center ">
  <div class=" text-teal-900 p-6 rounded-lg shadow-lg w-9/12" style="background-color: #74E291">
    <h2 class="text-lg font-semibold">Total Balance</h2>
    <p class="text-3xl font-bold">Rp. 9.250.000,00</p>
    <div class="flex justify-between items-center mt-4">
      <div class="flex items-center">
        <div class="bg-teal-200 p-2 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-teal-900">
  <path d="M12 5v10" /> 
  <path d="M19 15l-7 7-7-7" /> 
</svg>

        </div>
        <div class="ml-2">
          <p class="text-sm font-medium">Income</p>
          <p class="text-lg font-bold">Rp. 300.000,00</p>
        </div>
      </div>
      <div class="flex items-center">
        <div class="bg-teal-200 p-2 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-teal-900">
  <path d="M12 19V9" /> <!-- Batang panah -->
  <path d="M5 9l7-7 7 7" /> <!-- Kepala panah -->
</svg>

        </div>
        <div class="ml-2">
          <p class="text-sm font-medium">Expenses</p>
          <p class="text-lg font-bold">Rp. 125.000,00</p>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="flex justify-between items-center pl-6">
  <span class="text-lg font-bold">Transactions History</span>
  <button id="accordion-toggle" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none pr-6">See all</button>
</div>
<<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
<div>
<div class="text-lg font-bold text-black">User</div>
<div class="text-sm text-gray-500">Today</div>
</div>
<div class="text-lg font-bold text-teal-500">+Rp. 15.000,00</div>
</div>
<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">Admin</div>
    <div class="text-sm text-gray-500">Today</div>
  </div>
  <div class="text-lg font-bold text-red-600">-Rp. 15.000,00</div>
</div>
<div id="accordion-content" class="hidden bg-white p-0 rounded-md">
  <!-- Konten accordion -->
  <ul class="list-disc p-0">

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Yesterdey</div>
  </div>
  <div class="text-lg font-bold text-red-600">-Rp. 15.000,00</div>
</div>

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Friday</div>
  </div>
  <div class="text-lg font-bold text-red-600">-Rp. 15.000,00</div>
</div>

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Wednesdey</div>
  </div>
  <div class="text-lg font-bold text-teal-500">+Rp. 15.000,00</div>
</div>

  </ul>
</div>

<script>
  const toggleButton = document.getElementById('accordion-toggle');
  const content = document.getElementById('accordion-content');

  toggleButton.addEventListener('click', () => {
    content.classList.toggle('hidden');
  });
</script>

<!-- <div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Today</div>
  </div>
  <div class="text-lg font-bold text-teal-500">+Rp. 15.000,00</div>
</div>

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">Admin</div>
    <div class="text-sm text-gray-500">Today</div>
  </div>
  <div class="text-lg font-bold text-red-600">-Rp. 15.000,00</div>
</div>

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Today</div>
  </div>
  <div class="text-lg font-bold text-teal-500">+Rp. 15.000,00</div>
</div>

<div class="flex justify-between items-center p-4 border border-teal-500 rounded-lg font-sans w-50 m-3">
  <div>
    <div class="text-lg font-bold text-black">User</div>
    <div class="text-sm text-gray-500">Today</div>
  </div>
  <div class="text-lg font-bold text-teal-500">+Rp. 15.000,00</div>
</div> -->



</div>
</x-app_user>