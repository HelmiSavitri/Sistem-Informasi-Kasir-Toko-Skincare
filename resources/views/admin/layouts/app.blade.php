<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOVE BEAUTY - {{ $title ?? 'Dashboard' }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('template-admin/src/assets/images/logos/download beauty.png') }}" />
  <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />

<style>
    /* Mengubah warna background item saat aktif agar menyatu dengan sidebar (soft rose) */
    .sidebar-nav ul .sidebar-item.selected>.sidebar-link, 
    .sidebar-nav ul .sidebar-item.selected>.sidebar-link.active, 
    .sidebar-nav ul .sidebar-item>.sidebar-link.active {
        background-color: #FFD6E6 !important; /* Soft rose active background */
        color: #0f172a !important; /* Dark text for readability */
        box-shadow: none !important;
    }

    /* Mengubah warna icon saat aktif */
    .sidebar-nav ul .sidebar-item.selected>.sidebar-link i, 
    .sidebar-nav ul .sidebar-item>.sidebar-link.active i {
        color: #0f172a !important;
    }

    /* Efek Hover: Lebih hangat dari background asli sidebar */
    .sidebar-nav ul .sidebar-item .sidebar-link:hover {
        background-color: #FFD1E0 !important; /* Hover slightly deeper pink */
        color: #0f172a !important;
    }

    /* Menghilangkan garis biru atau indikator biru di samping (jika ada) */
    .sidebar-nav ul .sidebar-item .sidebar-link {
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .sidebar-nav ul .sidebar-item .sidebar-link.active {
        border-left: 3px solid #FF6B98; /* Subtle rose accent */
    }

    /* Memastikan teks menu yang tidak terpilih tetap terlihat jelas */
    .sidebar-nav ul .sidebar-item .sidebar-link span {
        color: inherit;
    }
</style>
@yield('css')
</head>


<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('admin.layouts.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('admin.layouts.header')
      <!--  Header End -->
     <div class="container-fluid">
      @yield('content')

</div>
    </div>
  </div>
  <script src="{{ asset('template-admin/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('template-admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset('template-admin/src/assets/js/app.min.js')}}"></script>
  <script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@yield('js')
<script>
    // Global non-blocking notification helper (Bahasa Indonesia)
    function showNotification(type, message) {
        console.log('showNotification called', type, message);
        const colors = { success: 'alert-success', error: 'alert-danger', warning: 'alert-warning', info: 'alert-info' };
        let container = document.getElementById('notifContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'notifContainer';
            container.style.position = 'fixed';
            container.style.top = '20px';
            container.style.right = '20px';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
        }

        const alert = document.createElement('div');
        alert.className = 'alert ' + (colors[type] || 'alert-info') + ' shadow-sm';
        alert.style.minWidth = '260px';
        alert.style.marginBottom = '8px';
        alert.style.opacity = '1';
        alert.style.transition = 'opacity 0.4s ease';
        alert.innerText = message;

        container.appendChild(alert);

        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        }, 4000);
    }

    // Show global flash messages as non-blocking notifications (Bahasa Indonesia)
    @if(session('status'))
        @php
            $sTitle = session('title') ?? '';
            $sMessage = session('message') ?? '';
            $sFull = trim(($sTitle ? $sTitle . ' - ' : '') . $sMessage);
        @endphp
        showNotification('{{ session('status') }}', {!! json_encode($sFull) !!});
    @endif

     @if(session('success'))
        showNotification('success', {!! json_encode(session('success')) !!});
     @endif

    @if(session('error'))
        showNotification('error', {!! json_encode(session('error')) !!});
    @endif

    // Debug: trigger test notification if ?test_notif=1
    try {
        if (window.location && window.location.search && window.location.search.indexOf('test_notif=1') !== -1) {
            console.log('Test notif URL detected - triggering test notification');
            showNotification('info', 'Notifikasi uji: sistem notifikasi berfungsi.');
        }
    } catch (e) {
        console.error('Error checking test_notif:', e);
    }

</script>
</body>

</html>