export default {
    user: {},
    hasRole(role) {
        return this.user.roles.indexOf(role) !== -1;
    }
}
