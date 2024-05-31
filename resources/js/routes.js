const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)

const UserList = () => import('./components/users/List.vue' /* webpackChunkName: "resource/js/components/users/list" */)
const CreateUser = () => import('./components/users/Add.vue' /* webpackChunkName: "resource/js/components/users/add" */)
const EditUser = () => import('./components/users/Edit.vue' /* webpackChunkName: "resource/js/components/users/edit" */)
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'listUsers',
        path: '/user',
        component: UserList
    },
    {
        name: 'editUser',
        path: '/user/:id/edit',
        component: EditUser
    },
    {
        name: 'createUser',
        path: '/user/add',
        component: CreateUser
    }
]