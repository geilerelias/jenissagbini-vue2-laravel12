export default {
    install: (app) => {
        app.mixin({
            mounted() {
                try {
                    let authRoles = this.$page.auth;
                    let authPermissions;
                    if (authRoles !== null) {
                        //console.log('estos son los roles y los permisos')
                        authRoles = this.$page.auth.roles;
                        //console.log('Roles: ', authRoles)
                        authPermissions = this.$page.auth.permissions;
                        //console.log('Permisos: ', authPermissions)

                        this.$gates.setRoles(authRoles);
                        this.$gates.setPermissions(authPermissions);
                    }
                } catch (e) {

                }
            }
        })

    }
}
