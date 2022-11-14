import axios from 'axios'
import { toast } from '../../../../libs/toast'

export default params => ({
    order: params.order || {},
    attributes: params.attributes || [],
    attributeIds: [],
    editableIds: [],
    customer: {
        first_name: params.order.first_name || '',
        last_name: params.order.last_name || '',
        middle_name: params.order.middle_name || '',
        birthday: params.order.birthday || '',
        phone: params.order.phone || '',
        email: params.order.email || '',
        viber: params.order.viber || '',
        company: params.order.company || '',
    },
    init() {},
    isEditable(id) {
        // console.log(id)
        return this.editableIds.indexOf(id) > -1
    },
    editAttribute(id) {
        if (!this.isEditable(id)) {
            this.editableIds.push(id)
            this.customer[id] = this.order[id] || ''
        }
    },
    saveAttribute(id) {
        // console.log('saveAttribute', id)
        this.updateAttribute(id, this.customer[id]).then(() => {
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
        this.customer[id] = this.order[id]
    },

    updateAttribute(id, value) {
        return axios
            .patch(`/admin/order/${this.order.id}`, { [id]: value })
            .then(({ data: response }) => {
                this.order = response.model
                toast.success(response.message)
            })
            .catch(error => {
                console.log(error)
            })
    },
})
