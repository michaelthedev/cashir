import {Navigate, useRoutes} from "react-router-dom";
import {lazy} from "react";

const LoginPage = lazy(() => import('../pages/Auth/Login'));
const NotFound = lazy(() => import('../components/NotFound'));
const GuestLayout = lazy(() => import('../layouts/GuestLayout'));

const DashboardLayout = lazy(() => import('../layouts/DashboardLayout'));
const DashboardPage = lazy(() => import('../pages/Dashboard'));


export default function Routes() {
  return useRoutes([
    {
      path: '/',
      element: <GuestLayout/>,
      children: [
        {
          path: '/login',
          element: <LoginPage/>,
        },
        {
          path: '/404',
          element: <NotFound/>
        },
        {
          path: '*',
          element: <Navigate to="/404" replace/>
        }
      ],
    },
    {
      path: '/',
      element: <DashboardLayout/>,
      children: [
        {
          index: true,
          element: <DashboardPage/>,
        }
      ],
    },
  ]);
}