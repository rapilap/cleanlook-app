<x-app_user title="Pendapatan">
  <div class="text-white p-6 rounded-b-full h-full" style="background-color: #0D9276">
    <div>
      <div class="text-sm mb-4">
        <p>Selamat Pagi,</p>
        <h1 class="text-2xl font-bold" id="user-name">Loading...</h1>
      </div>
    </div>
    <div class="flex justify-center">
      <div class="text-teal-900 p-6 rounded-lg shadow-lg w-9/12" style="background-color: #74E291">
        <h2 class="text-lg font-semibold">Total Balance</h2>
        <p class="text-3xl font-bold" id="total-balance">Rp. 0</p>
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
              <p class="text-lg font-bold" id="total-income">Rp. 0</p>
            </div>
          </div>
          <div class="flex items-center">
            <div class="bg-teal-200 p-2 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-teal-900">
                <path d="M12 19V9" />
                <path d="M5 9l7-7 7 7" />
              </svg>
            </div>
            <div class="ml-2">
              <p class="text-sm font-medium">Expenses</p>
              <p class="text-lg font-bold" id="total-expenses">Rp. 0</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex justify-between items-center pl-6">
    <span class="text-lg font-bold">Transactions History</span>
    <button onclick="fetchTransactions()" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none pr-6">Reload</button>
  </div>

  <div id="transaction-list" class="mt-4 space-y-2 p-3"></div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    async function fetchUser() {
      try {
        const response = await axios.get("http://localhost:8000/api/user", { withCredentials: true });
        document.getElementById("user-name").innerText = response.data.name;
      } catch (error) {
        console.error("Error fetching user:", error);
        document.getElementById("user-name").innerText = "Guest";
      }
    }

    async function fetchTransactions() {
      try {
        const response = await axios.get("http://localhost:8000/api/historycourier", { withCredentials: true });
        const transactions = response.data;

        let totalIncome = 0;
        let totalExpenses = 0;
        let totalBalance = 0;

        const transactionList = document.getElementById("transaction-list");
        transactionList.innerHTML = "";

        transactions.forEach(trx => {
          const amount = parseFloat(trx.amount);
          const isIncome = trx.type === "income";

          if (isIncome) {
            totalIncome += amount;
          } else {
            totalExpenses += amount;
          }

          totalBalance = totalIncome - totalExpenses;

          const transactionItem = document.createElement("div");
          transactionItem.className = `flex justify-between items-center p-4 border rounded-lg font-sans w-50 m-3 ${
            isIncome ? "border-teal-500" : "border-red-500"
          }`;

          transactionItem.innerHTML = `
            <div>
              <div class="text-lg font-bold text-black">${trx.user}</div>
              <div class="text-sm text-gray-500">${new Date(trx.created_at).toLocaleDateString("id-ID")}</div>
            </div>
            <div class="text-lg font-bold ${isIncome ? "text-teal-500" : "text-red-600"}">
              ${isIncome ? "+" : "-"}Rp. ${amount.toLocaleString()}
            </div>
          `;

          transactionList.appendChild(transactionItem);
        });

        document.getElementById("total-balance").innerText = `Rp. ${totalBalance.toLocaleString()}`;
        document.getElementById("total-income").innerText = `Rp. ${totalIncome.toLocaleString()}`;
        document.getElementById("total-expenses").innerText = `Rp. ${totalExpenses.toLocaleString()}`;
      } catch (error) {
        console.error("Error fetching transactions:", error);
      }
    }

    fetchUser();
    fetchTransactions();
  </script>
</x-app_user>
