<!-- mulai form pengajuan semi offline -->
<hr class="my-8 border-gray-300">

<div class="bg-green-50 border border-green-200 rounded-lg p-6" id="form-pengajuan">
    <h3 class="text-xl font-bold text-gray-800 mb-2">Ajukan Layanan Ini Secara Online</h3>
    <p class="text-sm text-gray-600 mb-6">
        Sudah melengkapi berkas? Silakan isi data diri dan upload hasil scan formulir beserta persyaratannya di sini.
    </p>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{route('service-submission.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="service_procedure_id" value="{{ $procedure->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_pemohon" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="number" name="nik" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp / HP</label>
            <input type="number" name="no_hp" required placeholder="Contoh: 08123456789"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Upload Berkas Persyaratan 
                <span class="text-xs text-gray-500 font-normal">(Scan Formulir, KTP, KK, dll)</span>
            </label>
            
            <input type="file" name="files[]" multiple required accept=".pdf,.jpg,.jpeg,.png"
                class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-green-50 file:text-green-700
                hover:file:bg-green-100
                border border-gray-300 rounded-lg p-2 bg-white">
            <p class="text-xs text-gray-500 mt-1">
                Bisa pilih lebih dari 1 file sekaligus (Tahan tombol CTRL saat memilih). Format: PDF/JPG.
            </p>
            @error('files') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <button type="submit" 
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow transition duration-200">
            Kirim Pengajuan
        </button>
    </form>
</div>
