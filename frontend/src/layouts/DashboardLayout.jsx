import {Outlet} from "react-router-dom";
import {SideBar} from "../components/SideBar.jsx";
import '../assets/style.css';
import Page from "../components/dashboard/Page.jsx";

export function DashboardLayout() {
    return (
        <>
          <SideBar />
          <Page>
            <Outlet />
          </Page>
        </>
    )
}