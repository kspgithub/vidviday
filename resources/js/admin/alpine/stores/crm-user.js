export default {
    user: {},
    hasRole(role) {
        return this.user.roles.indexOf(role) !== -1;
    },
    get isMasterAdmin() {
        return this.hasRole('admin') && this.user.id === 1;
    },
    get isAdmin() {
        return this.hasRole('admin');
    },
    get isManager() {
        return this.hasRole('manager');
    },
    get isTourManager() {
        return this.hasRole('tour-manager');
    },
    get isDutyManager() {
        return this.hasRole('duty-manager');
    }
}
