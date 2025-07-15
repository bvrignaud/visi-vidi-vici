// Matomo Analytics initialization
// This file initializes Matomo tracking for the application

// Get Matomo configuration from environment variables
const matomoUrl = import.meta.env.VITE_MATOMO_INSTANCE_URL;
const matomoSiteId = import.meta.env.VITE_MATOMO_SITE_ID;

// Initialize Matomo only if configuration is available
export function initMatomo() {
  if (!matomoUrl || !matomoSiteId) {
    console.warn('Matomo configuration is missing. Analytics will not be tracked.');
    return;
  }

  // Add Matomo tracking code
  window._paq = window._paq || [];

  // Track this page view
  window._paq.push(['trackPageView']);

  // Enable link tracking
  window._paq.push(['enableLinkTracking']);

  // Set up tracker
  window._paq.push(['setTrackerUrl', `${matomoUrl}matomo.php`]);
  window._paq.push(['setSiteId', matomoSiteId]);

  // Add Matomo script to the document
  const script = document.createElement('script');
  script.async = true;
  script.defer = true;
  script.src = `${matomoUrl}matomo.js`;

  const firstScript = document.getElementsByTagName('script')[0];
  firstScript.parentNode?.insertBefore(script, firstScript);
}

// Function to track page views for SPA navigation
export function trackPageView(url?: string) {
  if (window._paq) {
    if (url) {
      window._paq.push(['setCustomUrl', url]);
    }
    window._paq.push(['trackPageView']);
  }
}
