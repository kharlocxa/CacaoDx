<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Diagnosis Records</title>
  <link rel="stylesheet" href="<?= base_url('style.css') ?>" />
</head>
<body>
  <div class="diagnosis-container">
    <h1>Diagnosis Records</h1>

    <table class="diagnosis-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Disease</th>
          <th>Plant Part</th>
          <th>Notes</th>
          <th>Diagnosis Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($diagnosis) && is_array($diagnosis)): ?>
          <?php foreach ($diagnosis as $row): ?>
            <tr>
              <td><?= esc($row['id']) ?></td>
              <td><?= esc($row['user_name']) ?></td>
              <td><?= esc($row['disease_name']) ?></td>
              <td><?= esc($row['plant_part']) ?></td>
              <td><?= esc($row['notes']) ?></td>
              <td><?= esc($row['diagnosis_date']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align:center;">No records found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="pagination">
      <?= $pager->links() ?>
    </div>
  </div>
</body>
</html>
