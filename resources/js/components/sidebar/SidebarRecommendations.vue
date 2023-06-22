<template>
    <div ref="elRef" class="sidebar-recommendations">
        <slot/>
    </div>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
    name: "SidebarRecommendations",
    setup(props) {
        const elRef = ref(null);
        const btn = ref(null);

        onMounted(() => {
            btn.value = elRef.value.querySelector('.show_more');
            if(!!btn.value){
                btn.value.addEventListener('click', (evt) => {
                    evt.preventDefault();
                    btn.value.classList.add('hidden');
                    const items = elRef.value.querySelectorAll('.d-none');
                    items.forEach((it) => {
                        it.classList.remove('d-none');
                    })
                    const reviews = elRef.value.querySelectorAll('.review');
                    reviews.forEach((it) => {
                        it.classList.remove('hidden');
                    })
                })
            }
            

        })
        return {
            elRef
        }
    }
}
</script>

<style scoped>

</style>
