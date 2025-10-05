<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'School Portal') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-neutral-800 to-neutral-950 mx-4 flex items-center justify-center font-sans">

    <div class="text-center p-8 bg-white rounded-3xl shadow-xl max-w-md w-full">
        <!-- School Logo -->
        <div class="flex justify-center mb-6">
            <div class="p-4 rounded-full bg-neutral-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><path d="M7.063 2.699c.895.067 1.7.067 2.596 0c.081-.74.081-1.41 0-2.149a17 17 0 0 0-2.596 0a9.5 9.5 0 0 0 0 2.149M3.742 8.047c-.748.017-1.215.04-1.981.068c-.561.021-1.036.426-1.112.979c-.199 1.459-.199 1.862 0 3.321c.076.553.55.958 1.112.979c3.78.141 6.697.141 10.478 0c.561-.022 1.036-.426 1.111-.979c.2-1.459.2-1.862 0-3.321c-.075-.553-.55-.958-1.11-.979c-.767-.028-1.23-.051-1.978-.068a46 46 0 0 0-.057-.942C10.027 3.35 3.978 3.34 3.8 7.099q-.034.487-.057.948m3.259-6.422v2.66M3.764 7.696v5.762M7 11.259V13.5m3.236-5.804v5.762"/><path d="M7 8.592c.763 0 1.192-.427 1.192-1.185S7.762 6.222 7 6.222c-.763 0-1.192.427-1.192 1.185S6.237 8.592 7 8.592"/></g></svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-neutral-800 mb-3">
            {{ config('app.name', 'Your School') }}
        </h1>

        <p class="text-neutral-600 mb-8">
            أدخلوا إلى المنصة و قوموا بإدارة مدرستكم بكل حرية
        </p>

        <!-- Dashboard Button -->
        <a href="/school_admin"
           class="inline-block px-6 py-3 text-lg font-medium text-white bg-neutral-600 rounded-full shadow-md hover:bg-neutral-700 transition-all duration-300">
            الدخول إلى المنصة
        </a>
    </div>

</body>
</html>
