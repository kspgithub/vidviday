import axios from "axios";

export default () => ({
    selectedPage: null,

    init() {

    },

    loadPageData() {
        axios.get('/api/page', {
            params: {
                page: this.selectedPage,
            },
        })
        .then(response => {
            const pageName = response.data.title;
            const pageSlug = response.data.slug;

            $('input#title-uk').val(pageName.uk);
            $('input#title-ru').val(pageName.ru || pageName.uk);
            $('input#title-en').val(pageName.en || pageName.uk);
            $('input#title-pl').val(pageName.pl || pageName.uk);

            $('input#slug-uk').val(pageSlug.uk);
            $('input#slug-ru').val(pageSlug.ru || pageSlug.uk);
            $('input#slug-en').val(pageSlug.en || pageSlug.uk);
            $('input#slug-pl').val(pageSlug.pl || pageSlug.uk);
        })
        .catch(error => {
            console.error(error);
        });
    }

})

