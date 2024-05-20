import {Navigate, Outlet} from "react-router-dom";
import {SideBar} from "../components/SideBar.jsx";
import '../assets/style.css';
import Page from "../components/dashboard/Page.jsx";
import {Suspense, useEffect} from "react";
import {useStateContext} from "../contexts/AuthContextProvider.jsx";
import axiosClient from "../app/axios.js";
import {ToastContainer} from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function DashboardLayout() {
  const { user, userToken, setUser} = useStateContext();

  // add dashboard classes to body
  useEffect(() => {
    document.body.classList.add('g-sidenav-show');

    if (!user) {
      axiosClient.get('/user')
        .then(({ data }) => {
          setUser(data.data);
        })
    }

    return () => {
      document.body.classList.remove('g-side-nav-show');
    }
  }, [])

  if (!userToken) {
    return <Navigate to="/login" />
  }
  
  return (
    <>
      <Suspense>
        <SideBar />
        <Page>
          <Outlet />
          <ToastContainer/>
        </Page>
      </Suspense>
    </>
  )
}