import translatable from './form/translatable';
import translations from './translations';
import publishable from './form/publishable';
import mediaLibrary from './form/media-library';
import tiny from './form/tiny';
import singleFileUpload from './form/single-file-upload';
import tourPlaces from './tour/tour-places';
import tourSchedules from './tour/tour-schedules';
import tourFinance from './tour/tour-finance';
import menuEditor from './menu/menu-editor';
import menuList from './menu/menu-list';
import menuItem from './menu/menu-item';
import crmClients from './crm/client/crm-clients';
import crmClient from './crm/client/crm-client';
import crmClientOrders from './crm/client/crm-client-orders';
import crmSchedules from './crm/schedule/crm-schedules';
import crmScheduleRow from './crm/schedule/crm-schedule-row';
import crmScheduleItem from './crm/schedule/crm-schedule-item';
import crmOrderBasic from './crm/order/crm-order-basic';
import crmOrderParticipants from './crm/order/crm-order-participants';
import crmOrderAgency from './crm/order/crm-order-agency';
import crmOrderFinance from './crm/order/crm-order-finance';
import crmOrderOther from './crm/order/crm-order-other';
import crmOrderList from './crm/order/crm-order-list';
import crmOrderCollective from './crm/order/crm-order-collective';
import crmOrderCorporate from './crm/order/crm-order-corporate';
import crmOrderAudits from './crm/order/crm-order-audits';
import crmOrderBadge from './crm/order/crm-order-badge';
import crmOrderAdditional from './crm/order/crm-order-additional';
import crmCorporateBasic from './crm/order/crm-corporate-basic';
import user from './crm/user';
import storeEmail from './stores/store-email';
import storeUser from './stores/store-user';
import storeOrders from './stores/store-orders';

document.addEventListener('alpine:init', () => {

    Alpine.store('crmEmail', storeEmail);
    Alpine.store('crmUser', storeUser);
    Alpine.store('orders', storeOrders);

    Alpine.data('translatable', translatable);
    Alpine.data('translations', translations);
    Alpine.data('publishable', publishable);
    Alpine.data('tiny', tiny);
    Alpine.data('singleFileUpload', singleFileUpload);
    Alpine.data('tourPlaces', tourPlaces);
    Alpine.data('tourSchedules', tourSchedules);
    Alpine.data('menuEditor', menuEditor);
    Alpine.data('menuList', menuList);
    Alpine.data('menuItem', menuItem);
    Alpine.data('tourFinance', tourFinance);
    Alpine.data('crmClients', crmClients);
    Alpine.data('crmClient', crmClient);
    Alpine.data('crmClientOrders', crmClientOrders);
    Alpine.data('crmSchedules', crmSchedules);
    Alpine.data('crmScheduleRow', crmScheduleRow);
    Alpine.data('crmScheduleItem', crmScheduleItem);
    Alpine.data('crmOrderBasic', crmOrderBasic);
    Alpine.data('crmOrderParticipants', crmOrderParticipants);
    Alpine.data('crmOrderAgency', crmOrderAgency);
    Alpine.data('crmOrderFinance', crmOrderFinance);
    Alpine.data('crmOrderOther', crmOrderOther);
    Alpine.data('crmOrderList', crmOrderList);
    Alpine.data('crmOrderCollective', crmOrderCollective);
    Alpine.data('crmOrderCorporate', crmOrderCorporate);
    Alpine.data('crmOrderBadge', crmOrderBadge);
    Alpine.data('crmOrderAudits', crmOrderAudits);
    Alpine.data('crmOrderAdditional', crmOrderAdditional);
    Alpine.data('crmCorporateBasic', crmCorporateBasic);
    Alpine.data('mediaLibrary', mediaLibrary);
    Alpine.data('user', user);
})
