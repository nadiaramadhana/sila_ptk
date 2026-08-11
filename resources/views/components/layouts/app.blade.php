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
  <script src="https://jsdelivr.net"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // ==========================================
      // FITUR AJAX NOTIFIKASI BARU (DITARUH DISINI)
      // ==========================================
      const notifBadge = document.getElementById("notifBadge");
      const notifItems = document.getElementById("notifItems");

      function ambilNotifikasi() {
          // Pastikan element id notifBadge dan notifItems ada di halaman (mencegah error di halaman non-login jika ada)
          if (!notifBadge || !notifItems) return;

          fetch("{{ route('notifikasi.check') }}", {
              method: "GET",
              headers: {
                  "X-Requested-With": "XMLHttpRequest",
                  "Content-Type": "application/json"
              }
          })
          .then(response => response.json())
          .then(data => {
              // Update Angka Badge Lonceng
              if (data.count > 0) {
                  notifBadge.textContent = data.count;
                  notifBadge.classList.remove("d-none");
              } else {
                  notifBadge.classList.add("d-none");
              }

              // Update List Item di dalam Dropdown
              if (data.list.length > 0) {
                  let htmlKonten = "";
                  data.list.forEach(item => {
                      htmlKonten += `
                          <div class="border-bottom">
                              <a class="dropdown-item d-flex flex-column p-3 gap-1" href="${item.url}" style="white-space: normal;">
                                  <span class="text-dark fw-medium" style="font-size: 0.825rem; line-height: 1.4;">${item.pesan}</span>
                                  <span class="text-muted" style="font-size: 0.7rem;">${item.waktu}</span>
                              </a>
                          </div>
                      `;
                  });
                  notifItems.innerHTML = htmlKonten;
              } else {
                  notifItems.innerHTML = `
                      <div class="text-center text-muted small py-4">
                          Tidak ada notifikasi baru
                      </div>
                  `;
              }
          })
          .catch(error => console.error("Gagal memuat notifikasi:", error));
      }

      // Jalankan langsung saat halaman pertama kali dibuka
      ambilNotifikasi();

      // Cek berkala secara otomatis setiap 10 detik
      setInterval(ambilNotifikasi, 10000);
      // ==========================================


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
        title: 'Yakin Ingin Menghapus Data Ini?',
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
