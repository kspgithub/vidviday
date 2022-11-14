import Swal from 'sweetalert2/src/sweetalert2.js'
import { toast } from '../../../libs/toast'

export default item => ({
    children: item.children,
    opened: false,
    chDragging: null,
    chDropping: null,
    init() {},
    toggle() {
        this.opened = !this.opened
    },

    onDropCh() {
        if (this.chDragging !== null && this.chDropping !== null) {
            if (this.chDragging < this.chDropping) {
                this.children = [
                    ...this.children.slice(0, this.chDragging),
                    ...this.children.slice(this.chDragging + 1, this.chDropping + 1),
                    this.children[this.chDragging],
                    ...this.children.slice(this.chDropping + 1),
                ]
            } else {
                this.children = [
                    ...this.children.slice(0, this.chDropping),
                    this.children[this.chDragging],
                    ...this.children.slice(this.chDropping, this.chDragging),
                    ...this.children.slice(this.chDragging + 1),
                ]
            }

            const sortData = this.children.map((it, idx) => {
                return { id: it.id, position: idx }
            })
            axios
                .post(`/admin/site-menu/sort`, { sortData: sortData })
                .then(({ data }) => {
                    console.log(data.result)
                })
                .catch(err => {
                    console.log(err)
                    toast.error(err.message)
                })
        }

        this.chDropping = null
    },
    onDragEnterCh(index) {
        if (index !== this.chDragging) {
            this.chDropping = index
        }
    },
    onDragLeaveCh(index) {
        if (this.chDropping === index) {
            this.chDropping = null
        }
    },
    onDragStartCh(index) {
        this.chDragging = index
    },
    onDragEndCh() {
        this.chDragging = null
    },
    deleteChildren(id) {
        Swal.fire({
            text: 'Ви впевнені?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Так',
            cancelButtonText: 'Відмінити',
        }).then(result => {
            if (result.value) {
                axios
                    .delete(`/admin/site-menu/${id}/delete`)
                    .then(({ data }) => {
                        if (data.result === 'success') {
                            toast.success(data.message)
                            this.children = this.children.filter(it => it.id !== id)
                        }
                    })
                    .catch(err => {
                        console.log(err)
                        toast.error(err.message)
                    })
            }
        })
    },
})
