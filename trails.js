(function () {
  'use strict';

  var searchBox = document.getElementById('search-box');
  var mainSearch = document.getElementById('main-search');
  var categorySelect = document.getElementById('category');
  var trailCards = document.querySelectorAll('.trail-card');
  var noResultsNotice = document.getElementById('trails-no-results');
  var bookingForm = document.getElementById('booking-form');
  var totalDisplay = document.getElementById('trails-total');
  var confirmationNotice = document.getElementById('trails-confirmation');

  function filterTrails() {
    var searchBoxQuery = searchBox ? searchBox.value.trim().toLowerCase() : '';
    var mainSearchQuery = mainSearch ? mainSearch.value.trim().toLowerCase() : '';
    var selectedCategory = categorySelect ? categorySelect.value.toLowerCase() : 'all';

    var visibleCardsCount = 0;

    trailCards.forEach(function (card) {
      var cardText = card.textContent.toLowerCase();
      var cardCategory = (card.getAttribute('data-category') || '').toLowerCase();

      var matchesSearchBox = !searchBoxQuery || cardText.includes(searchBoxQuery);
      var matchesMainSearch = !mainSearchQuery || cardText.includes(mainSearchQuery);
      var matchesCategory = selectedCategory === 'all' || cardCategory === selectedCategory;

      var isVisible = matchesSearchBox && matchesMainSearch && matchesCategory;
      card.style.display = isVisible ? '' : 'none';

      if (isVisible) {
        visibleCardsCount++;
      }
    });

    if (noResultsNotice) {
      noResultsNotice.hidden = visibleCardsCount > 0;
    }
  }

  function updatePricingTotal(selectedPlan) {
    if (!totalDisplay) {
      return;
    }

    if (selectedPlan === 'Monthly') {
      totalDisplay.textContent = 'Total: RM 8.400';
    } else if (selectedPlan === 'Daily') {
      totalDisplay.textContent = 'Total: RM 350';
    }
  }

  function handleBookingSubmit(event) {
    event.preventDefault();

    if (confirmationNotice) {
      confirmationNotice.hidden = false;
      confirmationNotice.textContent = 'Your booking request has been submitted successfully.';
    }

    var formData = new FormData(bookingForm);
    var targetUrl = bookingForm.getAttribute('action') || window.location.href;

    fetch(targetUrl, {
      method: 'POST',
      body: formData
    }).catch(function () {
      // Graceful error handling without console logs
    });
  }

  function initTrailsPage() {
    if (searchBox) {
      searchBox.addEventListener('input', filterTrails);
    }
    if (mainSearch) {
      mainSearch.addEventListener('input', filterTrails);
    }
    if (categorySelect) {
      categorySelect.addEventListener('change', filterTrails);
    }

    var planRadios = document.querySelectorAll('input[name="pricing_plan"]');
    planRadios.forEach(function (radio) {
      radio.addEventListener('change', function () {
        if (radio.checked) {
          updatePricingTotal(radio.value);
        }
      });
    });

    if (bookingForm) {
      bookingForm.addEventListener('submit', handleBookingSubmit);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTrailsPage);
  } else {
    initTrailsPage();
  }
})();