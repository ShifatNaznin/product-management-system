import {
    createWebHistory,
    createRouter
} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Products from '../components/Products';
import EditProduct from '../components/EditProduct';
import SingleProduct from '../components/SingleProduct';
import AddProduct from '../components/AddProduct';

export const routes = [{
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'products',
        path: '/products',
        component: Products
    },
    {
        name: 'addproduct',
        path: '/products/create',
        component: AddProduct
    },
    {
        name: 'singleproduct',
        path: '/products/:slug',
        component: SingleProduct
    },
    {
        name: 'editproduct',
        path: '/products/edit/:id',
        component: EditProduct
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
