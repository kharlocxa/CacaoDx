<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Users</title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/styles/userstyles.css'); ?>">

  <!-- Font Awesome -->
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
      <h1 class="page-title">Users</h1>

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

    <!-- Main Section -->
    <section class="user-section" aria-label="Users Management">
      <div class="section-header">
        <h2>Manage Users</h2>
        <button class="btn add-btn"><i class="fas fa-user-plus"></i> Add User</button>
      </div>

      <!-- Table -->
      <div class="table-wrapper">
        <table class="user-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <!-- <th>Role</th> -->
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($users)): ?>
              <?php foreach ($users as $user): ?>
              <tr>
                <td><?= esc($user['id']) ?></td>
                <td><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <!-- <td><?= esc(ucfirst($user['role'])) ?></td> -->
                <td>
                  <span class="status <?= esc($user['status']) ?>">
                    <?= esc(ucfirst($user['status'])) ?>
                  </span>
                </td>
                <td class="actions">
                  <button class="btn edit"><i class="fas fa-edit"></i></button>
                  <button class="btn delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="6" class="empty">No users found</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>

<!-- JS -->
<script>
  // Sidebar toggle behavior (same as dashboard)
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
