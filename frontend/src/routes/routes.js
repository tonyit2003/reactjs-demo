import config from "~/config";
import AdminLayout from "~/layouts/AdminLayout";
import Home from "~/pages/Home";
import Login from "~/pages/Login";
import PersonnelManagement from "~/pages/PersonnelManagement";

const publicRoutes = [
    { path: config.routes.home, component: Home, layout: AdminLayout },
    {
        path: config.routes.personnelManagement,
        component: PersonnelManagement,
        layout: AdminLayout,
    },
    { path: config.routes.login, component: Login, layout: AdminLayout },
];
const privateRoutes = [];

export { publicRoutes, privateRoutes };
