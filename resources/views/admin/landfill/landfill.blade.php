<x-app title="Lokasi TPA" bodyClass="h-screen gap-3 p-4">
    <div class="grid grid-cols-2">
        <div class="flex flex-col gap-3">
            <div class="flex flex-row gap-3 bg-red-300">
                <input type="text" class="border-2  rounded-lg text-lg hover:border-primary" placeholder="Search">
                <x-button variant='secondary'>Tambah</x-button>
            </div>

            @foreach ($landfill as $ld)
            <div class="card py-2 px-3 w-96 shadow-xl flex flex-row justify-between">
                <div class="card-body">
                    <h1 class="card-title text-xl">{{ $ld->name }}</h1>
                    <p>{{ $ld->address }}</p>
                    <p>Kapasitas: {{ $ld->capacity }} kg</p>
                </div>
                <div class="card-actions h-full">
                    <x-button variant="secondary" class="h-full items-center">Pusatkan</x-button>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="gap-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d101662.90772537998!2d107.56075443316591!3d-6.903442379229659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e1!3m2!1sen!2sid!4v1737129065162!5m2!1sen!2sid" width="100%" height="90%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="mt-3">
                {{ $landfill->links() }}
            </div>
        </div>
    </div>
</x-app>