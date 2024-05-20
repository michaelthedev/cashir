import axiosClient from "../../app/axios.js";
import {useStateContext} from "../../contexts/AuthContextProvider.jsx";
import {toggleSidenavR} from "../../app/template.js";

export default function Navbar() {
  const { setUser, setUserToken } = useStateContext();

  const logout = (ev) => {
    ev.preventDefault();
    axiosClient.post("/auth/logout").then(() => {
      setUser({});
      setUserToken(null);
    });
  };

  return (
    <>
      <nav className="navbar navbar-main navbar-expand-lg px-0 shadow-sm rounded" id="navbarBlur" navbar-scroll="true">
        <div className="container-fluid py-1 px-2 flex-sm-nowrap">
          <nav aria-label="breadcrumb">
            <h6 className="font-weight-bold mb-0">Cashir Dashboard</h6>
          </nav>
          <div className="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
            <div className="pe-md-3 d-md-flex d-none align-items-center">
              <div className="input-group">
                    <span className="input-group-text text-body bg-white  border-end-0 ">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="16px"
                          height="16px"
                          fill="none"
                          viewBox="0 0 24 24"
                          strokeWidth="1.5"
                          stroke="currentColor">
                            <path
                              strokeLinecap="round"
                              strokeLinejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                            />
                        </svg>
                    </span>
                <input type="text" className="form-control ps-0" placeholder="Search"/>
              </div>
            </div>

            <ul className="navbar-nav  justify-content-end">
              <li className="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="#" className="nav-link text-body p-0" id="iconNavbarSidenav" onClick={toggleSidenavR}>
                  <div className="sidenav-toggler-inner">
                    <i className="sidenav-toggler-line"></i>
                    <i className="sidenav-toggler-line"></i>
                    <i className="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
              <li className="nav-item dropdown ps-2 d-flex align-items-center">
                <a href="#" className="nav-link text-body p-0" id="dropdownMenuButton"
                   data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="./assets/img/team-2.jpg" className="avatar avatar-sm" alt="avatar"/>
                </a>
                <ul className="dropdown-menu  dropdown-menu-end me-sm-n4" aria-labelledby="dropdownMenuButton">
                  <li>
                    <a className="dropdown-item border-radius-md" onClick={logout}>
                        <h6 className="text-sm font-weight-normal mb-1">
                          <span className="font-weight-bold text-center">Logout</span>
                        </h6>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </>
  )
}