import { createRouter, createWebHistory } from "vue-router"

import Report from '../pages/Report.vue'
import Users from '../pages/Users.vue'

const routes = [
    {
        path: "/",
        name: "Users",
        component: Users
    },
    {
        path: "/report",
        name: "Report",
        component: Report
    },
]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
