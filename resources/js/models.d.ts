/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Tag {
        id: number;
        name: string;
        slug: string | null;
        articles?: Array<App.Models.Article> | null;
        articles_count?: number | null;
    }

    export interface User {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        bio: string | null;
        avatar_url: string | null;
        articles?: Array<App.Models.Article> | null;
        article_favorites?: Array<App.Models.Article> | null;
        followers?: Array<App.Models.User> | null;
        users?: Array<App.Models.User> | null;
        comments?: Array<App.Models.Comment> | null;
        articles_count?: number | null;
        article_favorites_count?: number | null;
        followers_count?: number | null;
        users_count?: number | null;
        comments_count?: number | null;
    }

    export interface ArticleUser {
        id: number;
        article_id: number | null;
        user_id: number | null;
    }

    export interface Follower {
        id: number;
        user_id: number | null;
        followed_by_id: number | null;
    }

    export interface Comment {
        id: number;
        content: string | null;
        user_id: number | null;
        article_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        article?: App.Models.Article | null;
        user?: App.Models.User | null;
        readonly created_at_formatted?: string;
    }

    export interface ArticleTag {
        id: number;
        article_id: number | null;
        tag_id: number | null;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Article {
        id: number;
        title: string;
        slug: string | null;
        content: string | null;
        excerpt: string | null;
        state: string;
        user_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        user?: App.Models.User | null;
        tags?: Array<App.Models.Tag> | null;
        comments?: Array<App.Models.Comment> | null;
        users?: Array<App.Models.User> | null;
        tags_count?: number | null;
        comments_count?: number | null;
        users_count?: number | null;
        readonly created_at_formatted?: string;
    }

}
