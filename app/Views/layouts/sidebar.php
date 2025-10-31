<?php
// sidebar.php
$current_page = service('uri')->getSegment(1);
?>
<aside id="sidebar" class="sidebar" role="navigation" aria-label="Main navigation">
  <ul class="menu">
  <li class="<?= ($current_page === 'dashboard') ? 'active' : '' ?>">
  <a href="<?= base_url('dashboard'); ?>">
    <i class="fa-solid fa-house"></i>
    <span class="label">Home</span>
  </a>
</li>

    <li class="<?= ($current_page === 'images') ? 'active' : '' ?>">
      <a href="<?= base_url('images'); ?>"><i class="fas fa-image"></i><span class="label">Images</span></a>
    </li>
    <li class="<?= ($current_page === 'users') ? 'active' : '' ?>">
      <a href="<?= base_url('users'); ?>"><i class="fas fa-users"></i><span class="label">Users</span></a>
    </li>
    <li class="<?= ($current_page === 'activity_log') ? 'active' : '' ?>">
      <a href="<?= base_url('activity_log'); ?>"><i class="fas fa-list"></i><span class="label">Logs</span></a>
    </li>
    <li class="<?= ($current_page === 'calendar') ? 'active' : '' ?>">
      <a href="<?= base_url('calendar'); ?>"><i class="fas fa-calendar"></i><span class="label">Calendar</span></a>
    </li>
    <li class="<?= ($current_page === 'disease') ? 'active' : '' ?>">
      <a href="<?= base_url('disease'); ?>"><i class="fas fa-virus"></i><span class="label">Disease</span></a>
    </li>
    <li class="<?= ($current_page === 'diagnosis') ? 'active' : '' ?>">
      <a href="<?= base_url('diagnosis'); ?>"><i class="fas fa-stethoscope"></i><span class="label">Diagnosis</span></a>
    </li>
  </ul>

  <!-- logout (FA6 updated icon) -->
  <a href="<?= base_url('logout'); ?>" class="logout">
    <i class="fas fa-arrow-right-from-bracket"></i>
    <span class="label">Logout</span>
  </a>
</aside>
