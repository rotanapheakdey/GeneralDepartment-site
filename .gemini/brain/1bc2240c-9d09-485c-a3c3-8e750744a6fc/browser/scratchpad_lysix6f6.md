# Verification Checklist

- [ ] Go to http://localhost/news
  - [ ] Page loads with news grid
  - [ ] Search bar and category filter visible
  - [ ] URL is /news
- [ ] Click a news article card
  - [ ] URL changes to slug format (e.g., /news/some-slug)
  - [ ] Article detail page loads
  - [ ] Social sharing buttons visible
  - [ ] "min read" indicator near category badge
- [ ] Go back to news list and test search
  - [ ] Type "ministry" in search box, press Enter/Search
  - [ ] URL updates with ?search=ministry
  - [ ] Results filter accordingly
- [ ] Capture console logs and report errors
- [ ] Take screenshots of the index and detail page

## Failure Log
The `open_browser_url` tool failed multiple times with the following error:
`failed to create browser context: failed to run playwright manager: failed to install playwright: could not install driver: could not install driver: error: got non 200 status code: 404 (404 Not Found) from https://playwright.azureedge.net/builds/driver/playwright-1.57.0-win32_x64.zip`
As a result, browser verification could not be performed.

