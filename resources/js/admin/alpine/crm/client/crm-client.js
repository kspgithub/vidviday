import { cleanPhoneNumber, formatPhoneNumber } from '../../../../utils/string'

export default client => ({
    client: client,
    clientPhones: () => {
        let phones = []
        if (_.isArray(client.phone)) {
            phones = client.phone.map(p => p.replace(/[^\d]/g, ''))
        } else if (_.isObject(client.phone)) {
            for (let k in client.phone) {
                phones.push(client.phone[k].replace(/[^\d]/g, ''))
            }
        }
        phones = phones.filter((value, index, self) => self.indexOf(value) === index && value.length > 5)
        phones = phones.map(p => {
            const phone = p.startsWith('380')
                ? formatPhoneNumber(p)
                : p.startsWith('0')
                ? formatPhoneNumber('38' + p)
                : p
            const cleanPhone = cleanPhoneNumber(phone)
            return `<a href="tel:+${cleanPhone}">${phone}</a>`
        })
        return phones.join('<br>')
    },
    clientEmails: () => {
        let emails = []
        if (_.isArray(client.email)) {
            emails = client.email
        } else if (_.isObject(client.email)) {
            for (let k in client.email) {
                emails.push(client.email[k])
            }
        }
        emails = emails.map(eml => {
            return `<a href="mailto:${eml}">${eml}</a>`
        })
        return emails.join('<br>')
    },
    editUrl: () => {
        return '/admin/crm/clients/' + this.client.id
    },
})
