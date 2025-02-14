import { Config } from "ziggy-js";

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    created_at: string;
    permissions: string[];
    roles: string[];
}
export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
    prev: string | null;
    next: string | null;
}
export interface PaginatedUserData<T> {
    data: T[];
    current_page: number;
    first_page_url: string;
    last_page: number;
    last_page_url: string;
    links: PaginationLink;
    next_page_url: string | null;
    prev_page_url: string | null;
    per_page: number;
    total: number;
}
export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};

export type Feature = {
    id: number;
    name: string;
    description: string;
    created_at: string;
    updated_at: string;
    upvote_count: number;
    user_has_upvoted: boolean;
    user_has_downvoted: boolean;
    comments: Comment[];
};
export type Comment = {
    id: number;
    comment: string;
    created_at: string;
    user: User;
};

export type PaginatedData<T = any> = {
    prev_page_url: any;
    current_page: ReactNode;
    last_page: ReactNode;
    next_page_url: any;
    data: T[];
    links: Record<string, string>;
};
