<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <h1 class="text-xl font-bold mb-6 text-center text-gray-800">QR Code Generator</h1>

        <form method="POST" action="{{ route('link.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Input URL --}}
            <div class="mb-4">
                <label for="link" class="block text-gray-700 font-medium mb-1">Masukkan URL</label>
                <input type="text" name="link" id="link" value="{{ old('link') }}"
                    placeholder="https://example.com"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            {{-- Input Logo --}}
            <div class="mb-12">
                <label for="logo" class="block text-gray-700 font-medium mb-1">Logo (opsional)</label>
                <input type="file" name="logo" id="logo" />
            </div>

            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition">
                Generate QR Code
            </button>
        </form>


        @if (session('qr'))
            <div class="mt-6 text-center">
                <p class="font-semibold mb-2">QR Code:</p>
                <img src="data:image/png;base64,{{ session('qr') }}" alt="QR Code" class="mx-auto w-48 h-48 rounded">
            </div>
        @endif
    </div>

    {{-- SweetAlert2: Success --}}
    @if (session('qr'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'QR Code berhasil dibuat!',
                text: 'Silakan lihat hasilnya di bawah.',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- SweetAlert2: Error --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif
</body>

</html>
