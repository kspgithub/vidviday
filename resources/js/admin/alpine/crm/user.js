export default (props) => ({
    init() {
        this.$store.crmUser.user = props.user || {};
        this.$store.crmUser.roles = props.roles || [];
    }
});
