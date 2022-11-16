export default (params) => ({
    role: params.role,
    status: params.status,
    formData: {
        first_name: '',
        last_name: '',
        middle_name: '',
    },
    init() {
        this.$watch('formData', (data) => {
            if(data.first_name)
                this.formData.first_name = data.first_name.ucWords()

            if(data.last_name)
                this.formData.last_name = data.last_name.ucWords()

            if(data.middle_name)
                this.formData.middle_name = data.middle_name.ucWords()
        })
    },
});
