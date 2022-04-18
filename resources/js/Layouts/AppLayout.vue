<script>
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
console.log(usePage().props.value);
export default {
    components: {
        Head,
        Link,
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user);
        return { user };
    },
};
</script>
<template>
    <div>
        <nav class="navbar navbar-light">
            <div class="container">
                <Link class="navbar-brand" href="/">conduit</Link>
                <ul class="nav navbar-nav pull-xs-right">
                    <li class="nav-item">
                        <!-- Add "active" class when you're on that page" -->
                        <Link href="/" class="nav-link">Home</Link>
                    </li>
                    <li class="nav-item" v-if="user">
                        <Link href="/articles/create" class="nav-link">
                            <i class="ion-compose"></i>&nbsp;New Article
                        </Link>
                    </li>
                    <li class="nav-item" v-if="user">
                        <Link class="nav-link" href="/settings">
                            <i class="ion-gear-a"></i>&nbsp;Settings
                        </Link>
                    </li>
                    <li class="nav-item" v-if="user === null">
                        <Link class="nav-link" href="/login">Sign in</Link>
                    </li>
                    <li class="nav-item" v-if="user === null">
                        <Link class="nav-link" href="/register">Sign up</Link>
                    </li>
                </ul>
            </div>
        </nav>
        <main><slot /></main>
        <footer>
            <div class="container">
                <Link href="/" class="logo-font">conduit</Link>
                <span class="attribution">
                    An interactive learning project from
                    <a href="https://thinkster.io">Thinkster</a>. Code &amp;
                    design licensed under MIT.
                </span>
            </div>
        </footer>
    </div>
</template>
