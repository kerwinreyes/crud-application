const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)

const CategoryList = () => import('./components/users/List.vue' /* webpackChunkName: "resource/js/components/users/list" */)
const CategoryCreate = () => import('./components/users/Add.vue' /* webpackChunkName: "resource/js/components/users/add" */)
const CategoryEdit = () => import('./components/users/Edit.vue' /* webpackChunkName: "resource/js/components/users/edit" */)
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'categoryList',
        path: '/category',
        component: CategoryList
    },
    {
        name: 'categoryEdit',
        path: '/category/:id/edit',
        component: CategoryEdit
    },
    {
        name: 'categoryAdd',
        path: '/category/add',
        component: CategoryCreate
    }
]