<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/diseasestyles.css'); ?>">
</head>
<body>

<?= $this->include('layouts/sidebar') ?>

<?php if (isset($content) && $content === 'diseases'): ?>
  <div class="diseases-list">
    <div class="header">
      <h2>Diseases</h2>
    </div>

    <div class="table">
      <div class="table-header">
        <div class="id">ID</div>
        <div class="name">Name</div>
        <div class="type">Type</div>
        <div class="cause">Cause</div>
        <div class="plant-part">Plant Part</div>
      </div>

      <?php foreach ($diseases as $disease): ?>
        <div class="table-row">
          <div class="id"><?= esc($disease['id']) ?></div>
          <div class="name"><?= esc($disease['name']) ?></div>
          <div class="plant-part"><?= esc($disease['plant_part_id']) ?></div>
          <div class="type"><?= esc($disease['type']) ?></div>
          <div class="cause"><?= esc($disease['cause']) ?></div>
        </div>
      <?php endforeach; ?>

      <?php if (isset($pager)) : ?>
        <div class="pagination">
          <?= $pager->links() ?>
        </div>
      <?php endif; ?>

      <?php else: ?>
        <div class="table-row">
          <div class="no-data">No diseases found.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>