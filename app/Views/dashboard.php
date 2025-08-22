<?= $this->include('layouts/header', ['title' => 'Dashboard']); ?>
<?= $this->include('layouts/sidebar'); ?>

<main class="main-content">
  <header class="header">
    <h1>Dashboard</h1>
    <div class="icons">
      <span>🔍</span>
      <span>🔔</span>
    </div>
  </header>

  <section class="stats">
    <div class="card">Total Users <p>15</p></div>
    <div class="card">Total Diagnostics <p>15</p></div>
    <div class="card">Total Diseases <p>15</p></div>
  </section>
</main>

