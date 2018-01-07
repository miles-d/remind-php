var baseUrl = 'http://127.0.0.1:8000/'

casper.test.begin('CRUD of edit item', function suite(test) {
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

  casper.then(function() {
    this.click('#add-new-topic')
  })

  // create
  casper.then(function() {
    test.assertTitle('Remind | Create Topic')
    this.fill('#create-topic-form', {
      description: 'Test Topic',
      comment: 'Test comment',
      link: 'http://example.com'
    }, true)
    this.waitWhileSelector('#create-topic-form', function () {
      test.assertTitle('Remind | Spaced Repetition System')
    })
  })

  casper.then(function() {
    test.assertExists('td.edit-item')
    test.assertSelectorHasText('td.edit-item', 'Test Topic')
    test.assertSelectorHasText('td.edit-item', 'tomorrow')
    this.click('td.edit-item')
    this.waitWhileSelector('td.edit-item', function () {
      test.assertExists('#edit-review-button')
      this.click('#edit-review-button')
    })
  })

  // edit
  casper.then(function() {
    test.assertExists('input[type=submit]')
    this.fill('#edit-review-form', {
      description: 'Edited Topic'
    }, true);
    this.waitWhileSelector('#edit-review-form', function () {
      test.assertExists('td.edit-item')
    })
  })

  casper.then(function() {
    test.assertExists('td.edit-item')
    test.assertSelectorHasText('td.edit-item', 'Edited Topic')
    test.assertSelectorDoesntHaveText('td.edit-item', 'Test Topic')
  })

  // delete
  casper.then(function() {
    this.click('td.edit-item')
    this.waitWhileSelector('td.edit-item', function () {
      test.assertExists('#delete-review-button')
      this.click('#delete-review-button')
    })
  })

  casper.then(function() {
    test.assertExists('#delete-review-form')
    this.click('#confirm-delete-review-button')
    this.waitWhileSelector('#delete-review-form', function () {
      // back to main page
      test.assertTextExists('Topics to review')
    })
  })

  casper.then(function() {
    test.assertDoesntExist('td.edit-item')
  })

  casper.then(function() {
    test.done()
  })

  casper.run();
})
