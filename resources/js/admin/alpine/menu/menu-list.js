import Swal from 'sweetalert2/src/sweetalert2.js';
import {toast} from "../../../libs/toast";

export default (menu) => ({
    items: menu.items,
    childDrag: false,
    dragging: null,
    dropping: null,
    onDrop(evt) {
        if (!this.childDrag && this.dragging !== null && this.dropping !== null) {
            if (this.dragging < this.dropping) {
                this.items = [...this.items.slice(0, this.dragging), ...this.items.slice(this.dragging + 1, this.dropping + 1), this.items[this.dragging], ...this.items.slice(this.dropping + 1)];
            } else {
                this.items = [...this.items.slice(0, this.dropping), this.items[this.dragging], ...this.items.slice(this.dropping, this.dragging), ...this.items.slice(this.dragging + 1)]
            }

            const sortData = this.items.map((it, idx) => {
                return {id: it.id, position: idx}
            })
            axios.post(`/admin/site-menu/sort`, {sortData: sortData})
                .then(({data}) => {
                    console.log(data.result);
                })
                .catch(err => {
                    console.log(err);
                    toast.error(err.message);
                })
        }
        this.dropping = null;
    },
    onDragEnter(index) {
        if (this.childDrag) return;
        if (index !== this.dragging) {
            this.dropping = index;
        }
    },
    onDragLeave(index) {
        if (this.childDrag) return;
        if (this.dropping === index) {
            this.dropping = null;
        }
    },
    onDragStart(index) {
        if (this.childDrag) return;
        this.dragging = index;
    },
    onDragEnd() {
        if (this.childDrag) return;
        this.dragging = null;
    },
    deleteItem(id) {
        Swal.fire({
            text: 'Ви впевнені?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Так',
            cancelButtonText: 'Відмінити'
        }).then((result) => {
            if (result.value) {
                axios.delete(`/admin/site-menu/${id}/delete`)
                    .then(({data}) => {
                        if (data.result === 'success') {
                            toast.success(data.message);
                            this.items = this.items.filter(it => it.id !== id)
                        }
                    })
                    .catch(err => {
                        console.log(err);
                        toast.error(err.message);
                    })
            }
        })
    },
    changeStatus(item) {
        axios.patch(`/admin/site-menu/${item.id}/status`)
            .then(({data}) => {
                if (data.result === 'success') {
                    toast.success(data.message);
                }
            })
            .catch(err => {
                console.log(err);
                toast.error(err.message);
            })
    }
})
