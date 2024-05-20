import { Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/AuthContextProvider.jsx";
import {Suspense} from "react";
import {ToastContainer} from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function GuestLayout() {
  const { userToken } = useStateContext();
  if (userToken) {
    return <Navigate to="/" />
  }

  return (
    <>
      <Suspense>
        <main className="main-content mt-0">
          <section>
            <div className="page-header min-vh-100">
              <ToastContainer/>
              <Outlet/>
            </div>
          </section>
        </main>
      </Suspense>
    </>
  )
}