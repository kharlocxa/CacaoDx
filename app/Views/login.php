<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>CacaoDx Login</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/loginstyles.css'); ?>">
</head>
<body>
  <div class="log-in">
    <div class="div">
      <h1 class="text-wrapper-3">CacaoDx</h1>

      <!-- Login form -->
      <form action="<?= site_url('auth/login'); ?>" method="post">

        <!-- Email input -->
        <input
          type="email"
          name="email"
          class="input-field"
          placeholder="Email"
          required
        >

        <!-- Password input -->
        <input
          type="password"
          name="password"
          class="input-field"
          placeholder="Password"
          required
        >

        <!-- Login button -->
        <button type="submit" class="btn">Log-In</button>

      </form>

      <!-- Signup button (redirects to register page) -->
      <form action="<?= site_url('auth/registration'); ?>" method="get">
        <button class="btn secondary">Sign-Up</button>
      </form>

    </div>
  </div>
</body>
</html>
