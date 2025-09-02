<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Images</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/imagesstyles.css'); ?>">
</head>
<body>
  <?= $this->include('layouts/sidebar') ?>

  <div class="add-user">
    <div class="upload-image">
      <div class="text-wrapper">Upload Images</div>
      <div class="frame">
        <div class="div">Media</div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
          <p class="success-msg"><?= session()->getFlashdata('success') ?></p>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
          <p class="error-msg"><?= session()->getFlashdata('error') ?></p>
        <?php endif; ?>

        <!-- Upload Form -->
        <form action="<?= site_url('images/upload') ?>" method="post" enctype="multipart/form-data">
          <div class="frame-wrapper">
            <div class="frame-2">
              <div class="icon-upload">
                <img class="vector" src="<?= base_url('assets/img/vector.svg') ?>" />
              </div>
              <p class="drop-your-image-here">
                <span class="span">Drop your image here or </span> 
                <span class="text-wrapper-2">Browse</span>
              </p>
              <input type="file" name="image" accept="image/*" required />
              <div class="text-wrapper-3">Support: JPG, JPEG, PNG</div>
            </div>
          </div>

          <button type="submit" class="button-large">
            <span class="button">Upload</span>
          </button>
        </form>

        <!-- View Uploaded Images -->
        <a href="<?= site_url('images/list') ?>" class="large-button-outline">
          <span class="button-2">View Uploaded</span>
        </a>
      </div>
    </div>
  </div>
</body>
</html>
