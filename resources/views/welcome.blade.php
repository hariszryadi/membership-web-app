@extends('layouts.app')

@section('content')
@auth
    @php
        $transaction = \App\Models\Transaction::where('user_id', auth()->user()->id)->first();
        $add = ($transaction->duration*30);
    @endphp
    @if ($transaction != null)
        <div class="space-y-2">
            <div class="px-4 py-4 text-center text-yellow-800 bg-yellow-300 rounded shadow-lg shadow-yellow-500/50" role="alert">
                Paket anda akan habis pada tanggal : {{ $transaction->created_at->addDays($add) }}
            </div>
        </div>
    @endif
@endauth
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="flex items-center justify-center">
            <div class="flex flex-col justify-around">
                <div class="space-y-6">
                    @auth
                        @php
                            $products = \App\Models\Product::orderBy('id')->get();
                        @endphp
                        @foreach ($products as $item)
                            <form action="{{ route('store-transaction') }}" method="POST">
                                @csrf
                                <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ 'Paket ' . $item->category . ' (' . $item->duration . ' Bulan)' }}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">Harga : Rp{{ number_format($item->price) }}</p>
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <button type="submit" class="w-full mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Beli</button>
                                </div>
                            </form>
                        @endforeach
                    @else
                        <a href="{{ route('home') }}">
                            <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
                        </a>

                        <h1 class="text-5xl font-extrabold tracking-wider text-center text-gray-600">
                            {{ config('app.name') }}
                        </h1>

                        <ul class="list-reset">
                            <li class="inline px-4">
                                <a href="https://tailwindcss.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Tailwind CSS</a>
                            </li>
                            <li class="inline px-4">
                                <a href="https://github.com/alpinejs/alpine" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Alpine.js</a>
                            </li>
                            <li class="inline px-4">
                                <a href="https://laravel.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Laravel</a>
                            </li>
                            <li class="inline px-4">
                                <a href="https://laravel-livewire.com" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Livewire</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
