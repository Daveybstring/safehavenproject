$('.ui.form')
  .form(
    fields: {
      name: {
        identifier : 'name',
        rules: [
          {
            type   : 'empty'
			prompt : 'entername'
          }
        ]
      }
    }
  })
;

