import axios from 'axios'
import { toast } from '../../../../libs/toast'
import tinymce from 'tinymce'
import flatpickr from 'flatpickr'
import { Ukrainian } from 'flatpickr/dist/l10n/uk'

export default params => ({
    order: params.order || {},
    attributes: params.attributes || [],
    attributeIds: [],
    editableIds: [],
    schedule: params.order,
    init() {
        this.loadSchedules()
    },
    getValue(attribute) {
        return (
            attribute.value ||
            (
                attribute.options?.find(o => o.value === this.schedule[attribute.key]) || {
                    text: this.schedule[attribute.key],
                }
            ).text
        )
    },
    initTourSelect() {
        setTimeout(() => {
            const tourSelectBox = document.getElementsByName('tour_id')
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
                if (e.params.data.id !== this.order.schedule_id) {
                    this.schedule.schedule_id = 0
                }

                this.schedule.tour_id = e.params.data.id
                let tourAttribute = this.attributes.find(a => a.key === 'tour_id')
                tourAttribute.options = [
                    {
                        value: e.params.data.id,
                        text: e.params.data.text,
                    },
                ]
                let option = tourAttribute.options.find(o => o.value === this.schedule.tour_id) || {
                    text: this.schedule.tour_id,
                }
                tourAttribute.value = option.text

                this.loadSchedules()
            })
        }, 200)
    },
    isEditable(id) {
        // console.log(id)
        return this.editableIds.indexOf(id) > -1
    },
    editAttribute(id) {
        if (!this.isEditable(id)) {
            this.editableIds.push(id)
            this.schedule[id] = this.order[id] || ''

            if (id === 'tour_id') {
                this.initTourSelect()
            }
        }
    },
    saveAttribute(id) {
        // console.log('saveAttribute', id)
        this.updateAttribute(id, this.schedule[id]).then(() => {
            if (this.isEditable(id)) {
                this.editableIds.splice(this.editableIds.indexOf(id))
            }
        })
    },
    cancelAttribute(id) {
        // console.log('cancelAttribute', id)
        if (this.isEditable(id)) {
            this.editableIds.splice(this.editableIds.indexOf(id))
        }
        this.schedule[id] = this.order[id]
    },

    loadSchedules() {
        if (this.schedule.tour_id) {
            axios.get(`/api/tours/${this.schedule.tour_id}/all-schedules`).then(response => {
                let scheduleAttribute = this.attributes.find(a => a.key === 'schedule_id')
                //
                // for(let schedule of response.data) {
                //     let option = scheduleAttribute.options.find(o => o.value === schedule.id) || {text: scheduleAttribute.value || this.schedule.schedule_id}
                //
                //     if(option)
                //
                // }

                const options = response.data.map(s => ({
                    value: s.id,
                    text: s.start_title,
                }))
                let mergedOptions = []
                if (this.schedule.schedule_id === 0) {
                    mergedOptions = [...options]
                } else {
                    mergedOptions = [...scheduleAttribute.options, ...options]
                }
                scheduleAttribute.options = [...new Map(mergedOptions.map(item => [item['value'], item])).values()]

                let option =
                    scheduleAttribute.options.find(o => o.value === this.schedule.schedule_id) ||
                    (this.schedule.schedule_id === 0 ? options.shift() : { text: this.schedule.schedule_id })
                this.schedule.schedule_id = option.value || option.text
                scheduleAttribute.value = option.text
            })
        }
    },

    updateAttribute(id, value) {
        return axios
            .patch(`/admin/order/${this.order.id}`, this.schedule /*{[id]: value}*/)
            .then(({ data: response }) => {
                this.order = response.model
                toast.success(response.message)
            })
            .catch(error => {
                console.log(error)
            })
    },
})
