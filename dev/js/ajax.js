class AjaxOperation {
    stopLoadingStatus = null
    timeoutDuration = 5000
    footer = selector("footer")
    ajaxUrl = getDataset('[data-ajaxurl]', 'ajaxurl')

    messages(status, messageText = "") {
        const existingctxMessages = selector(".ctxMessages")
        const getLoading = selector(".ctxMessages.loading")
        const submitButton = selector('form button[type="submit"]')

        this.stopLoadingStatus = getLoading ? true : false
        submitButton.disabled = status === "loading" ? true : false

        if (getLoading && status === "loading") {
            return false
        }

        existingctxMessages?.remove()

        const templateMessages = status === "loading"
            ? `<div class="ctxMessages loading">
                   <div class="messageBody loadingStatus"></div>
               </div>`
            : `<div class="ctxMessages on">
                   <div class="messageBody ${status}">${messageText}</div>
                   <a class="ctxClose"></a>
               </div>`

        this.footer.insertAdjacentHTML('afterbegin', templateMessages)
        this.footer.addEventListener('click', e => this.closeClicked(e))
        this.ctxRemoved()
    }

    fetchForm(formData, getForm){
        const req = new RequestX(this.ajaxUrl)

        this.messages("loading")

        if ( this.stopLoadingStatus ) return

        req.post(formData)
            .then(data => {
                if (data?.status !== "error") {
                    this.messages("success", data?.message)
                    getForm.reset()
                } else {
                    this.messages("error", data?.message)
                }
            })
    }

    closeClicked(e) {
        if (e.target.matches(".ctxClose")) {
            e.target.closest(".ctxMessages")?.remove()
        }
    }

    ctxRemoved() {
        const ctxMessages = selector(".ctxMessages")
        ctxMessages && setTimeout(() => ctxMessages.remove(), this.timeoutDuration)
    }
}
