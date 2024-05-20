import Navbar from "./Navbar.jsx";
import {Footer} from "./Footer.jsx";
import PropTypes from "prop-types";


export default function Page({children})
{
  return (
    <>
      <main className="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <Navbar/>

        <div className="container-fluid py-4 px-4" style={{ minHeight: "80vh" }}>
          <div className="row">
            <div className="col-md-12">
              <div className="d-sm-flex align-items-center justify-content-between">
                <div>
                  <h3 className="font-weight-bold mb-0">Home</h3>
                  <ol className="breadcrumb bg-transparent pb-0 mb-0 pt-1 px-0">
                    <li className="breadcrumb-item text-sm">
                      <a
                        className="opacity-5 text-dark"
                        href="/"
                      >Dashboard</a>
                    </li>
                    <li
                      className="breadcrumb-item text-sm text-dark active"
                      aria-current="page"
                    >Home</li>
                  </ol>
                </div>
                <div className="d-flex">

                </div>
              </div>
            </div>
          </div>
          <hr className="mt-1 mb-3" />

          { children }
        </div>

        <Footer/>
      </main>
    </>
  )
}

Page.propTypes = {
  children: PropTypes.node.isRequired
}