import axios from 'axios'
import tinymce from 'tinymce'
import { toast } from '../../../../libs/toast'

export default ({ order, statuses, schedules, redirect = false }) => ({
    redirect: redirect,
    editor: null,
    statuses: statuses || [],
    order: order,
    data: {
        first_name: order.first_name || '',
        last_name: order.last_name || '',
        phone: order.phone || '',
        email: order.email || '',
        viber: order.viber || '',
        company: order.company || '',
        tour_id: order.tour_id || null,
        schedule_id: order.schedule_id || null,
        places: order.places || null,
        children: order.children || false,
        children_older: order.children_older || 0,
        children_young: order.children_young || 0,
    },
    status: order.status || 'new',

    notifySend: false,
    notifyEmail: order.email,
    notifyMessage: '',
    tour: order.tour || null,
    schedule: order.schedule || null,
    schedules: schedules || [],
    init() {
        setTimeout(() => {
            const tourSelectBox = document.getElementById('tourSelectBox')
            jQuery(tourSelectBox).select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: '/api/tours/select-box',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page || 1,
                            limit: 20,
                        }
                    },
                },
            })
            jQuery(tourSelectBox).on('select2:select', e => {
                this.data.tour_id = e.params.data.id
                this.data.schedule_id = null
                this.loadSchedules()
            })

            this.$watch('notifyEmail', value => {
                if (value) {
                    this.editor = tinymce.init({
                        selector: '#notify-message',
                        language: 'uk',

                        toolbar:
                            'undo redo | bold italic | alignleft aligncenter alignright alignjustify | ' +
                            'bullist numlist outdent indent ' +
                            'emoticons ',
                        menubar: '',
                        setup: editor => {
                            editor.on('Input', evt => {
                                this.notifyMessage = editor.getContent()
                            })
                            editor.on('Change', evt => {
                                this.notifyMessage = editor.getContent()
                            })
                        },
                        //content_css: 'css/content.css'
                    })
                } else {
                    if (this.editor) {
                        this.editor.destroy()
                    }
                }
            })
        }, 200)
    },
    loadSchedules() {
        axios.get(`/api/tours/${this.data.tour_id}/all-schedules`).then(response => {
            this.schedules = response.data
        })
    },
    get clientName() {
        return this.data.last_name + ' ' + this.data.first_name
    },
    get statusText() {
        const statusOption = this.statuses.find(s => s.value === this.status)
        return statusOption ? statusOption.text : '-'
    },
    get totalPlaces() {
        let total = this.data.places
        if (this.data.children) {
            total += this.data.children_young
            total += this.data.children_older
        }
        return total
    },
    resetData() {
        this.data = {
            first_name: this.order.first_name || '',
            last_name: this.order.last_name || '',
            phone: this.order.phone || '',
            email: this.order.email || '',
            viber: this.order.viber || '',
            company: this.order.company || '',
            tour_id: this.order.tour_id || null,
            schedule_id: this.order.schedule_id || null,
            places: this.order.places || null,
            children: this.order.children || false,
            children_older: this.order.children_older || 0,
            children_young: this.order.children_young || 0,
        }
        this.status = this.order.status
    },

    updateOrder() {
        axios
            .patch(`/admin/order/${this.order.id}`, this.data)
            .then(({ data: response }) => {
                // admin/crm/schedules/38/order/5
                const oldScheduleId = this.schedule ? this.schedule.id : 0
                const newScheduleId = response.model.schedule ? response.model.schedule.id : 0
                this.order = response.model
                this.status = response.model.status
                this.tour = response.model.tour
                this.schedule = response.model.schedule

                if (this.redirect && newScheduleId > 0 && oldScheduleId !== newScheduleId) {
                    toast.success(response.message + '. Перенаправлення...')
                    document.location.href = `/admin/crm/schedules/${newScheduleId}/order/${this.order.id}`
                } else {
                    toast.success(response.message)
                }
                //console.log(response);
            })
            .catch(error => {
                console.log(error)
            })
    },
    updateOrderStatus() {
        axios
            .patch(`/admin/order/${this.order.id}/update-status`, {
                status: this.status,
                notifySend: this.notifySend,
                notifyEmail: this.notifyEmail,
                notifyMessage: this.notifyMessage,
            })
            .then(({ data: response }) => {
                toast.success(response.message)
                this.status = response.model.status
            })
            .catch(error => {
                console.log(error)
            })
    },
})
