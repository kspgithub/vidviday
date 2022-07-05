import Sortable from 'sortablejs';

export default (options) => ({
    locale: document.documentElement.lang || 'uk',
    items: options.items || [],
    collection: options.collection || 'default',
    storeUrl: options.storeUrl || '/admin/media/upload',
    updateUrl: options.updateUrl || '/admin/media/0',
    destroyUrl: options.destroyUrl || '/admin/media/0',
    orderUrl: options.orderUrl || '/admin/media/order',
    mediaName: options.mediaName || 'media_file',
    sortable: null,
    init() {
        this.sortable = Sortable.create(this.$refs.sortableRef, {
            handle: '.handler',
            animation: 150,
            onUpdate: (/**Event*/evt) => {
                const order = this.sortable.toArray();
                // Первый элемент это template, его удаляем
                order.splice(0, 1);
                axios.post(this.orderUrl, {order: order}).catch((error) => {
                    console.log(error);
                })
                // same properties as onEnd
            },
        });
    },
    onChange(event) {
        console.log(event);
    },
    clear() {
        this.value = '';
    },
    async onFileChange() {
        const files = this.$refs.fileRef.files;

        if (files.length > 0) {
            files.forEach(file => {
                if (typeof file === 'object') {
                    this.uploadMedia(file);
                }
            });
            this.$refs.fileRef.value = null;
        }
    },
    async uploadMedia(file) {

        const reader = new FileReader();

        const newItem = {
            id: 0,
            name: file.name,
            loader: true,
            alt: {},
            title: {},
        };

        reader.onload = (pe) => {
            newItem.thumb = pe.target.result;
            this.items.push(newItem);
        }
        if (!file || !this.storeUrl || this.storeUrl === '#') return;
        reader.readAsDataURL(file);
        const formData = new FormData();
        formData.append(this.mediaName, file);
        formData.append('collection', this.collection);
        await axios.post(this.storeUrl, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(({data}) => {
            if (data.result === 'success') {
                const idx = this.items.findIndex(it => it.name === newItem.name);
                if (idx > -1) {
                    this.items[idx] = data.media;
                }
            }
        }).catch((error) => {
            newItem.error = "Upload Error";
            console.log(error);
        })
    },
    async deleteMediaItem(item) {
        if (!this.destroyUrl || this.destroyUrl === '#') return;
        axios.delete(this.destroyUrl.replace('0', item.id)).then(({data}) => {
            if (data.result === 'success') {
                const idx = this.items.findIndex(it => it.id === item.id);
                if (idx > -1) {
                    this.items.splice(idx, 1);
                }
            }
        }).catch((error) => {
            item.error = "Delete Error";
            console.log(error);
        })
    },
    updateMedia(item, data = {}) {
        if (!this.updateUrl || this.updateUrl === '#') return;
        axios.patch(this.updateUrl.replace('0', item.id), data)
            .then(({data}) => {
                if (data.result === 'success') {
                    //toast.success('Image updated');
                }
            })
            .catch((error) => {
                item.error = "Update Error";
                console.log(error);
            })
    },
    updateMediaTitle(item) {
        const title = item.title[this.locale] || '';
        this.updateMedia(item, {title: title, locale: this.locale});
    },
    updateMediaAlt(item) {
        const alt = item.alt[this.locale] || '';
        this.updateMedia(item, {alt: alt, locale: this.locale});
    },
    toggleMediaItem(item) {
        console.log(item.published)
        this.updateMedia(item, {published: !!item.published});
    },
})
