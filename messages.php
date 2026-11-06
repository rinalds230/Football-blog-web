<?php
require __DIR__ . '/includes/auth.php';

$db = new PDO("sqlite:messages.db");
$db->exec("CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT, email TEXT, message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

if (isset($_POST['delete_id'])) {
    $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    header("Location: messages.php");
    exit();
}

$messages = $db->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Messages';
$activePage = '';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero pitch slim">
  <div class="container">
    <p class="kicker"><span class="kicker-dot"></span>Inbox</p>
    <h1>Contact messages</h1>
    <p class="lead"><?= count($messages) ?> message<?= count($messages) === 1 ? '' : 's' ?> from the contact form.</p>
  </div>
</section>

<section class="container section">
  <?php if (!$messages): ?>
    <div class="card empty">
      <p class="empty-title">No messages yet</p>
      <p>New messages from the contact form will appear here.</p>
    </div>
  <?php else: ?>
    <div class="message-list">
      <?php foreach ($messages as $m): ?>
        <article class="card message">
          <div class="message-head">
            <span class="avatar"><?= h(strtoupper(substr($m['name'], 0, 1))) ?></span>
            <div>
              <strong><?= h($m['name']) ?></strong>
              <a href="mailto:<?= h($m['email']) ?>"><?= h($m['email']) ?></a>
            </div>
            <time><?= h($m['created_at']) ?></time>
          </div>
          <p><?= nl2br(h($m['message'])) ?></p>
          <form method="POST" data-confirm="Delete this message?">
            <input type="hidden" name="delete_id" value="<?= (int) $m['id'] ?>">
            <button class="btn btn-ghost btn-sm danger" type="submit">Delete</button>
          </form>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
