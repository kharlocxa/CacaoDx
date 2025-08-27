<?php $current_page = service('uri')->getSegment(1); 

$session = session();
$fullName = session()->get('first_name') . ' ' . session()->get('last_name');

?>

<nav class="sidebar">
  <div class="profile">
    <img src="https://via.placeholder.com/40" alt="" class="profile-pic">
    <span class="username"><?= esc($fullName) ?></span>
  </div>

  <ul class="menu">
    <li class="<?= ($current_page == 'dashboard') ? 'active' : '' ?>">
      <a href="<?= site_url('dashboard'); ?>">Home</a>
    </li>
    <li class="<?= ($current_page == 'images') ? 'active' : '' ?>">
      <a href="<?= site_url('images'); ?>">Images</a>
    </li>
    <li class="<?= ($current_page == 'users') ? 'active' : '' ?>">
      <a href="<?= site_url('users'); ?>">Users</a>
    </li>
    <li class="<?= ($current_page == 'logs') ? 'active' : '' ?>">
      <a href="<?= site_url('logs'); ?>">Logs</a>
    </li>
    <li class="<?= ($current_page == 'disease') ? 'active' : '' ?>">
      <a href="<?= site_url('disease'); ?>">Disease</a>
    </li>
  </ul>

  <a href="<?= site_url('logout'); ?>" class="logout">Logout</a>
</nav>
