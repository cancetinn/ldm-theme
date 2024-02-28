function checkValidationMessage(input) {
    const inputCheck = selector(input)

    if (!inputCheck) return

    const getInputMessage = inputCheck.dataset.message

    inputCheck.addEventListener('invalid', function() {
        this.setCustomValidity(getInputMessage)
    })

    inputCheck.addEventListener('input', function() {
        this.setCustomValidity('')
    })
}

function inputsValidationMessage(form) {
    const inputCheck = selector(form)

    if (!inputCheck) return

    const getInputs = inputCheck.querySelectorAll('input[type="text"], input[type="tel"]')
    const getInputsMessage = inputCheck.dataset.message

    getInputs.forEach(input => {
        input.addEventListener('invalid', function() {
            this.setCustomValidity(getInputsMessage)
        })

        input.addEventListener('input', function() {
            this.setCustomValidity('')
        })
    })
}
