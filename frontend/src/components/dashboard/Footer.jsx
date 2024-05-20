export function Footer() {
    return (
      <footer className="footer pt-3  ">
        <div className="container-fluid">
          <div className="row align-items-center justify-content-lg-between">
            <div className="col-lg-6 mb-lg-0 mb-4">
              <div className="copyright text-center text-xs text-muted text-lg-start">
                Copyright © {"{"}
                {"{"} date('Y') {"}"}
                {"}"}. Made by{" "}
                <a href="https://github.com/michaelthedev" target="_blank">
                  @michaelthedev
                </a>
                , template by
                <a
                  href="https://www.creative-tim.com"
                  className="text-secondary"
                  target="_blank"
                >
                  Creative Tim
                </a>
                .
              </div>
            </div>
            <div className="col-lg-6">
              <ul className="nav nav-footer justify-content-center justify-content-lg-end">
                <li className="nav-item">
                  <a
                    href="https://github.com/michaelthedev"
                    className="nav-link text-xs text-muted"
                    target="_blank"
                  >
                    My GitHub
                  </a>
                </li>
                <li className="nav-item">
                  <a
                    href="https://www.creative-tim.com"
                    className="nav-link text-xs text-muted"
                    target="_blank"
                  >
                    Creative Tim
                  </a>
                </li>
                <li className="nav-item">
                  <a
                    href="https://www.creative-tim.com/blog"
                    className="nav-link text-xs text-muted"
                    target="_blank"
                  >
                    Blog
                  </a>
                </li>
                <li className="nav-item">
                  <a
                    href="https://www.creative-tim.com/license"
                    className="nav-link text-xs pe-0 text-muted"
                    target="_blank"
                  >
                    License
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    )
}