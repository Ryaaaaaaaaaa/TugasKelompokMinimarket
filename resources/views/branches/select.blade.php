<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="fantasy">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-300">
    <div class="flex flex-col justify-center min-h-screen">
        <div class="card bg-base-100 shadow-xl mx-auto w-full max-w-5xl">
            <div class="card-body">
                <h3 class="text-lg font-bold mb-6 text-center">Silakan pilih cabang untuk melanjutkan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($branches as $branch)
                        <div class="card border rounded-2xl shadow-md mx-10 my-10">
                            <div class="card-body text-center">
                                <h4 class="card-title text-xl font-bold mb-2 mt-5">{{ $branch->name }}</h4>
                                <form method="POST" action="{{ route('branches.select.store', $branch->id) }}">
                                    @csrf
                                    <button type="submit" class="px-3 my-10 py-1 text-sm font-medium text-white bg-orange-400 rounded-lg shadow hover:bg-green-600">Pilih Cabang</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
