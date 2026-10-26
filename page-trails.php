<?php
/* Template Name: Trails Test Page */
get_header();
?>
<div class="top-sticky-contact">
  <span>Contact Us:</span>
  <a href="https://wa.me/" class="contact-whatsapp" target="_blank" rel="noopener noreferrer"><strong>WhatsApp</strong></a>
  <a href="https://line.me/" class="contact-line" target="_blank" rel="noopener noreferrer"><strong>LINE</strong></a>
</div>

<header class="site-header-trails">
  <h1>Tropic Hiking Trails</h1>
  <p>Find your next trail with MyRehat</p>
  <input id="main-search" type="text" placeholder="Search homepage...">
</header>

<div class="trails-promo">
  <strong>Limited offer:</strong> 20% off all guided hikes this month.
</div>

<main class="trails-main">
  <div class="trails-search-row">
    <input id="search-box" type="text" placeholder="Search trails...">
    <select id="category">
      <option value="all">All categories</option>
      <option value="mountain">Mountain</option>
      <option value="beach">Beach</option>
      <option value="forest">Forest</option>
    </select>
  </div>
  <p id="trails-no-results" hidden>No trails found.</p>

  <div class="trails-cards">
    <article class="trail-card" data-category="mountain">
      <h3>Mount Rinjani Sunrise</h3>
      <p>2-day guided summit trek, Lombok.</p>
      <span class="price">RM 350 / pax</span>
    </article>
    <article class="trail-card" data-category="beach">
      <h3>Pulau Perhentian Coastal Walk</h3>
      <p>Easy coastal trail, Terengganu.</p>
      <span class="price">RM 120 / pax</span>
    </article>
    <article class="trail-card" data-category="forest">
      <h3>Taman Negara Canopy Trail</h3>
      <p>Rainforest walk, Pahang.</p>
      <span class="price">RM 180 / pax</span>
    </article>
    <article class="trail-card" data-category="mountain">
      <h3>Mount Kinabalu Base Trek</h3>
      <p>Highland trek, Sabah.</p>
      <span class="price">RM 420 / pax</span>
    </article>
    <article class="trail-card" data-category="beach">
      <h3>Langkawi Sunset Ridge</h3>
      <p>Evening ridge walk, Kedah.</p>
      <span class="price">RM 95 / pax</span>
    </article>
    <article class="trail-card" data-category="forest">
      <h3>Belum Mossy Forest</h3>
      <p>Misty forest trail, Perak.</p>
      <span class="price">RM 150 / pax</span>
    </article>
  </div>

  <section class="trails-booking">
    <h2><?php echo esc_html( myrehat_test_booking_title() ); ?></h2>
    <form id="booking-form">
      <?php wp_nonce_field( 'trails_booking_action', 'trails_booking_nonce' ); ?>
      <input type="hidden" name="trails_booking" value="1">
      <label>Name <input type="text" name="name" required></label>
      <label>Date <input type="date" name="date" required></label>
      <div class="form-row form-nomad">
        <span class="label-title">Digital Nomad:</span>
        <label><input type="radio" name="digital_nomad" value="Ya" required> Ya</label>
        <label><input type="radio" name="digital_nomad" value="Tidak" required> Tidak</label>
      </div>
      <div class="form-row form-plan">
        <span class="label-title">Package Plan:</span>
        <label><input type="radio" name="pricing_plan" value="Daily" required> Daily</label>
        <label><input type="radio" name="pricing_plan" value="Monthly" required> Monthly</label>
      </div>
      <label class="form-terms">
        <input type="checkbox" name="host_terms" value="1" required> I agree to the Host Terms
      </label>
      <p id="trails-total">Total: -</p>
      <button type="submit">Request booking</button>
    </form>
    <div id="trails-confirmation" hidden></div>
  </section>
</main>

<footer class="trails-footer">
  <nav>
    <a href="#">FAQ</a>
    <a href="#">Contact Us</a>
    <a href="#">PDPA</a>
    <a href="#">Privacy Policy</a>
  </nav>
  <div class="trails-social-links">
    <a href="#">Facebook</a>
    <a href="#">LinkedIn</a>
    <a href="#">IG</a>
    <a href="#">TikTok</a>
    <a href="#">YouTube</a>
  </div>
  <p>&copy; 2026 MyRehat</p>
</footer>
<?php get_footer(); ?>
