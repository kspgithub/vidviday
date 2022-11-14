export default props => ({
    init() {
        this.$store.crmUser.user = props.user || {}
    },
})
