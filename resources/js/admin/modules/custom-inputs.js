function select2Init() {
    return {
        value: null,
        init() {
            value = $refs.input.value;
            jQuery($refs.input).select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: '{{$url}}',
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
            $watch('value', () => console.log(value))
        }
    }
}


document.addEventListener('alpine:init', () => {
    Alpine.data('select2')
})
