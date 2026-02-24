<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOVE BEAUTY - {{ $title ?? 'Dashboard' }}</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('template-admin/src/assets/images/logos/download beauty.png') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />

    <style>
        /* Gaya Sidebar Custom */
        .sidebar-nav ul .sidebar-item.selected>.sidebar-link,
        .sidebar-nav ul .sidebar-item.selected>.sidebar-link.active,
        .sidebar-nav ul .sidebar-item>.sidebar-link.active {
            background-color: #FFD6E6 !important;
            color: #0f172a !important;
            box-shadow: none !important;
        }

        .sidebar-nav ul .sidebar-item.selected>.sidebar-link i,
        .sidebar-nav ul .sidebar-item>.sidebar-link.active i {
            color: #0f172a !important;
        }

        .sidebar-nav ul .sidebar-item .sidebar-link:hover {
            background-color: #FFD1E0 !important;
            color: #0f172a !important;
        }

        .sidebar-nav ul .sidebar-item .sidebar-link {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar-nav ul .sidebar-item .sidebar-link.active {
            border-left: 3px solid #FF6B98;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('admin.layouts.sidebar')

        <div class="body-wrapper">
            @include('admin.layouts.header')

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('template-admin/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('js')

    <script>
        // Helper Notifikasi
        function showNotification(type, message) {
            const colors = {
                success: 'alert-success',
                error: 'alert-danger',
                warning: 'alert-warning',
                info: 'alert-info'
            };
            let container = document.getElementById('notifContainer');
            if (!container) {
                container = document.createElement('div');
                container.id = 'notifContainer';
                container.style.cssText = 'position:fixed; top:20px; right:20px; z-index:9999;';
                document.body.appendChild(container);
            }

            const alert = document.createElement('div');
            alert.className = `alert ${colors[type] || 'alert-info'} shadow-sm`;
            alert.style.cssText = 'min-width:260px; margin-bottom:8px; opacity:1; transition:opacity 0.4s ease;';
            alert.innerText = message;

            container.appendChild(alert);

            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 4000);
        }

        // Logika Session Tunggal (Mencegah Duplikasi)
        @if (session('success'))
            showNotification('success', "{{ session('success') }}");
        @elseif (session('error'))
            showNotification('error', "{{ session('error') }}");
        @elseif (session('status'))
            showNotification('info', "{{ session('status') }}");
        @elseif (session('message'))
            @php
                $fullMsg = (session('title') ? session('title') . ' - ' : '') . session('message');
            @endphp
            showNotification('info', "{{ $fullMsg }}");
        @endif
    </script>
</body>

</html>
