<template>
    <a :href="url" @click.prevent="print()">
        <slot />
    </a>
</template>

<script>
export default {
    name: 'PrintBtn',
    props: {
        href: String,
    },
    setup(props) {
        const url = props.href || document.location.href

        const print = () => {
            window.print()
        }

        return {
            url,
            print,
        }
    },
}
</script>

<style scoped></style>
