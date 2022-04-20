<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import ArticlePreview from "../../Components/ArticlePreview.vue";
defineProps({
    user: {
        name: String,
        avatar_url: String,
        bio: String,
        articles: Array,
        followers_count: Number,
    },
});
</script>
<template>
    <AppLayout>
        <div class="profile-page">
            <div class="user-info">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-10 offset-md-1">
                            <img :src="user.avatar_url" class="user-img" />
                            <h4 v-text="user.name"></h4>
                            <p v-text="user.bio"></p>
                            <Link
                                class="btn btn-sm btn-outline-secondary action-btn"
                                as="button"
                                :method="
                                    $page.props.auth.guest
                                        ? 'get'
                                        : article.user.followers_exists
                                        ? 'delete'
                                        : 'post'
                                "
                                :href="
                                    $page.props.auth.guest
                                        ? route('login')
                                        : route('articles.favorite', {
                                              article: article.id,
                                          })
                                "
                            >
                                <i class="ion-plus-round"></i>
                                &nbsp; Follow {{ user.name }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-10 offset-md-1">
                        <div class="articles-toggle">
                            <ul class="nav nav-pills outline-active">
                                <li class="nav-item">
                                    <Link
                                        class="nav-link active"
                                        :href="
                                            route('users.show', {
                                                name: user.name,
                                            })
                                        "
                                        >Articles published</Link
                                    >
                                </li>
                                <li class="nav-item">
                                    <Link
                                        :href="
                                            route('article-users.show', {
                                                name: user.name,
                                            })
                                        "
                                        class="nav-link"
                                        >Favorited Articles</Link
                                    >
                                </li>
                            </ul>
                        </div>

                        <div v-if="user.articles.length === 0">
                            There's no article currently
                        </div>
                        <ArticlePreview
                            v-for="article in user.articles"
                            :key="`article_${article.id}`"
                            :article="article"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
