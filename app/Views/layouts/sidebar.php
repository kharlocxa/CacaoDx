<?php $current_page = service('uri')->getSegment(1); ?>

<nav class="sidebar">
  <div class="profile">
    <img src="https://via.placeholder.com/40" alt="User" class="profile-pic">
    <span class="username">Aiden Max</span>
  </div>

  <ul class="menu">
    <li class="<?= ($current_page == 'dashboard') ? 'active' : '' ?>">
      <a href="<?= site_url('dashboard'); ?>">Home</a>
    </li>
    <li class="<?= ($current_page == 'users') ? 'active' : '' ?>">
      <a href="<?= site_url('users'); ?>">Images</a>
    </li>
    <li class="<?= ($current_page == 'logs') ? 'active' : '' ?>">
      <a href="<?= site_url('logs'); ?>">Users</a>
    </li>
    <li class="<?= ($current_page == 'logs') ? 'active' : '' ?>">
      <a href="<?= site_url('logs'); ?>">Logs</a>
    </li>
    <li class="<?= ($current_page == 'logs') ? 'active' : '' ?>">
      <a href="<?= site_url('logs'); ?>">Disease</a>
    </li>
  </ul>

  <button class="logout">Logout</button>
</nav>
