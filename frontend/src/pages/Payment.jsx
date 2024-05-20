import Errors from "../components/Errors.jsx";
import SvgIcon from "../components/SvgIcon.jsx";
import {useEffect, useState} from "react";
import axiosClient from "../app/axios.js";
import {toast} from "react-toastify";

export default function Payment() {
  const [isLoading, setIsLoading] = useState(false);
  const [options, setOptions] = useState({});
  const [errors, setErrors] = useState([]);

  useEffect(() => {

    if (options.gateways) return;

    // Fetch payment options
    axiosClient.get('/payments/options')
      .then(({ data }) => {
        setOptions(data.data);
      });
  }, []);

  const changeGateway = (e) => {
    const el = e.target.closest('li');
    const radio = el.querySelector('input[type="radio"]');
    radio.checked = true;
  }

  const handleSubmit = (e) => {
    e.preventDefault();

    setErrors([]);
    setIsLoading(true);

    const formData = new FormData(e.target);
    const amount = formData.get('amount');
    const gateway = formData.get('gateway');

    axiosClient.post("/payments/initialize",
      {
        amount,
        gateway,
      })
      /**
       * @param {{data: {data: {url}}}} response
       */
      .then(({ data }) => {
        toast.success(data.message);
        toast.info('Complete the payment in the popup window');

        window.open(data.data.url, 'newwindow', 'width=400,height=600');
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
      <div className="row">
        <div className="col-12 col-xl-6 mb-4">
          <div className="card border shadow-xs h-100">
            <div className="card-header pb-0 p-3">
              <h6 className="mb-0 font-weight-semibold text-lg">Make a Payment</h6>
              <p className="text-sm mb-1" />
            </div>
            <div className="card-body p-3">
              <div className="alert alert-info text-dark text-sm" role="alert">
                Payment is on test environment, there wont be any debit
              </div>
              <form onSubmit={handleSubmit}>
                <div className="form-group">
                  <label>Amount</label>
                  <input
                    type="number"
                    className="form-control"
                    name="amount"
                    placeholder="Amount to pay"
                    min={options?.amount?.min}
                    max={options?.amount?.max}
                    required=""
                  />
                </div>

                <div className="form-group">
                  <label>Payment Gateway</label>
                  <ul className="list-group">
                    {options?.gateways?.map((gateway, index) => (
                      <li key={index} data-id={gateway.id} className="list-group-item border d-flex justify-content-between mb-3 border-radius-md shadow-xs p-3" onClick={changeGateway}>
                        <div className="d-flex align-items-start">
                          <div className="icon icon-shape icon-sm bg-dark text-white shadow-none text-center  border-radius-sm me-sm-2 me-3 mt-1 px-2 d-flex align-items-center justify-content-center">
                            <SvgIcon icon='credit-card'/>
                          </div>
                          <div className="d-flex flex-column">
                            <h6 className="mb-0 text-sm">{gateway.name}</h6>
                            <span className="text-sm">Use the <b>{gateway.name}</b> payment gateway provider</span>
                          </div>
                        </div>
                        <div className="d-flex align-items-center text-danger text-gradient">
                          <div className="form-check">
                            <input
                              type="radio"
                              value={gateway.id}
                              name="gateway"
                              className="form-check-input form-check-input-info"
                            />
                          </div>
                        </div>
                      </li>
                    ))}
                  </ul>
                </div>

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
                    please wait...
                  </button>
                ) : (
                  <button type="submit" className="btn btn-dark btn-lg mb-3 w-100 mb-3">
                    Continue
                  </button>
                )}
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}