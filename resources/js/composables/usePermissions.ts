import { usePage } from '@inertiajs/vue3'

export function usePermissions() {
    const page = usePage()

    const can = (permission: string): boolean => {
        return page.props.auth.permissions.includes(permission)
    }

    return { can }
}