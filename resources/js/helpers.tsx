import { User } from "./types";

export function can(user: User, permission: string): boolean {
    return user.permissions.includes(permission);
}
export function hasRoles(user: User, roles: string[]): boolean {
    return roles.some((role) => user.roles.includes(role));
}
