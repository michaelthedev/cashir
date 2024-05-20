import Navbar from "./Navbar.jsx";
import {Footer} from "./Footer.jsx";


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
                  <h3 className="font-weight-bold mb-0">Title</h3>
                  <ol className="breadcrumb bg-transparent pb-0 mb-0 pt-1 px-0">
                    <li className="breadcrumb-item text-sm">
                      <a
                        className="opacity-5 text-dark"
                        href="{{ route('dashboard.home') }}"
                      >
                        Dashboard
                      </a>
                    </li>
                    <li
                      className="breadcrumb-item text-sm text-dark active"
                      aria-current="page"
                    >
                      $title
                    </li>
                  </ol>
                </div>
                <div className="d-flex">
                  <button
                    type="button"
                    className="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 me-2"
                  >
            <span className="btn-inner--icon">
              <span className="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                <span className="visually-hidden">New</span>
              </span>
            </span>
                    <span className="btn-inner--text">Messages</span>
                  </button>
                  <button
                    type="button"
                    className="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                  >
            <span className="btn-inner--icon">
              <svg
                width={16}
                height={16}
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
                className="d-block me-2"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"
                />
              </svg>
            </span>
                    <span className="btn-inner--text">Sync</span>
                  </button>
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