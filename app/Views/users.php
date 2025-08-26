<?= $this->include('layouts/header', ['title' => 'Dashboard']) ?>
<?= $this->include('layouts/sidebar') ?>

<div class="listed-users">
  <h1 class="text-wrapper">Users</h1>

  <div class="navbar header-row">
    <div class="col name">Name</div>
    <div class="col id">ID</div>
    <div class="col email">Email</div>
    <div class="col municipality">Municipality</div>
    <div class="col phone">Phone</div>
    <div class="col actions">Actions</div>
  </div>

  <?php if (!empty($users) && is_array($users)): ?>
    <?php foreach ($users as $i => $user): ?>
      <div class="navbar-row">
        <div class="col name"><?= esc($user['first_name'] . ' ' . ($user['last_name'] ?? '')) ?></div>
        <div class="col id"><?= esc($user['id'] ?? ($i + 1)) ?></div>
        <div class="col email"><?= esc($user['email'] ?? '') ?></div>
        <div class="col municipality"><?= esc($user['municipality'] ?? '') ?></div>
        <div class="col phone"><?= esc($user['phone'] ?? '') ?></div>
        <div class="col actions">
          <a href="<?= site_url('users/edit/' . ($user['id'] ?? '')) ?>" class="btn btn-edit">Edit</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="navbar-row">
      <div class="col name">Roselle Ehrman</div>
      <div class="col id">1</div>
      <div class="col email">roselle@gmail.com</div>
      <div class="col municipality">Tanjay</div>
      <div class="col phone">1254785</div>
      <div class="col actions"><a href="#" class="btn btn-edit">Edit</a></div>
    </div>

    <div class="navbar-row">
      <div class="col name">Andriana</div>
      <div class="col id">2</div>
      <div class="col email">andriana@gmail.com</div>
      <div class="col municipality">Bacong</div>
      <div class="col phone">1285685</div>
      <div class="col actions"><a href="#" class="btn btn-edit">Edit</a></div>
    </div>

    <div class="navbar-row">
      <div class="col name">Vacinzo</div>
      <div class="col id">3</div>
      <div class="col email">vacinzo@gmail.com</div>
      <div class="col municipality">Bais</div>
      <div class="col phone">1254795</div>
      <div class="col actions"><a href="#" class="btn btn-edit">Edit</a></div>
    </div>
  <?php endif; ?>
</div>
