import SvgIcon from "./SvgIcon.jsx";
import {Link} from "react-router-dom";

const navs = [
  {
    "name": "Dashboard",
    "icon": "sitemap-4",
    "route": "/"
  },
  {
    "name": "Make Payment",
    "icon": "wallet-2",
    "route": "dashboard/payments"
  }
]

export const SideBar = () => {
    return (
      <aside className="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start "
             id="sidenav-main">
        <div className="sidenav-header">
          <i
            className="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
          <a className="navbar-brand d-flex align-items-center m-0"
             href="/dashboard" target="_blank">
            <span className="font-weight-bold text-lg">Dashboard</span>
          </a>
        </div>
        <div className="collapse navbar-collapse px-4  w-auto" id="sidenav-collapse-main">
          <ul className="navbar-nav">
            {navs.map((nav, index) => (
              <li className="nav-item" key={index}>
                <Link
                  to={nav.route}
                  className="nav-link"
                >
                  <div
                    className="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                    <SvgIcon icon={nav.icon}/>
                  </div>
                  <span className="nav-link-text ms-1">{nav.name}</span>
                </Link>
              </li>
            ))}
          </ul>
        </div>
      </aside>
    )
}