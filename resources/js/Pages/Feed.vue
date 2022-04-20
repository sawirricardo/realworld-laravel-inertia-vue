<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ArticlePreview from "../Components/ArticlePreview.vue";
export default {
    components: {
        AppLayout,
        ArticlePreview,
    },
    props: {
        tags: Array,
        articles: Array,
    },
};
</script>
<template>
    <AppLayout>
        <div class="home-page">
            <div class="banner">
                <div class="container">
                    <h1 class="logo-font">conduit</h1>
                    <p>A place to share your knowledge.</p>
                </div>
            </div>

            <div class="container page">
                <div class="row">
                    <div class="col-md-9">
                        <div class="feed-toggle">
                            <ul class="nav nav-pills outline-active">
                                <li class="nav-item">
                                    <Link
                                        class="nav-link"
                                        :href="
                                            $page.props.auth.guest
                                                ? '#'
                                                : route('feed')
                                        "
                                        :class="{
                                            disabled: $page.props.auth.guest,
                                        }"
                                    >
                                        Your Feed
                                    </Link>
                                </li>
                                <li class="nav-item">
                                    <Link
                                        class="nav-link active"
                                        :href="route('home')"
                                    >
                                        Global Feed
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <div v-if="articles.length === 0">
                            There's no article currently
                        </div>
                        <ArticlePreview
                            v-for="article in articles"
                            :key="`article_${article.id}`"
                            :article="article"
                        />
                    </div>

                    <div class="col-md-3">
                        <div class="sidebar">
                            <p>Popular Tags</p>

                            <div class="tag-list">
                                <a
                                    :href="
                                        route('tags.show', { slug: tag.slug })
                                    "
                                    class="tag-pill tag-default"
                                    v-for="(tag, index) in tags"
                                    :key="tag.id"
                                    >{{ tag.name }}</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
