<script>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    setup() {
        const user = usePage().props.value.auth.user;
        const form = useForm({
            name: user.name,
            email: user.email,
            bio: user.bio,
            avatar_url: user.avatar_url,
        });
        return { form, user };
    },
};
</script>
<template>
    <AppLayout>
        <div class="settings-page">
            <div class="container page">
                <div class="row">
                    <div class="col-md-6 offset-md-3 col-xs-12">
                        <h1 class="text-xs-center">Your Settings</h1>

                        <form @submit="form.put('/user')">
                            <fieldset>
                                <fieldset class="form-group">
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="URL of profile picture"
                                        v-model="form.avatar_url"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        class="form-control form-control-lg"
                                        type="text"
                                        placeholder="Your Name"
                                        v-model="form.name"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <textarea
                                        class="form-control form-control-lg"
                                        rows="8"
                                        placeholder="Short bio about you"
                                        v-model="form.bio"
                                    ></textarea>
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        class="form-control form-control-lg"
                                        type="text"
                                        placeholder="Email"
                                        v-model="form.email"
                                    />
                                </fieldset>
                                <button
                                    class="btn btn-lg btn-primary pull-xs-right"
                                    :disabled="form.processing"
                                >
                                    Update Settings
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
