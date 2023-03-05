<template>
    <div class="img">
        <img :data-img-src="user.avatar_url" alt="user">
    </div>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "UserAvatar",
    props: {
        user: Object,
    },
    setup(props) {
        const store = useStore();
        store.commit('user/SET_PROFILE', props.user);
    }
}
</script>

<style scoped>

</style>
