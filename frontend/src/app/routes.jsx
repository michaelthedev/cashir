import {Navigate, useRoutes} from "react-router-dom";
import DashboardPage from "../pages/Dashboard";
import NotFound from "../components/NotFound.jsx";
import Login from "../pages/Auth/Login.jsx";
import GuestLayout from "../layouts/GuestLayout.jsx";
import {DashboardLayout} from "../layouts/DashboardLayout.jsx";

export default function Routes() {
  const routes = useRoutes([
    {
      path: '/',
      element: <GuestLayout />,
      children: [
        { path: 'login', element: <Login /> },
        { path: '404', element: <NotFound /> },
        { path: '/', element: <Navigate to="/dashboard" /> },
        { path: '*', element: <Navigate to="/404" /> },
      ],
    },
    {
      path: '/dashboard',
      element: <DashboardLayout />,
      children: [
        { path: '', element: <DashboardPage /> },
      ],
    },
  ])

  return (
    <>
      {routes}
    </>
  );
}