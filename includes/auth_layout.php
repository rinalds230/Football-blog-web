<?php
// Shared layout for login and signup. Needs: $mode ('login' or 'signup'), $error (optional).
$isLogin = $mode === 'login';
$pageTitle = $isLogin ? 'Log in' : 'Sign up';
$bodyClass = 'auth';
require __DIR__ . '/head.php';
?>
<div class="auth-wrap">
  <aside class="auth-visual pitch">
    <?= footy_brand('index.php') ?>
    <div class="auth-visual-text">
      <h2>Every table.<br><span class="grad">Every headline.</span></h2>
      <p>Follow the Premier League, LaLiga, Serie A, Bundesliga and Ligue 1 in one place.</p>
    </div>
    <div class="auth-collage" aria-hidden="true">
      <?php foreach (array_slice($LEAGUES, 0, 3) as $league): ?>
        <img src="<?= h($league['img']) ?>" alt="">
      <?php endforeach; ?>
    </div>
  </aside>

  <main class="auth-main">
    <div class="auth-mobile-brand"><?= footy_brand('index.php') ?></div>
    <form class="auth-card" method="POST">
      <h1><?= $isLogin ? 'Welcome back' : 'Create your account' ?></h1>
      <p class="muted"><?= $isLogin ? 'Log in to see the latest news and tables.' : "It's free and takes a few seconds." ?></p>

      <?php if (!empty($error)): ?>
        <p class="alert" role="alert"><?= h($error) ?></p>
      <?php endif; ?>

      <label>Username
        <input type="text" name="username" placeholder="Your username" required autocomplete="username" value="<?= h($_POST['username'] ?? '') ?>">
      </label>
      <label>Password
        <input type="password" name="password" placeholder="••••••••" required autocomplete="<?= $isLogin ? 'current-password' : 'new-password' ?>">
      </label>

      <button class="btn btn-primary btn-block btn-lg" type="submit"><?= $isLogin ? 'Log in' : 'Sign up' ?></button>

      <p class="auth-switch">
        <?php if ($isLogin): ?>
          Don't have an account? <a href="signup.php">Sign up</a>
        <?php else: ?>
          Already have an account? <a href="login.php">Log in</a>
        <?php endif; ?>
      </p>
    </form>
  </main>
</div>
</body>
</html>
