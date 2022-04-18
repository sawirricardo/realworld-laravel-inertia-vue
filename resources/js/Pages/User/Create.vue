<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    setup() {
        const form = useForm({
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            remember: false,
        });
        return { form };
    },
};
</script>
<template>
    <AppLayout>
        <div class="auth-page">
            <div class="container page">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-xs-12">
                        <h1 class="text-xs-center">Sign up</h1>
                        <p class="text-xs-center">
                            <Link href="/login">Have an account?</Link>
                        </p>

                        <form @submit.prevent="form.post('/register')">
                            <fieldset class="form-group">
                                <input
                                    class="form-control form-control-lg"
                                    type="text"
                                    placeholder="Your Username"
                                    v-model="form.name"
                                />
                                <div
                                    class="error-messages"
                                    v-if="form.errors.name"
                                >
                                    {{ form.errors.name }}
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <input
                                    class="form-control form-control-lg"
                                    type="text"
                                    placeholder="Email"
                                    v-model="form.email"
                                />
                                <div
                                    class="error-messages"
                                    v-if="form.errors.email"
                                >
                                    {{ form.errors.email }}
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <input
                                    class="form-control form-control-lg"
                                    type="password"
                                    placeholder="Password"
                                    v-model="form.password"
                                />
                                <div
                                    class="error-messages"
                                    v-if="form.errors.password"
                                >
                                    {{ form.errors.password }}
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <input
                                    class="form-control form-control-lg"
                                    type="password"
                                    placeholder="Password"
                                    v-model="form.password_confirmation"
                                />
                            </fieldset>
                            <button
                                class="btn btn-lg btn-primary pull-xs-right"
                            >
                                Sign up
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
