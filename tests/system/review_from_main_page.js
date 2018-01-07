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

  // check if there is an item that is due
  casper.echo('Review from the main page')
  casper.then(function() {
    test.assertTitle('Remind | Spaced Repetition System')
    this.click('.mark-reviewed-btn')
    this.waitWhileSelector('.mark-reviewed-btn', function () {
      test.assertTextExists('1 week from now')
    })
  })

  casper.then(function() {
    test.done()
  })

  casper.run();
})
