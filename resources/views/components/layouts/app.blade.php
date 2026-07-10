<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SILA-PTK</title>
  <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />

  <style>
    .btn-primary {
        background-color: #0f1f3d !important;
        border: #0f1f3d;
    }

    .btn-primary:hover {
        background-color: #0f1f3d !important;
        border: #0f1f3d;
    }
  </style>
</head>

<body class="bg-light">
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <x-layout.sidebar/>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <x-layout.header/>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        {{ $slot }}
        {{-- <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div> --}}
      </div>
    </div>
  </div>
  <script src="{{ asset('template') }}/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('template') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template') }}/assets/js/sidebarmenu.js"></script>
  <script src="{{ asset('template') }}/assets/js/app.min.js"></script>
  <script src="{{ asset('template') }}/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="{{ asset('template') }}/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="{{ asset('template') }}/assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Notifikasi hasil create / edit / delete (flash message)
      @if (session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: @json(session('success')),
          timer: 2500,
          timerProgressBar: true,
          showConfirmButton: false,
        });
      @endif

      @if (session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: @json(session('error')),
          confirmButtonColor: '#0f1f3d',
        });
      @endif

      // Notifikasi error validasi form (create / edit)
      @if ($errors->any())
        Swal.fire({
          icon: 'error',
          title: 'Validasi Gagal',
          html: @json($errors->all()).join('<br>'),
          confirmButtonColor: '#0f1f3d',
        });
      @endif
    });

    // Konfirmasi sebelum hapus data
    document.addEventListener('submit', function (e) {
      var form = e.target.closest('.js-delete-form');
      if (!form) return;

      e.preventDefault();
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: form.dataset.confirmText || 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',
      }).then(function (result) {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  </script>

  @stack('scripts')
</body>

</html>
