<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List Rachel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
</head>
<body class="flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('/images/bglogin.png');">

<div class="form-container"> 
    <div class="flex flex-col items-center w-80 text-black">
        <h2 class="text-3xl font-bold text-center mb-4">Register</h2>

        <form action="{{ route('register.post') }}" method="POST" class="flex flex-col space-y-3 w-full">
            @csrf
            <input type="text" name="username" placeholder="Username" 
                class="w-full input-rounded text-black placeholder-white-300 focus:ring-2">

            <input type="email" name="email" placeholder="Email" 
                class="w-full input-rounded text-black placeholder-white-300 focus:ring-2">

            <input type="password" name="password" placeholder="Password" 
                class="w-full input-rounded text-black placeholder-white-300 focus:ring-2">

            <button type="submit" class="btn-register bg-purple-500 hover:bg-purple-600 text-white rounded mx-auto block">Register</button>

            <p class="text-center">
                <a href="{{ route('login') }}" class="text-purple-400 hover:underline">Login if you already have an account</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
