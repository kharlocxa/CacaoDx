<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Logs</title>
    <link rel="stylesheet" href="<?= base_url('assets/styles/logsstyles.css') ?>">
  </head>
  <body>
    <div class="listed-users">
    <h1 class="text-wrapper">Logs</h1>

    <div class="header-row">
        <div class="col">ID</div>
        <div class="col">Activity</div>
        <div class="col">Date</div>
        <div class="col">User</div>
    </div>

    <?php if (!empty($logs) && is_array($logs)): ?>
        <?php foreach ($logs as $log): ?>
        <div class="navbar-row">
            <div class="col"><?= esc($log['id']) ?></div>
            <div class="col"><?= esc($log['activity']) ?></div>
            <div class="col"><?= date('F j, Y', strtotime($log['created_at'])) ?></div>
            <div class="col"><?= esc($log['first_name'] . ' ' . $log['last_name']) ?></div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-logs">No logs found.</div>
    <?php endif; ?>
    </div>
  </body>
</html>
