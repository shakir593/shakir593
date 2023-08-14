import Login from './components/auth/Login.vue';
import DashboardLayout from './components/DashboardLayout.vue';
import EmployeeList from './components/employees/EmployeeList.vue';
import AddEmployee from './components//employees/AddEmployee.vue';
import EditEmployee from './components/employees//EditEmployee.vue';
import CompaniesList from './components/companies/CompaniesList.vue';
import AddCompany from './components//companies/AddCompany.vue';
import EditCompany from './components/companies//EditCompany.vue';
import Dashboard from './components/Dashboard.vue';
import {createRouter} from "vue-router";
import {createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        component: Login,
          beforeEnter: (to, from, next) => {
        // Check if the user is authenticated
        const isAuthenticated = checkAuthentication();
        if (isAuthenticated) {
          next('/admin/dashboard');
        } else {
          next();
        }
      },
    },
    {
        path: '/admin',
        component: DashboardLayout,
        children: [
            {
                path: 'dashboard',
                component: Dashboard
            },
            {
                path: 'employees',
                component: EmployeeList
            },
            {
                path: '/',
                component: EmployeeList
            },
            {
                path: 'employee/create',
                component: AddEmployee
            },
            {
                path: 'employee/edit/:id',
                component: EditEmployee
            },
            {
                path: 'companies',
                component: CompaniesList
            },
            {
                path: 'company/create',
                component: AddCompany
            },
            {
                path: 'company/edit/:id',
                component: EditCompany
            },
            
            // Other nested routes...
          ],
          beforeEnter: (to, from, next) => {
            // Check if the user is authenticated
            const isAuthenticated = checkAuthentication();
            if (isAuthenticated) {
              next();
            } else {
              next('/');
            }
          },
    }
];

function checkAuthentication() {
    // Check if the authentication token exists in local storage
    const token = localStorage.getItem('APP_DEMO_USER_TOKEN');
  
    // Return true if the token exists, indicating the user is authenticated
    return !!token;
  }
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;