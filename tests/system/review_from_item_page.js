var baseUrl = 'http://127.0.0.1:8000/'

casper.test.begin('Reviewing an item', function suite(test) {
  // login
  casper.start(baseUrl, function() {
    test.assertTitle('Remind | Login')
    this.fill('form#login-form', {
      email: 'johndoe_test@example.com',
      password: 'testtest'
    }, true)
    this.waitWhileSelector('form#login-form', function () {
      test.assertTitle('Remind | Spaced Repetition System')
    })
  })

  casper.echo('Review from the main page')
  casper.then(function() {
    test.assertTitle('Remind | Spaced Repetition System')
    test.assertExists('.mark-reviewed-btn')
    test.assertExists('td.edit-item')
    this.click('td.edit-item')
    this.waitWhileSelector('.mark-reviewed-btn', function () {
      test.assertTitle('Remind | Topic Summary')
    })
  })

  casper.then(function() {
    test.assertExists('#mark-reviewed-btn')
    this.click('#mark-reviewed-btn')
    this.waitWhileSelector('#mark-reviewed-btn', function () {
      this.click('#back-button')
      this.waitWhileSelector('#back-button', function () {
        test.assertTitle('Remind | Spaced Repetition System')
      })
    })
  })

  casper.then(function() {
    test.assertExists('td.edit-item')
    test.assertDoesntExist('.mark-reviewed-btn')
    test.assertSelectorHasText('td.edit-item', '1 week from now')
  })

  casper.then(function() {
    test.done()
  })

  casper.run();
})
