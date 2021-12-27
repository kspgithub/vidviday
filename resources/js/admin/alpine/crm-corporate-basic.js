import axios from "axios";
import tinymce from "tinymce";
import {toast} from "../../libs/toast";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";

export default ({order, statuses, includes}) => ({
    editor: null,
    statuses: statuses || [],
    includes: includes || [],
    order: order,
    data: {
        first_name: order.first_name || '',
        last_name: order.last_name || '',
        phone: order.phone || '',
        email: order.email || '',
        viber: order.viber || '',
        company: order.company || '',
        start_date: order.start_date || '',
        start_place: order.start_place || '',
        end_date: order.end_date || '',
        end_place: order.end_place || '',
        program_type: order.program_type || 0,
        tour_plan: order.tour_plan || '',
        tour_id: order.tour_id || null,
        places: order.places || null,
        children: order.children || false,
        children_older: order.children_older || 0,
        children_young: order.children_young || 0,
        group_comment: order.group_comment || '',
        program_comment: order.program_comment || '',
        price_include: order.price_include || [],
    },
    status: order.status || 'new',
    notifySend: false,
    notifyEmail: order.email,
    notifyMessage: '',
    tour: order.tour || null,
    init() {
        setTimeout(() => {
            const tourSelectBox = document.getElementById('tourSelectBox');
            jQuery(tourSelectBox).select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: '/api/tours/select-box',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page || 1,
                            limit: 20
                        };
                    },
                }
            });
            jQuery(tourSelectBox).on('select2:select', (e) => {
                this.data.tour_id = e.params.data.id;
            })

            this.$watch('notifyEmail', (value) => {
                if (value) {
                    this.editor = tinymce.init({
                        selector: '#notify-message',
                        language: 'uk',

                        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | ' +
                            'bullist numlist outdent indent ' +
                            'emoticons ',
                        menubar: '',
                        setup: (editor) => {
                            editor.on('Input', (evt) => {
                                this.notifyMessage = editor.getContent();
                            })
                            editor.on('Change', (evt) => {
                                this.notifyMessage = editor.getContent();
                            })
                        }
                        //content_css: 'css/content.css'
                    });
                } else {
                    if (this.editor) {
                        this.editor.destroy();

                    }
                }
            })

            const startPicker = flatpickr(this.$refs.startDateRef, {
                locale: Ukrainian,
                dateFormat: 'd.m.Y',

            });

            const endPicker = flatpickr(this.$refs.endDateRef, {
                locale: Ukrainian,
                dateFormat: 'd.m.Y',
            });
        }, 200);

    },
    get basicModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-basic-modal'));
    },
    get clientName() {
        return this.data.last_name + ' ' + this.data.first_name;
    },
    get statusText() {
        const statusOption = this.statuses.find(s => s.value === this.status);
        return statusOption ? statusOption.text : '-';
    },
    get totalPlaces() {
        let total = this.data.places;
        if (this.data.children) {
            total += this.data.children_young;
            total += this.data.children_older;
        }
        return total;
    },
    get includeTitle() {
        return this.includes.filter(inc => this.data.price_include.indexOf(inc.value) !== -1)
            .map(inc => inc.text).join(', ');
    },
    resetData() {
        this.data = {
            first_name: this.order.first_name || '',
            last_name: this.order.last_name || '',
            phone: this.order.phone || '',
            email: this.order.email || '',
            viber: this.order.viber || '',
            company: this.order.company || '',
            start_date: this.order.start_date || '',
            start_place: this.order.start_place || '',
            end_date: this.order.end_date || '',
            end_place: this.order.end_place || '',
            program_type: this.order.program_type || 0,
            tour_plan: this.order.tour_plan || '',
            tour_id: this.order.tour_id || null,
            places: this.order.places || null,
            children: this.order.children || false,
            children_older: this.order.children_older || 0,
            children_young: this.order.children_young || 0,
            group_comment: this.order.group_comment || '',
            program_comment: this.order.program_comment || '',
            price_include: this.order.price_include || [],
        }
        this.status = this.order.status;
    },

    updateOrder() {
        axios.patch(`/admin/order/${this.order.id}`, this.data)
            .then(({data: response}) => {
                this.basicModal.hide();
                this.order = response.model;
                this.status = response.model.status;
                this.tour = response.model.tour || null;
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    },
    updateOrderStatus() {
        axios.patch(`/admin/order/${this.order.id}/update-status`, {
            status: this.status,
            notifySend: this.notifySend,
            notifyEmail: this.notifyEmail,
            notifyMessage: this.notifyMessage,
        })
            .then(({data: response}) => {
                toast.success(response.message);
                this.status = response.model.status;

            })
            .catch(error => {
                console.log(error);
            })
    },
});
