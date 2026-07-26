<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Honor - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .login-left {
            background: linear-gradient(135deg, #0d6efd, #4e8cff);
            color: white;
            border-radius: 15px 0 0 15px;
        }

        .login-left h2 {
            font-weight: 700;
        }

        .form-control {
            height: 48px;
        }

        .btn-login {
            height: 48px;
            font-weight: 600;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-lg-9">

                <div class="card login-card">

                    <div class="row g-0">

                        <div class="col-lg-5 d-none d-lg-flex login-left align-items-center">

                            <div class="p-5">

                                <h2>Smart Honor</h2>

                                <p class="mt-3 mb-0">
                                    Sistem Informasi Honor Dosen
                                </p>

                            </div>

                        </div>

                        <div class="col-lg-7">

                            <div class="card-body p-5">

                                <h3 class="fw-bold">
                                    Login
                                </h3>

                                <p class="text-muted mb-4">
                                    Silakan login menggunakan akun Anda.
                                </p>

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login.process') }}">

                                    @csrf

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Username
                                        </label>

                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" autofocus>

                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="mb-4">

                                        <label class="form-label">
                                            Password
                                        </label>

                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <button class="btn btn-primary w-100 btn-login">

                                        Login

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
