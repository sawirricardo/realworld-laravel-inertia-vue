<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    props: {
        article: {
            title: String,
            user: Object,
            tags: Array,
        },
    },
    like() {},
};
</script>
<template>
    <div class="article-preview">
        <div class="article-meta">
            <Link :href="route('users.show', { name: article.user.name })">
                <img :src="article.user.avatar_url" />
            </Link>
            <div class="info">
                <Link
                    :href="route('users.show', { name: article.user.name })"
                    class="author"
                >
                    {{ article.user.name }}
                </Link>
                <span class="date">{{ article.created_at }}</span>
            </div>
            <button class="btn btn-outline-primary btn-sm pull-xs-right">
                <i class="ion-heart"></i> {{ article.users_count }}
            </button>
        </div>
        <Link
            :href="route('articles.show', { slug: article.slug })"
            class="preview-link"
        >
            <h1 v-text="article.title"></h1>
            <p v-text="article.excerpt"></p>
            <span>Read more...</span>
            <ul v-if="article.tags.length > 0" class="tag-list">
                <Link
                    v-for="tag in article.tags"
                    :key="tag.id"
                    :href="route('tags.show', { slug: tag.slug })"
                >
                    <li
                        class="tag-default tag-pill tag-outline"
                        v-text="tag.name"
                    ></li>
                </Link>
            </ul>
        </Link>
    </div>
</template>
