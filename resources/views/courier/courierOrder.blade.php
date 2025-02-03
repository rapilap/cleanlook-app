<x-app_user title="Order" bodyClass="py-3">
    <div class="">
        <div class="drop-shadow-md border-b-2 text-center text-lg">{{ $order->id }}</div>

        <div class="text-center items-center p-3 drop-shadow-md border-b-2">
            Pengambilan
            <div class="flex flex-col text-start">
                {{ $order->user->name }}
                <div class="flex flex-row justify-between items-center">
                    <div>{{ $order->user->phone ?? 'Tidak Ada' }}</div>
                    <button class="p-2 hover:bg-slate-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path d="M22.707 16.293l-4-4a1 1 0 0 0-1.414 0l-3 3a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414l3-3a1 1 0 0 0 0-1.414l-4-4A1 1 0 0 0 4 2H2a1 1 0 0 0-1 1C1 11.837 9.163 20 18 20a1 1 0 0 0 1-1v-2a1 1 0 0 0-.293-.707z"/>
                        </svg>
                    </button>
                </div>
                {{ $order->address }}
            </div>
        </div>

        <div class="drop-shadow-md">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6305.92234690333!2d107.6138803237451!3d-6.889502028580156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6f8aa08188b%3A0x632d24e6061e8903!2sUniversitas%20Komputer%20Indonesia!5e1!3m2!1sen!2sid!4v1736306642798!5m2!1sen!2sid" 
            class="w-full h-52 border drop-shadow-md" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="text-center pt-3 px-3 border-b-2 drop-shadow-md">
            Tujuan
            <div class="flex flex-row text-start justify-between pb-3">
                {{ $order->landfill->name }}
                <div>
                    {{ $order->landfill->address }}
                </div>
            </div>
        </div>

        <form id="updateStatusForm" action="{{ route('order.status', $order->id) }}" method="POST" class="text-center pt-3 px-3">
            @csrf
            @method("PATCH")
            <input type="hidden" name="status" id="statusField" value="{{ $order->status }}">
        
            <x-button variant="secondary" class="w-full" id="statusButton">
                {{ $order->status == 'pickup' ? 'Konfirmasi Pengambilan' : ($order->status == 'deliver' ? 'Selesaikan' : 'Selesai') }}
            </x-button>
        </form>
    </div>
</x-app_user>
<script>
    document.getElementById("statusButton").addEventListener("click", function(event) {
        event.preventDefault();
        let currentStatus = document.getElementById("statusField").value;

        if (currentStatus === "pickup") {
            document.getElementById("statusField").value = "deliver";
        } else if (currentStatus === "deliver") {
            document.getElementById("statusField").value = "completed";
        }

        document.getElementById("updateStatusForm").submit();
    });
</script>