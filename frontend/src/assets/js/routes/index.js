import Login from 'Pages/Login.vue';
import ForgotPassword from 'Pages/ForgotPassword.vue';
import ResetPassword from 'Pages/ResetPassword.vue';
import Home from 'Pages/Home.vue';
import Registration from 'Pages/Registration.vue';
import Devices from 'Pages/Devices.vue';
import AddDevice from 'Pages/AddDevice.vue';
import EditDevice from 'Pages/EditDevice.vue';
import Device from 'Pages/Device.vue';
import Account from 'Pages/Account.vue';
import Challenges from 'Pages/Challenges.vue';
import Tasks from 'Pages/Tasks.vue';

import auth from 'Middleware/auth.js';
import guest from 'Middleware/guest.js';

export default [
    { 
        path: '/', 
        name: 'home', 
        component: Home,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/login', 
        name: 'login', 
        component: Login,
        meta: {
            middleware: [guest]
        }
    },
    { 
        path: '/password/forgot', 
        name: 'password-forgot', 
        component: ForgotPassword,
        meta: {
            middleware: [guest]
        }
    },
    { 
        path: '/password/reset', 
        name: 'password-reset', 
        component: ResetPassword,
        meta: {
            middleware: [guest]
        }
    },
    { 
        path: '/registration', 
        name: 'registration', 
        component: Registration,
        meta: {
            middleware: [guest]
        }
    },
    { 
        path: '/devices', 
        name: 'devices', 
        component: Devices,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/devices/add/:id', 
        name: 'add-device', 
        component: AddDevice,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/devices/edit/:id', 
        name: 'edit-device', 
        component: EditDevice,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/devices/show/:id', 
        name: 'device', 
        component: Device,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/account', 
        name: 'account', 
        component: Account,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/challenges', 
        name: 'challenges', 
        component: Challenges,
        meta: {
            middleware: [auth]
        }
    },
    { 
        path: '/tasks/:category_id', 
        name: 'tasks', 
        component: Tasks,
        meta: {
            middleware: [auth]
        }
    },
];