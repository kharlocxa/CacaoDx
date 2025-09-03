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
      <!-- ✅ Keep only one button here -->
      <button class="add-btn" onclick="openModal()">+ Add Disease</button>
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

  <!-- ✅ Modal (only one copy) -->
  <div id="diseaseModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3>Add New Disease</h3>
      <form action="<?= site_url('disease/store') ?>" method="post">
        <label for="name">Disease Name</label>
        <input type="text" name="name" required />

        <label for="type">Type</label>
        <select name="type" required>
          <option value="">-- Select Type --</option>
          <option value="Fungal">Fungal</option>
          <option value="Bacterial">Bacterial</option>
          <option value="Viral">Viral</option>
        </select>

        <label for="cause">Cause</label>
        <input type="text" name="cause" required />

        <label for="plant_part">Plant Part</label>
        <select name="plant_part" required>
          <option value="">-- Select Plant Part --</option>
          <option value="Leaf">Leaf</option>
          <option value="Stem">Stem</option>
          <option value="Pod">Pod</option>
        </select>

        <button type="submit" class="button-large">Save</button>
      </form>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById("diseaseModal").style.display = "flex";
    }
    function closeModal() {
      document.getElementById("diseaseModal").style.display = "none";
    }
    window.onclick = function(event) {
      let modal = document.getElementById("diseaseModal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>
</html>
