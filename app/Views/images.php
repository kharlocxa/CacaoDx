<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Images</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/styles/dashboardstyles.css'); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php
  // Defensive defaults
  $userName = $userName ?? (session()->get('first_name') . ' ' . session()->get('last_name'));
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
      <h1 class="page-title">Images</h1>

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

    <!-- Content section -->
    <section class="content">
      <!-- Example: gallery or image cards -->
      <div class="map">
        <h3>Uploaded Images</h3>
        <img src="https://placehold.co/600x400" alt="Sample Image">
      </div>

      <div class="users">
        <h3>Another Image</h3>
        <img src="https://placehold.co/380x380" alt="Sample Image">
      </div>

      <div class="new-users">
        <h3>Image List</h3>
        <ul>
          <li><img src="https://i.pravatar.cc/40?img=5" alt=""><span class="name">Image 1</span><span class="meta">JPEG</span></li>
          <li><img src="https://i.pravatar.cc/40?img=6" alt=""><span class="name">Image 2</span><span class="meta">PNG</span></li>
        </ul>
      </div>
    </section>
  </main>
</div>

<!-- Sidebar toggle script -->
<script>
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
