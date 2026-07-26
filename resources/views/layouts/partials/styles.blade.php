<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Smart Honor')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            /* UBAH INI: Agar sidebar terkunci di tinggi layar */
            height: 100vh;
            max-height: 100vh;

            background: #212529;
            position: fixed;
            top: 0;
            left: 0;

            /* Tambahkan ini agar scroll muncul di dalam sidebar */
            overflow-y: auto;
            padding: 1rem;
            /* Tambahkan sedikit padding agar tidak nempel di pinggir */
        }

        /* Opsi tambahan: Agar scrollbar tidak mengganggu tampilan (opsional) */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .brand {
            color: #fff;
            text-decoration: none;
            font-size: 22px;
            font-weight: 700;
            display: block;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .8);
            border-radius: .5rem;
            margin-bottom: .25rem;
            padding: .75rem 1rem;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar .nav-link i {
            width: 20px;
        }

        .topbar {
            height: 70px;
            background: #fff;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
            /* Tambahkan ini jika navbar ingin selalu di atas saat scroll konten */
            position: sticky;
            top: 0;
            z-index: 998;
        }

        .page-content {
            padding: 25px;
            flex: 1;
        }

        .footer {
            padding: 15px 25px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            margin-top: auto;
        }
    </style>

    @stack('styles')

</head>
