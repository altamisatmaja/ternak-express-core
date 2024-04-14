<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo-notext.svg') }}" />
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <title>eFarm | Login</title>
    <style>
        * {
            font-family: Montserrat;
        }
    </style>
</head>

<body>
    <div>
        @include('includes.navbar')
        <section class="bg-gray-50">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                    <img class="w-56 mr-2" src="{{ asset('logo.svg') }}" alt="logo">
                </a>
                <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="justify-center align-middle items-center flex">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-textbase md:text-2xl">
                                Silahkan mendaftar 👋
                            </h1>
                        </div>
                        <form class="form-customer-register space-y-4 md:space-y-6" action="" method="POST">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required="">
                            </div>
                            <div>
                                <label for="konfirmasi_password"
                                    class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required="">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 "
                                            >
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 ">Remember me</label>
                                    </div>
                                </div>
                                <a href="#" class="text-sm font-medium text-primary-600 hover:underline">Forgot
                                    password?</a>
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-primarybase hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign
                                in</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            function setCookie(name, value, days) {
                var expires = '';
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            $('.form-customer-register').submit(function(e) {
                e.preventDefault();
                const email = $('#email').val();
                const password = $('#password').val();
                const csrf_token = $('meta[name="csrf-token"]').attr('content')

                console.log(csrf_token);

                $.ajax({
                    url: '/customer/login',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: csrf_token,
                    },
                    success: function(data) {
                        if (!data.success) {
                            alert(data.message);
                        } else if (data.token) {
                            localStorage.setItem('token-efarm', data.token);
                            window.location.href = "/personal/account";
                        } else {
                            alert("Token tidak ditemukan dalam respon dari server.");
                        }
                    }
                })
            })
        });
    </script>
</body>

</html>
