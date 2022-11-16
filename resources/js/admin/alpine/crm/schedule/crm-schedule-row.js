export default (schedule) => ({
    request: false,
    schedule: schedule,
    tour: schedule.tour || null,
    manager: schedule.manager || null,
    orders: schedule.orders || [],
    init() {

    },
    get placesAvailable() {
        return Math.max(schedule.places - schedule.places_booked, 0);
    },
    get scheduleUrl() {
        return `/admin/crm/schedules/${this.schedule.id}`;
    },
    get tourUrl() {
        return this.tour ? `/admin/tour/${this.tour.id}/schedule` : '#';
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
                //console.log(data);

                this.request = false;
            })
            .catch((err) => {

                this.request = false;
            })
    }
})
