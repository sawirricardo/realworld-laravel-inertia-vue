<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
defineProps({
    article: {
        title: String,
        content: String,
        excerpt: String,
        user: Object,
        tags: Array,
    },
});

const form = useForm({
    comment: "",
});
</script>
<template>
    <AppLayout>
        <div class="article-page">
            <div class="banner">
                <div class="container">
                    <h1 v-text="article.title"></h1>

                    <div class="article-meta">
                        <Link
                            :href="
                                route('users.show', { name: article.user.name })
                            "
                        >
                            <img :src="article.user.avatar_url" />
                        </Link>
                        <div class="info">
                            <Link
                                :href="
                                    route('users.show', {
                                        name: article.user.name,
                                    })
                                "
                                v-text="article.user.name"
                                class="author"
                            >
                            </Link>
                            <span
                                class="date"
                                v-text="article.created_at_formatted"
                            ></span>
                        </div>
                        <Link
                            class="btn btn-sm btn-outline-secondary"
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
                            &nbsp; Follow {{ article.user.name }}
                            <span
                                class="counter"
                                v-text="`(${article.user.followers_count})`"
                            ></span>
                        </Link>
                        &nbsp;&nbsp;
                        <Link
                            class="btn btn-sm btn-outline-primary"
                            as="button"
                            :method="
                                $page.props.auth.guest
                                    ? 'get'
                                    : article.users_exists
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
                            <i class="ion-heart"></i>
                            &nbsp; Favorite Post
                            <span
                                class="counter"
                                v-text="`(${article.users_count})`"
                            ></span>
                        </Link>
                    </div>
                </div>
            </div>

            <div class="container page">
                <div class="row article-content">
                    <div class="col-md-12" v-html="article.content"></div>
                </div>

                <hr />

                <div class="article-actions">
                    <div class="article-meta">
                        <Link
                            :href="
                                route('users.show', { name: article.user.name })
                            "
                        >
                            <img :src="article.user.avatar_url" />
                        </Link>
                        <div class="info">
                            <Link
                                :href="
                                    route('users.show', {
                                        name: article.user.name,
                                    })
                                "
                                v-text="article.user.name"
                                class="author"
                            >
                            </Link>
                            <span
                                class="date"
                                v-text="article.created_at_formatted"
                            ></span>
                        </div>
                        <Link
                            class="btn btn-sm btn-outline-secondary"
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
                            &nbsp; Follow {{ article.user.name }}
                            <span
                                class="counter"
                                v-text="`(${article.user.followers_count})`"
                            ></span>
                        </Link>
                        &nbsp;&nbsp;
                        <Link
                            class="btn btn-sm btn-outline-primary"
                            as="button"
                            :method="
                                $page.props.auth.guest
                                    ? 'get'
                                    : article.users_exists
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
                            <i class="ion-heart"></i>
                            &nbsp; Favorite Post
                            <span
                                class="counter"
                                v-text="`(${article.users_count})`"
                            ></span>
                        </Link>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-8 offset-md-2">
                        <div
                            class="card comment-form p-2"
                            v-if="$page.props.auth.guest"
                        >
                            Please
                            <Link :href="route('login')">Login first</Link>
                        </div>
                        <form
                            @submit.prevent="
                                form.post(
                                    route('articles.comments.store', {
                                        article: article.id,
                                    })
                                )
                            "
                            v-if="$page.props.auth.check"
                            class="card comment-form"
                        >
                            <div class="card-block">
                                <textarea
                                    v-model="form.comment"
                                    class="form-control"
                                    placeholder="Write a comment..."
                                    rows="3"
                                ></textarea>
                                <div
                                    v-if="form.errors.comment"
                                    v-text="form.errors.comment"
                                ></div>
                            </div>
                            <div class="card-footer">
                                <img
                                    :src="$page.props.user.avatar_url"
                                    class="comment-author-img"
                                />
                                <button
                                    class="btn btn-sm btn-primary"
                                    :disabled="form.processing"
                                >
                                    Post Comment
                                </button>
                            </div>
                        </form>

                        <div v-if="article.comments.length == 0" class="card">
                            <div class="card-block">
                                <p class="card-text">No Comments yet</p>
                            </div>
                        </div>
                        <div
                            v-if="article.comments.length > 0"
                            v-for="comment in article.comments"
                            class="card"
                        >
                            <div class="card-block">
                                <p
                                    class="card-text"
                                    v-text="comment.content"
                                ></p>
                            </div>
                            <div class="card-footer">
                                <Link
                                    :href="
                                        route('users.show', {
                                            name: comment.user.name,
                                        })
                                    "
                                    class="comment-author"
                                    ><img
                                        class="comment-author-img"
                                        :src="comment.user.avatar_url"
                                /></Link>
                                &nbsp;
                                <Link
                                    :href="
                                        route('users.show', {
                                            name: comment.user.name,
                                        })
                                    "
                                    class="comment-author"
                                    v-text="comment.user.name"
                                ></Link>
                                <span
                                    class="date-posted"
                                    v-text="comment.created_at_formatted"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
