var baseUrl = 'http://127.0.0.1:8000/'

var login = function(test, that) {
  test.assertTitle('Remind | Login')
  that.fill('form#login-form', {
    email: 'johndoe_test@example.com',
    password: 'testtest'
  }, true)
}

casper.test.begin('Register and login', function suite(test) {
  casper.start(baseUrl, function() {
    test.assertTitle('Remind | Login')
    this.click('#register-link')
  })

  casper.then(function() {
    test.assertTitle('Remind | Register')
    test.assertExists('form#register-form')
    this.fill('form#register-form', {
      name: 'John',
      email: 'johndoe_test@example.com',
      password: 'testtest',
      password_confirmation: 'testtest'
    }, true)
    this.waitWhileSelector('#register-form', function () {
      test.assertTitle('Remind | Spaced Repetition System')
    })
  })

  casper.then(function() {
    test.assertTitle('Remind | Spaced Repetition System')
    test.assertTextExists('Log Out johndoe_test@example.com')
    this.click('#logout-button')
  })

  casper.then(function() {
    login(test, this)
  })

  casper.then(function() {
    this.click('#logout-button')
    test.done()
  })

  casper.run();
})
