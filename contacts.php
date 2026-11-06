<?php
require __DIR__ . '/includes/auth.php';

$pageTitle = 'Contacts';
$activePage = 'contacts';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero pitch">
  <div class="container">
    <p class="kicker"><span class="kicker-dot"></span>Contact us</p>
    <h1>Let's talk football.</h1>
    <p class="lead">Have questions, suggestions or want to collaborate? Reach out – we read every message.</p>
  </div>
</section>

<section class="container section contact-layout">
  <div class="contact-info">
    <a class="info-card" href="mailto:info@footy.com">
      <span class="feature-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M3.5 6.5l8.5 6 8.5-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
      </span>
      <span><small>Email</small>info@footy.com</span>
    </a>
    <a class="info-card" href="tel:+37125646782">
      <span class="feature-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
      </span>
      <span><small>Phone</small>+371 25 646 782</span>
    </a>
    <div class="info-card">
      <span class="feature-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><circle cx="6" cy="12" r="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="18" cy="6" r="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="18" cy="18" r="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M8.2 10.8l7.6-3.6M8.2 13.2l7.6 3.6" stroke="currentColor" stroke-width="1.8"/></svg>
      </span>
      <span><small>Social</small>
        <span class="socials"><a href="#">Facebook</a><a href="#">Twitter</a><a href="#">Instagram</a></span>
      </span>
    </div>
  </div>

  <form class="card form-card" id="contactForm" novalidate>
    <h2>Send us a message</h2>
    <p class="muted">Fill in the form and we will get back to you.</p>
    <div class="form-row">
      <label>Your name
        <input type="text" name="name" placeholder="John Smith" required autocomplete="name">
      </label>
      <label>Your email
        <input type="email" name="email" placeholder="you@example.com" required autocomplete="email">
      </label>
    </div>
    <label>Message
      <textarea name="message" rows="6" placeholder="Write your message…" required></textarea>
    </label>
    <button class="btn btn-primary btn-block" type="submit">Send message</button>
    <p id="status" class="form-status" role="status"></p>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
