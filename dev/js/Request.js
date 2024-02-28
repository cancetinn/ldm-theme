class RequestX {
    async send(method = "GET", data = null) {
        try {
            let options = {
                method: method,
            }

            if (method === "POST" && data) {
                options.body = data
            }

            const response = await fetch(getAjaxUrl(), options)

            return await response.json()
        } catch (error) {
            const ajax = new AjaxForm()

            ajax.messages("error", "Error response!")
            console.log('Bir hata oluştu:', error.message)
        }
    }

    async get() {
        return await this.send()
    }

    async post(data) {
        return await this.send("POST", data)
    }
}
