import {useState} from "react";
import axiosClient from "../../app/axios.js";
import {useStateContext} from "../../contexts/AuthContextProvider.jsx";
import {toast} from "react-toastify";
import Errors from "../../components/Erros.jsx";


export default function Login() {
  const { setUserToken, setUser } = useStateContext();
  const [errors, setErrors] = useState([]);
  const [isLoading, setIsLoading] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();

    setErrors([]);
    setIsLoading(true);

    const form = new FormData(e.currentTarget);
    const email = form.get("email");
    const password = form.get("password");

    axiosClient.post("/auth/login",
      {
        email,
        password,
      })
      /**
       * @param {{data: {data: {access_token}}}} response
       */
      .then(({ data }) => {
        toast.success('Login Successful');
        setUserToken(data.data.access_token);
        setUser(data.data.user);
      })

      .catch((error) => {
        if (error.response?.data.errors) {
          const finalErrors = Object.values(error.response.data.errors)
            .reduce(
              (accum, next) => [...accum, ...next],
              []
            );

          setErrors(finalErrors);
        }

        if (error.response?.data.message) {
          toast.error(error.response.data.message);
        }

        console.error(error);
      })
      .finally(() => {
        setIsLoading(false);
      });
  }

  return (
    <>
      <div className="container">
        <div className="row">
          <div className="col-xl-4 col-md-6 d-flex flex-column mx-auto">
            <div className="card card-plain mt-5">
              <div className="card-header pb-0 text-center">
                <h3 className="font-weight-black text-dark display-6">
                  Welcome back!
                </h3>
                <p className="mb-0">
                  Login to view the dashboard
                </p>
              </div>
              <div className="card-body">
                <form role="form" onSubmit={handleSubmit}>
                  <label>Email Address</label>
                  <div className="mb-2">
                    <input
                      type="email"
                      name="email"
                      className="form-control"
                      placeholder="Enter your email address"
                      aria-label="Email"
                      aria-describedby="email-addon"
                    />
                  </div>
                  <label>Password</label>
                  <div className="mb-2">
                    <input
                      type="password"
                      name="password"
                      className="form-control"
                      placeholder="Enter password"
                      aria-label="Password"
                      aria-describedby="password-addon"
                    />
                  </div>

                  <Errors errors={errors} />

                  <div className="text-center mt-3">
                    {isLoading ? (
                      <button
                        className="btn btn-dark w-100 mb-3"
                        type="button"
                        disabled
                      >
                        <span
                          className="spinner-border spinner-border-sm me-2"
                          role="status"
                          aria-hidden="true"
                        ></span>
                        Loading...
                      </button>
                    ) : (
                      <button type="submit" className="btn btn-dark w-100 mb-3">
                        Login
                      </button>
                    )}
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}