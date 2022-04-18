<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    setup() {
        const form = useForm({
            email: null,
            password: null,
            remember: false,
        });
        const submit = () => {
            Inertia.post("/login", form.data);
        };
        return { form };
    },
    components: { AppLayout },
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
                            <Link href="/register">Have no account?</Link>
                        </p>

                        <form @submit.prevent="form.post('/login')">
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
                            <button
                                class="btn btn-lg btn-primary pull-xs-right"
                                :disabled="form.processing"
                            >
                                Log in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
