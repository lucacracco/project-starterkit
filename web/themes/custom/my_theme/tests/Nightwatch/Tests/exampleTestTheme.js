module.exports = {
  '@tags': ['my_module'],
  before: function (browser) {
    browser
      .drupalInstall();
  },
  after: function (browser) {
    browser
      .drupalUninstall();
  },
  'Example test': (browser) => {
    browser
      .drupalRelativeURL('/')
      .waitForElementVisible('body', 1000)
      .assert.containsText('body', 'Log in')
      .end();
  },
};
