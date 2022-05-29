import Cookie from "@/service/cookie";

export default {
    redirectIfNotAuthenticated(to, from, next) {
        const token = Cookie.getToken();
        let n;

        if (! token) {
            n = next({ name: 'login' })
        }

        next(n);
    },
    redirectIfAuthenticated(to, from, next) {
        const token = Cookie.getToken();
        let n;

        if (token) {
            n = next({ name: 'index' })
        }

        next(n);
    },
}
