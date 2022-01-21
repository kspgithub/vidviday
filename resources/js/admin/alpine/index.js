import translatable from './translatable';
import translations from './translations';
import publishable from './publishable';
import tiny from './tiny';
import singleFileUpload from './single-file-upload';
import tourPlaces from './tour-places';
import tourFinance from './tour-finance';
import menuEditor from './menu-editor';
import menuList from './menu-list';
import menuItem from './menu-item';
import crmClients from './crm-clients';
import crmClient from './crm-client';
import crmSchedules from './crm-schedules';
import crmScheduleRow from './crm-schedule-row';
import crmScheduleItem from './crm-schedule-item';
import crmOrderBasic from './crm-order-basic';
import crmOrderParticipants from './crm-order-participants';
import crmOrderAgency from './crm-order-agency';
import crmOrderFinance from './crm-order-finance';
import crmOrderOther from './crm-order-other';
import crmOrderList from './crm-order-list';
import crmOrderCollective from './crm-order-collective';
import crmOrderCorporate from './crm-order-corporate';
import crmOrderBadge from './crm-order-badge';
import crmCorporateBasic from './crm-corporate-basic';
import crmEmail from './crm-email';

document.addEventListener('alpine:init', () => {

    Alpine.store('crmEmail', crmEmail);

    Alpine.data('translatable', translatable);
    Alpine.data('translations', translations);
    Alpine.data('publishable', publishable);
    Alpine.data('tiny', tiny);
    Alpine.data('singleFileUpload', singleFileUpload);
    Alpine.data('tourPlaces', tourPlaces);
    Alpine.data('menuEditor', menuEditor);
    Alpine.data('menuList', menuList);
    Alpine.data('menuItem', menuItem);
    Alpine.data('tourFinance', tourFinance);
    Alpine.data('crmClients', crmClients);
    Alpine.data('crmClient', crmClient);
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
    Alpine.data('crmCorporateBasic', crmCorporateBasic);

})
