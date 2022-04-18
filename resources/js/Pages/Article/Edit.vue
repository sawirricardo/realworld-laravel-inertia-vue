<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    setup() {
        const form = useForm({
            title: null,
            excerpt: null,
            content: null,
            tags: null,
        });
        return { form };
    },
};
</script>

<template>
    <AppLayout>
        <div class="editor-page">
            <div class="container page">
                <div class="row">
                    <div class="col-md-10 offset-md-1 col-xs-12">
                        <form @submit.prevent="form.post('/articles')">
                            <fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control form-control-lg"
                                        placeholder="Article Title"
                                        v-model="form.title"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="What's this article about?"
                                        v-model="form.excerpt"
                                    />
                                </fieldset>
                                <fieldset class="form-group">
                                    <textarea
                                        class="form-control"
                                        rows="8"
                                        placeholder="Write your article (in markdown)"
                                        v-model="form.content"
                                    ></textarea>
                                </fieldset>
                                <fieldset class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter tags"
                                        v-model="form.tags"
                                    />
                                    <div class="tag-list"></div>
                                </fieldset>
                                <button
                                    class="btn btn-lg pull-xs-right btn-primary"
                                    type="button"
                                    :disabled="form.processing"
                                >
                                    Save
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
