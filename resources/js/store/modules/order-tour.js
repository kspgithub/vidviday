import {calcChildDiscount} from "../../composables/useDiscount";
import {autocompleteTours, fetchTourSchedules} from "../../services/tour-service";

const DEFAULT_VALUES = {
    tour_id: 0,
    schedule_id: 0,
    conditions: 1,
    group_type: 0,
    start_date: null,
    start_place: '',
    end_date: null,
    end_place: '',
    places: 1,
    without_place: 0,
    without_place_count: 0,
    children: 0,
    children_young: 0,
    children_older: 0,
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    company: '',
    viber: '',
    discounts: [],
    isCustomerParticipant: 0,
    participants: [],
    accommodation: {
        other: 0,
        other_text: '',
    },
    participant_contacts: [],
    payment_type: 0,
    confirmation_type: 1,
    confirmation_email: '',
    confirmation_viber: '',
    confirmation_phone: '',
    act_is_needed: 0,
    comment: '',
    group_comment: '',

    program_type: 0,
    tour_plan: '',
    program_comment: '',

    offer_date: '',
    price_include: [],
}

export default {
    namespaced: true,
    state() {
        return {
            fetchSchedulesRequest: false,
            calendarOpen: false,
            popupOpen: false,
            currentStep: 1,
            additional: 1,
            tour: null,
            user: null,
            schedules: [],
            discounts: [],
            paymentTypes: [],
            confirmationTypes: [],
            rooms: [],
            formData: {...DEFAULT_VALUES}
        }
    },
    mutations: {
        INIT(state, payload) {
            state.currentStep = payload.currentStep || 1;
            state.user = payload.user || null;
            state.schedules = payload.schedules || [];
            state.discounts = payload.discounts || [];
            state.rooms = payload.rooms || [];
            state.paymentTypes = payload.paymentTypes || [];
            state.confirmationTypes = payload.confirmationTypes || [];
        },
        SET_CURRENT_STEP(state, value) {
            state.currentStep = value;
        },
        SET_ADDITIONAL(state, value) {
            state.additional = value;
        },
        SET_TOUR(state, value) {
            state.tour = value;
            Object.assign(state.formData, {tour_id: value ? value.id : 0});
        },
        SET_USER(state, value) {
            state.user = value;

            if(value.id) {
                state.formData.first_name = value.first_name
                state.formData.last_name = value.last_name
                state.formData.email = value.email
                state.formData.phone = value.mobile_phone
            }
        },
        SET_SCHEDULES_REQUEST(state, value) {
            state.fetchSchedulesRequest = value;
        },
        SET_SCHEDULES(state, value) {
            state.schedules = value;
        },
        SET_DISCOUNTS(state, value) {
            state.discounts = value;
        },
        UPDATE_FORM_DATA(state, value) {
            state.formData = {...state.formData, ...value};
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value;
        },
        SET_CALENDAR_OPEN(state, value) {
            state.calendarOpen = value;
        },
    },
    getters: {
        departureOptions: state => (text = 'start_title', value = 'id') => {
            return state.schedules.map((sch) => {
                return {
                    value: sch[value],
                    text: sch[text],
                }
            })
        },
        isTourAgent: state => state.user && state.user.type === 'tour-agent',
        // Выбранная дата проведения тура (сборная группа)
        selectedSchedule: state => state.schedules.find(sch => sch.id === state.formData.schedule_id),
        // Продолжительность тура, дней
        tourDays: (state) => state.tour ? state.tour.duration : 0,
        // Стоимость места в выбранном туре
        tourPrice: (state, getters) => getters.selectedSchedule ? getters.selectedSchedule.price : (state.tour ? state.tour.price : 0),
        // Что входит в цену корпоратива
        tourCorporateIncludes: (state, getters) => state.tour ? state.tour.corporate_includes : [],

        accommodationPrice: (state, getters) => getters.selectedSchedule ? getters.selectedSchedule.accomm_price : (state.tour ? state.tour.accomm_price : 0),
        // Скидки на детей
        childrenDiscounts: (state) => {
            console.log(state.discounts)
            return state.discounts.filter(d => (d.category === 'children_young' || d.category === 'children_older' || d.category === 'children'))
        },
        // Дети до 6 бесплатно?
        childrenYoungFree: (state, getters) => {
            return !!getters.childrenDiscounts.find(d => (d.category === 'children_young' || d.category === 'children') && d.type === 1 && d.price === 100);
        },
        // Дети до 12 бесплатно?
        childrenOlderFree: (state, getters) => {
            return !!getters.childrenDiscounts.find(d => (d.category === 'children_older' || d.category === 'children') && d.type === 1 && d.price === 100);
        },
        //Скидка для детей до 6 лет
        childrenYoungDiscount: (state, getters) => {
            let total = 0;
            if (state.formData.children && state.formData.children_young > 0 && !getters.childrenYoungFree) {
                const discount = getters.childrenDiscounts.find(d => d.category === 'children_young') ||
                    getters.childrenDiscounts.find(d => d.category === 'children');
                if (discount) {
                    let places = state.formData.children_young;
                    total = calcChildDiscount(getters.tourPrice, places, getters.tourDays, discount)
                }
            }
            return total;
        },
        // Скидка для детей 6-12 лет
        childrenOlderDiscount: (state, getters) => {
            let total = 0;
            if (state.formData.children && state.formData.children_older > 0 && !getters.childrenOlderFree) {
                const discount = getters.childrenDiscounts.find(d => d.category === 'children_older') ||
                    getters.childrenDiscounts.find(d => d.category === 'children');

                if (discount) {
                    total = calcChildDiscount(getters.tourPrice, state.formData.children_older, getters.tourDays, discount);
                }
            }
            return total;
        },
        // Всего мест вместе с детьми
        totalPlaces: (state, getters) => {
            let total = state.formData.places;
            if (state.formData.children) {
                total += state.formData.children_young;
                total += state.formData.children_older;
            }
            return total;
        },
        // Всего мест которые оплачиваются
        totalPayedPlaces: (state, getters) => {
            let total = state.formData.places;
            if (state.formData.children && !getters.childrenYoungFree) {
                total += state.formData.children_young;
            }
            if (state.formData.children && !getters.childrenOlderFree) {
                total += state.formData.children_older;
            }
            return total;
        },
        // Стоимость тура без скидок
        tourTotalPrice: (state, getters) => {
            return getters.totalPlaces * getters.tourPrice;
        },
        // Скидки на детей
        totalChildrenDiscount: (state, getters) => {
            let total = 0;
            if (state.formData.children) {
                total += getters.childrenYoungDiscount;
                total += getters.childrenOlderDiscount;
            }
            return total;
        },


        // Комиссия агента
        totalCommission: (state, getters, rootState, rootGetters) => {
            if (rootGetters["user/isTourAgent"]) {
                const price = getters.selectedSchedule ? getters.selectedSchedule.commission : (state.tour ? state.tour.commission : 0);
                return price * getters.totalPayedPlaces;
            }
            return 0;
        },
        // Доплата за размещение
        totalAccommodation: (state, getters, rootState, rootGetters) => {
            const price = getters.accommodationPrice;
            return price * (state.formData.accommodation['1o_sgl'] || 0);
        },
        // Общая стоимость со скидками
        totalTour: (state, getters) => {
            const price = getters.tourPrice;
            let total = price * getters.totalPayedPlaces;
            total -= getters.totalChildrenDiscount;
            return total;
        },
        // Общая стоимость со скидками и комиссией
        totalTourComm: (state, getters) => {
            return getters.totalTour - getters.totalCommission;
        },
        // Общая стоимость с доплатами, скидками и комиссией
        totalPrice: (state, getters) => {
            return getters.totalTourComm + getters.totalAccommodation;
        },
        maxPlaces: (state, getters) => state.formData.group_type === 1 ? 999 : (getters.selectedSchedule ? getters.selectedSchedule.places : 100),
        participants: (state) => state.formData.participants || [],
        participant_contacts: (state) => state.formData.participant_contacts || [],
        oneClickData: state => {
            return {
                first_name: state.formData.first_name,
                last_name: state.formData.last_name,
                email: state.formData.email,
                phone: state.formData.phone,
                comment: state.formData.comment,
                places: state.formData.places,
                tour_id: state.formData.tour_id,
                schedule_id: state.formData.schedule_id,
                group_type: 0,
                conditions: 1,
            }
        },
    },
    actions: {
        clearForm({commit}) {
            commit('UPDATE_FORM_DATA', {...DEFAULT_VALUES});
            commit('SET_ADDITIONAL', 1);

        },
        setStep({commit}, step) {
            commit('SET_CURRENT_STEP', step);
        },
        nextStep({commit, state}) {
            commit('SET_CURRENT_STEP', state.currentStep + 1);
        },
        prevStep({commit, state}) {
            commit('SET_CURRENT_STEP', state.currentStep - 1);
        },
        setAccommodation({commit, state}) {
            const accomm = {
                other: 0,
                other_text: '',
            };
            state.rooms.forEach(r => {
                const slug = r.slug.replace('-', '_');
                accomm[slug] = state.formData.accommodation[slug] || 0;
            })
            commit('UPDATE_FORM_DATA', {accommodation: accomm});
        },
        resetAccommodation({commit, state}) {
            const accomm = {
                other: 0,
                other_text: '',
            };
            state.rooms.forEach(r => {
                const slug = r.slug.replace('-', '_');
                accomm[slug] = 0;
            })
            commit('UPDATE_FORM_DATA', {accommodation: accomm});
        },
        setParticipants({commit, state}) {
            let total = state.formData.places;
            const items = [];

            if (state.formData.children && state.formData.children_older > 0) {
                total += state.formData.children_older;
            }
            if (state.formData.children && state.formData.children_young > 0) {
                total += state.formData.children_young;
            }
            if (state.formData.children && state.formData.without_place_count > 0) {
                total += state.formData.without_place_count;
            }
            for (let i = 0; i < total; i++) {
                if (state.formData.participants[i]) {
                    items.push(state.formData.participants[i]);
                } else {
                    items.push({
                        first_name: '',
                        last_name: '',
                        middle_name: '',
                        birthday: '',
                    });
                }
            }
            commit('UPDATE_FORM_DATA', {participants: items});
        },
        addParticipant({commit, state}) {
            const items = state.formData.participants || [];
            items.push({
                first_name: '',
                last_name: '',
                middle_name: '',
                birthday: '',
            });
            commit('UPDATE_FORM_DATA', {participants: items});
        },
        prependParticipant({commit, state}, payload) {
            const items = state.formData.participants || [];
            items.unshift(payload);
            commit('UPDATE_FORM_DATA', {participants: items});
        },
        updateParticipant({commit, state}, payload) {
            const items = state.formData.participants || [];
            items[payload.idx] = payload.data;
            commit('UPDATE_FORM_DATA', {participants: items});
        },
        deleteParticipant({commit, state}, idx) {
            const items = state.formData.participants || [];
            items.splice(idx, 1);
            commit('UPDATE_FORM_DATA', {participants: items});
        },
        addParticipantContact({commit, state}) {
            const items = state.formData.participant_contacts || [];
            items.push({
                phone:'',
                comment:'',
            });
            commit('UPDATE_FORM_DATA', {participant_contacts: items});
        },
        updateParticipantContact({commit, state}, payload) {
            const items = state.formData.participant_contacts || [];
            items[payload.idx] = payload.data;
            commit('UPDATE_FORM_DATA', {participant_contacts: items});
        },
        deleteParticipantContact({commit, state}, idx) {
            const items = state.formData.participant_contacts || [];
            items.splice(idx, 1);
            commit('UPDATE_FORM_DATA', {participant_contacts: items});
        },
        async fetchSchedules({commit}, tourId) {
            commit('SET_SCHEDULES_REQUEST', true);
            const schedules = await fetchTourSchedules(tourId);
            commit('SET_SCHEDULES', schedules || []);
            commit('UPDATE_FORM_DATA', {schedule_id: 0})
            commit('SET_SCHEDULES_REQUEST', false);
        }
    }
}
