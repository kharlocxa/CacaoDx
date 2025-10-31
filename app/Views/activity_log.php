<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Activity Logs</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/styles/logsstyles.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php
  $userName = $userName ?? (session()->get('first_name') . ' ' . session()->get('last_name'));
?>

<div class="page-wrapper">

  <!-- Sidebar include -->
  <?= $this->include('layouts/sidebar'); ?>

  <!-- Overlay -->
  <div id="overlay" class="overlay" tabindex="-1" aria-hidden="true"></div>

  <!-- Main Content -->
  <main id="mainContent" class="main-content" role="main">
    <header class="header">
      <!-- Sidebar Toggle -->
      <button id="sidebarToggle" class="sidebar-toggle" aria-controls="sidebar" aria-expanded="true" title="Toggle menu">
        <i class="fas fa-bars" aria-hidden="true"></i>
      </button>

      <!-- Page Title -->
      <h1 class="page-title">Activity Logs</h1>

      <!-- Header Right -->
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

    <!-- Logs Section -->
    <section class="logs-section" aria-label="Activity Logs">
      <div class="section-header">
        <h2>Recent Activities</h2>
      </div>

      <div class="table-wrapper">
        <div class="header-row">
          <div class="col">ID</div>
          <div class="col">User</div>
          <div class="col">Activity</div>
          <div class="col">Date</div>
        </div>

        <?php if (!empty($logs) && is_array($logs)): ?>
          <?php foreach ($logs as $log): ?>
            <div class="navbar-row">
              <div class="col"><?= esc($log['id']) ?></div>
              <div class="col"><?= esc($log['first_name'] . ' ' . $log['last_name']) ?></div>
              <div class="col"><?= esc($log['activity']) ?></div>
              <div class="col"><?= date('F j, Y', strtotime($log['log_date'])) ?></div>
            </div>
          <?php endforeach; ?>

          <div class="pagination">
            <?= $pager->links() ?>
          </div>
        <?php else: ?>
          <div class="no-logs">No logs found.</div>
        <?php endif; ?>
      </div>
    </section>
  </main>
</div>

<!-- JS for Sidebar Toggle -->
<script>
(function() {
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('sidebarToggle');
  const overlay = document.getElementById('overlay');

  function setAria(expanded) {
    toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  }

  function isMobile() { return window.innerWidth <= 900; }

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
})();
</script>
</body>
</html>
