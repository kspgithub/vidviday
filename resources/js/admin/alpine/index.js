import sortable from './common/sortable'
import translatable from './form/translatable'
import translations from './translations'
import publishable from './form/publishable'
import mediaLibrary from './form/media-library'
import tiny from './form/tiny'
import singleFileUpload from './form/single-file-upload'
import tourPlaces from './tour/tour-places'
import tourTickets from './tour/tour-tickets'
import tourFood from './tour/tour-food'
import tourSchedules from './tour/tour-schedules'
import tourFinance from './tour/tour-finance'
import tourLanding from './tour/tour-landing'
import menuEditor from './menu/menu-editor'
import menuList from './menu/menu-list'
import menuItem from './menu/menu-item'
import crmClients from './crm/client/crm-clients'
import crmClient from './crm/client/crm-client'
import crmClientOrders from './crm/client/crm-client-orders'
import crmSchedules from './crm/schedule/crm-schedules'
import crmScheduleRow from './crm/schedule/crm-schedule-row'
import crmScheduleItem from './crm/schedule/crm-schedule-item'
import crmOrderBasic from './crm/order/crm-order-basic'
import crmOrderCustomer from './crm/order/crm-order-customer'
import crmOrderSchedule from './crm/order/crm-order-schedule'
import crmOrderParticipants from './crm/order/crm-order-participants'
import crmOrderAgency from './crm/order/crm-order-agency'
import crmOrderFinance from './crm/order/crm-order-finance'
import crmOrderOther from './crm/order/crm-order-other'
import crmOrderList from './crm/order/crm-order-list'
import crmOrderCollective from './crm/order/crm-order-collective'
import crmOrderCorporate from './crm/order/crm-order-corporate'
import crmOrderAudits from './crm/order/crm-order-audits'
import crmOrderBadge from './crm/order/crm-order-badge'
import crmOrderAdditional from './crm/order/crm-order-additional'
import crmOrderAccom from './crm/order/crm-order-accom'
import crmCorporateBasic from './crm/order/crm-corporate-basic'
import crmTransportBadge from './crm/transport/crm-transport-badge'
import crmCertificateBadge from './crm/certificate/crm-certificate-badge'
import userCollective from './user/user-collective'
import user from './crm/user'
import placeList from './place/place-list'
import pageForm from './page/page-form'
import contactManagers from './contacts/managers'

import storeEmail from './stores/store-email'
import storeUser from './stores/store-user'

import mask from './directives/mask'
import datepicker from './directives/datepicker'

window.addEventListener('displayErrors', event => {
    Object.values(event.detail?.errors || {}).forEach(errors => {
        for (let error of errors) toast.error(error)
    })
})

document.addEventListener('alpine:init', () => {
    // Directives
    Alpine.directive('datepicker', datepicker)
    Alpine.directive('mask', mask)

    // Stores
    Alpine.store('crmEmail', storeEmail)
    Alpine.store('crmUser', storeUser)

    // Components
    Alpine.data('sortable', sortable)
    Alpine.data('translatable', translatable)
    Alpine.data('translations', translations)
    Alpine.data('publishable', publishable)
    Alpine.data('tiny', tiny)
    Alpine.data('singleFileUpload', singleFileUpload)
    Alpine.data('tourPlaces', tourPlaces)
    Alpine.data('tourTickets', tourTickets)
    Alpine.data('tourFood', tourFood)
    Alpine.data('tourSchedules', tourSchedules)
    Alpine.data('tourLanding', tourLanding)
    Alpine.data('menuEditor', menuEditor)
    Alpine.data('menuList', menuList)
    Alpine.data('menuItem', menuItem)
    Alpine.data('tourFinance', tourFinance)
    Alpine.data('crmClients', crmClients)
    Alpine.data('crmClient', crmClient)
    Alpine.data('crmClientOrders', crmClientOrders)
    Alpine.data('crmSchedules', crmSchedules)
    Alpine.data('crmScheduleRow', crmScheduleRow)
    Alpine.data('crmScheduleItem', crmScheduleItem)
    Alpine.data('crmOrderBasic', crmOrderBasic)
    Alpine.data('crmOrderCustomer', crmOrderCustomer)
    Alpine.data('crmOrderSchedule', crmOrderSchedule)
    Alpine.data('crmOrderParticipants', crmOrderParticipants)
    Alpine.data('crmOrderAgency', crmOrderAgency)
    Alpine.data('crmOrderFinance', crmOrderFinance)
    Alpine.data('crmOrderOther', crmOrderOther)
    Alpine.data('crmOrderList', crmOrderList)
    Alpine.data('crmOrderCollective', crmOrderCollective)
    Alpine.data('crmOrderCorporate', crmOrderCorporate)
    Alpine.data('crmOrderBadge', crmOrderBadge)
    Alpine.data('crmOrderAudits', crmOrderAudits)
    Alpine.data('crmOrderAdditional', crmOrderAdditional)
    Alpine.data('crmOrderAccom', crmOrderAccom)
    Alpine.data('crmCorporateBasic', crmCorporateBasic)
    Alpine.data('mediaLibrary', mediaLibrary)
    Alpine.data('userCollective', userCollective)
    Alpine.data('user', user)
    Alpine.data('placeList', placeList)
    Alpine.data('crmTransportBadge', crmTransportBadge)
    Alpine.data('crmCertificateBadge', crmCertificateBadge)
    Alpine.data('pageForm', pageForm)
    Alpine.data('contactManagers', contactManagers)
})
