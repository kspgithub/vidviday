import {cleanPhoneNumber, formatPhoneNumber} from "../../utils/string";

export default (schedule) => ({
    request: false,
    schedule: schedule,
    tour: schedule.tour || null,
    manager: schedule.tour.manager.length ? schedule.tour.manager[0] : null,
    orders: schedule.orders || [],
    init() {
        this.$watch('schedule.guide', (val) => {
            this.updateSchedule({guide: val});
        })
        this.$watch('schedule.bus', (val) => {
            this.updateSchedule({bus: val});
        })
        this.$watch('schedule.duty_transport', (val) => {
            this.updateSchedule({duty_transport: val});
        })
        this.$watch('schedule.duty_call', (val) => {
            this.updateSchedule({duty_call: val});
        })
        this.$watch('schedule.admin_comment', (val) => {
            this.updateSchedule({admin_comment: val});
        })
        this.$watch('schedule.places', (val) => {
            this.updateSchedule({places: val});
        })
    },
    get placesAvailable() {
        return schedule.places - schedule.places_booked;
    },
    get scheduleUrl() {
        return `/admin/crm/schedules/${this.schedule.id}`;
    },
    get tourUrl() {
        return this.tour ? `/admin/tour/${this.tour.id}/edit` : '#';
    },
    get tourTitle() {
        return this.tour ? this.tour.title.uk : '';
    },
    get tourManager() {
        return this.manager ? this.manager.name : '-';
    },
    updateSchedule(params) {
        this.request = true;
        axios.patch(`/admin/crm/schedules/${this.schedule.id}`, params)
            .then(({data}) => {
                console.log(data);
                this.request = false;
            })
            .catch((err) => {

                this.request = false;
            })
    }
})
