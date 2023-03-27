@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
         <header class="text-gray-600 body-font">
          <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
              <a class="mr-5 hover:text-gray-900">First Link</a>
              <a class="mr-5 hover:text-gray-900">Second Link</a>
              <a class="mr-5 hover:text-gray-900">Third Link</a>
              <a class="hover:text-gray-900">Fourth Link</a>
            </nav>
            <a class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
              </svg>
              <span class="ml-3 text-xl">Tailblocks</span>
            </a>
            <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
                @auth
                    <a href="{{ route('support_home') }}" class="inline-flex items-left bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Dashboard</a>
                @else
                    <a href="{{ route('supportuser_login') }}" class="inline-flex items-left bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ログインorユーザー登録</a>
                @endauth
            </div>
          </div>
        </header>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('supportuser_login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ route('support_home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('supportuser_login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>
                @if (Route::has('supuser_register'))
                    <a href="{{ route('supuser_register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ユーザー登録</a>
                @endif
            @endauth
        </div>
    @endif
