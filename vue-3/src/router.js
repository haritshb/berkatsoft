import { createWebHistory, createRouter } from "vue-router";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";
// lazy-loaded
const AllProduct = () => import("./components/AllProduct.vue")
const CreateProduct = () => import("./components/CreateProduct.vue")
const EditProduct = () => import("./components/EditProduct.vue")
const AllSales = () => import("./components/AllSales.vue")
const CreateSales = () => import("./components/CreateSales.vue")
const EditSales = () => import("./components/EditSales.vue")
const AllCustomer = () => import("./components/AllCustomer.vue")
const CreateCustomer = () => import("./components/CreateCustomer.vue")
const EditCustomer = () => import("./components/EditCustomer.vue")
const routes = [
  {
    path: "/",
    name: "Login",
    component: Login,
  },
  {
    path: "/login",
    component: Login,
  },
  {
    path: "/register",
    component: Register,
  },
  {
    path: "/products",
    name: "products",
    // lazy-loaded
    component: AllProduct,
  },  
  {
    path: "/create_product",
    name: "create_product",
    // lazy-loaded
    component: CreateProduct,
  },
  {
    path: "/edit_product/:id",
    name: "edit_product",
    // lazy-loaded
    component: EditProduct,
  },
  {
    path: "/customers",
    name: "customers",
    // lazy-loaded
    component: AllCustomer,
  },  
  {
    path: "/create_customer",
    name: "create_customer",
    // lazy-loaded
    component: CreateCustomer,
  },
  {
    path: "/edit_customer/:id",
    name: "edit_customer",
    // lazy-loaded
    component: EditCustomer,
  },
  {
    path: "/sales_order",
    name: "sales_order",
    // lazy-loaded
    component: AllSales,
  },  
  {
    path: "/create_sales",
    name: "create_sales",
    // lazy-loaded
    component: CreateSales,
  },
  {
    path: "/edit_sales/:id",
    name: "edit_sales",
    // lazy-loaded
    component: EditSales,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// router.beforeEach((to, from, next) => {
//   const publicPages = ['/login', '/register', '/home'];
//   const authRequired = !publicPages.includes(to.path);
//   const loggedIn = localStorage.getItem('user');

//   // trying to access a restricted page + not logged in
//   // redirect to login page
//   if (authRequired && !loggedIn) {
//     next('/login');
//   } else {
//     next();
//   }
// });

export default router;