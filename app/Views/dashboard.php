<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard</title>

  <!-- Your CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/styles/dashboardstyles.css'); ?>">

  <!-- Font Awesome (icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php
  // Defensive defaults if controller didn't pass values:
  $userName = $userName ?? (session()->get('first_name') . ' ' . session()->get('last_name'));
  $totalUsers = $totalUsers ?? 0;
  $totalDiagnosis = $totalDiagnosis ?? 0;
  $totalDiseases = $totalDiseases ?? 0;
?>

<div class="page-wrapper">

  <!-- sidebar include -->
  <?= $this->include('layouts/sidebar'); ?>

  <!-- overlay -->
  <div id="overlay" class="overlay" tabindex="-1" aria-hidden="true"></div>

  <!-- main content -->
  <main id="mainContent" class="main-content" role="main">
    <header class="header">
      <!-- Toggle button -->
      <button id="sidebarToggle" class="sidebar-toggle" aria-controls="sidebar" aria-expanded="true" title="Toggle menu">
        <i class="fas fa-bars" aria-hidden="true"></i>
      </button>

      <!-- Page Title -->
      <h1 class="page-title">
        <?php
          $current_page = service('uri')->getSegment(1);
          switch ($current_page) {
            case 'dashboard': echo "Home"; break;
            case 'images': echo "Images"; break;
            case 'users': echo "Users"; break;
            case 'activity_log': echo "Logs"; break;
            case 'calendar': echo "Calendar"; break;
            case 'disease': echo "Disease"; break;
            case 'diagnosis': echo "Diagnosis"; break;
            default: echo "Home";
          }
        ?>
      </h1>

      <!-- header right -->
      <div class="header-right">
        <div class="icons">
          <button class="icon-btn" title="Search"><i class="fas fa-search"></i></button>
          <button class="icon-btn" title="Notifications"><i class="fas fa-bell"></i></button>
        </div>
        <div class="profile-inline">
          <img src="https://via.placeholder.com/40" alt="Profile" class="profile-pic">
          <span class="username"><?= esc($userName) ?></span>
        </div>
      </div>
    </header>

    <!-- Stats -->
    <section class="stats" aria-label="Key statistics">
      <div class="card">
        <h3>Total Users</h3>
        <p><?= esc($totalUsers) ?></p>
      </div>
      <div class="card">
        <h3>Total Diagnostics</h3>
        <p><?= esc($totalDiagnosis) ?></p>
      </div>
      <div class="card">
        <h3>Total Diseases</h3>
        <p><?= esc($totalDiseases) ?></p>
      </div>
    </section>

    <!-- Content Grid -->
    <section class="content">
      <!-- Map -->
      <div class="map">
        <h3>Farm Location</h3>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Map_of_Negros_Oriental.png/640px-Map_of_Negros_Oriental.png" alt="Map">
      </div>

      <!-- Users Chart -->
      <div class="users">
  <h3>Users</h3>
  <canvas id="userChart" width="380" height="380" aria-label="Users chart" role="img"></canvas>
</div>


      <!-- New Users -->
      <div class="new-users">
        <h3>New Users</h3>
        <ul>
          <li><img src="https://i.pravatar.cc/40?img=1" alt=""><span class="name">Roselle Ehrman</span><span class="meta">Bacong</span></li>
          <li><img src="https://i.pravatar.cc/40?img=2" alt=""><span class="name">Jone Smith</span><span class="meta">Tanjay</span></li>
          <li><img src="https://i.pravatar.cc/40?img=3" alt=""><span class="name">Darron Handler</span><span class="meta">Bais</span></li>
          <li><img src="https://i.pravatar.cc/40?img=4" alt=""><span class="name">Leatrice Kulik</span><span class="meta">Bais</span></li>
        </ul>
      </div>
    </section>
  </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Behavior -->
<script>
  // Chart
  (function() {
    const ctx = document.getElementById('userChart');
    if (ctx) {
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Farmers', 'Users', 'Admins'],
          datasets: [{
            data: [50, 35, 15],
            backgroundColor: ['#e17055', '#00b894', '#d63031'],
            borderWidth: 2,
            borderColor: '#fff',
            hoverOffset: 8
          }]
        },
        options: {
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                color: '#111',
                font: { size: 13, weight: '600' }
              }
            }
          }
        }
      });
    }
  })();

  // Sidebar toggle
  (function() {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');

    function setAria(expanded) {
      toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    }
    setAria(true);

    function isMobile() {
      return window.innerWidth <= 900;
    }

    toggle.addEventListener('click', () => {
      if (isMobile()) {
        const open = sidebar.classList.toggle('open');
        overlay.classList.toggle('show', open);
        setAria(open);
        document.body.classList.toggle('no-scroll', open);
      } else {
        const collapsed = sidebar.classList.toggle('collapsed');
        setAria(!collapsed);
      }
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.remove('open');
      overlay.classList.remove('show');
      document.body.classList.remove('no-scroll');
      setAria(false);
    });

    window.addEventListener('resize', () => {
      if (!isMobile()) {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
        document.body.classList.remove('no-scroll');
      }
    });
  })();
</script>
</body>
</html>
