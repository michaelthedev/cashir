import {StatCards} from "../components/dashboard/cards/StatCards.jsx";
import {useEffect, useState} from "react";
import axiosClient from "../app/axios.js";
import ChartCards from "../components/dashboard/cards/ChartCards.jsx";

export default function Dashboard() {
  const [stats, setStats] = useState({});
  const [transactions, setTransactions] = useState(null);

  useEffect(() => {
    axiosClient.get('/stats/transactions')
      .then(({ data }) => {
        setStats(data.data);
      });

    axiosClient.get('/transactions')
      .then(({ data }) => {
        setTransactions(data.data);
      });
  }, []);

  return (
    <>
      <StatCards stats={stats.stats ?? {}}/>
      <div className="row my-4">
        <div className="col-lg-12">
          <div className="card shadow-xs border">
            <div className="card-header border-bottom pb-0">
              <div className="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 className="font-weight-semibold text-lg mb-0">
                    Recent transactions
                  </h6>
                  <p className="text-sm mb-sm-0 mb-2">
                    These are details about the last transactions
                  </p>
                </div>
                <div className="ms-auto d-flex">
                  <button type="button" className="btn btn-sm btn-white mb-0 me-2">
                    View report
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
                          d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                        />
                      </svg>
                    </span>
                    <span className="btn-inner--text">Download</span>
                  </button>
                </div>
              </div>
              <div className="pb-3 d-sm-flex align-items-center">
                <div
                  className="btn-group"
                  role="group"
                  aria-label="Basic radio toggle button group"
                >
                  <input
                    type="radio"
                    className="btn-check"
                    name="btnradiotable"
                    id="btnradiotable1"
                    autoComplete="off"
                    defaultChecked=""
                  />
                  <label
                    className="btn btn-white px-3 mb-0"
                    htmlFor="btnradiotable1"
                  >
                    All
                  </label>
                  <input
                    type="radio"
                    className="btn-check"
                    name="btnradiotable"
                    id="btnradiotable2"
                    autoComplete="off"
                  />
                  <label
                    className="btn btn-white px-3 mb-0"
                    htmlFor="btnradiotable2"
                  >
                    Monitored
                  </label>
                  <input
                    type="radio"
                    className="btn-check"
                    name="btnradiotable"
                    id="btnradiotable3"
                    autoComplete="off"
                  />
                  <label
                    className="btn btn-white px-3 mb-0"
                    htmlFor="btnradiotable3"
                  >
                    Unmonitored
                  </label>
                </div>
                <div className="input-group w-sm-25 ms-auto">
                  <span className="input-group-text text-body">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16px"
                height="16px"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="1.5"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                ></path>
              </svg>
            </span>
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Search"
                  />
                </div>
              </div>
            </div>
            <div className="card-body px-0 py-0">
              <div className="table-responsive p-0">
                <table className="table align-items-center justify-content-center mb-0">
                  <thead className="bg-gray-100">
                  <tr>
                    <th className="text-secondary text-xs font-weight-semibold opacity-7">
                      #TID
                    </th>
                    <th className="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                      Amount
                    </th>
                    <th className="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                      Date
                    </th>
                    <th className="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                      Flow
                    </th>
                    <th className="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                      Status
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  {transactions && transactions.data.map((transaction, index) => (
                    <tr key={index}>
                      <td>
                        <h6 className="mb-0 text-sm">#{transaction.trans_id}</h6>
                      </td>
                      <td>
                        <p className="text-sm font-weight-normal mb-0">{transaction.amount_formatted}</p>
                      </td>
                      <td>
                        <span className="text-sm font-weight-normal">
                          {transaction.date}
                        </span>
                      </td>
                      <td className="align-middle">
                        {transaction.flow === 'credit' ? (
                          <span className="badge bg-success text-dark">Credit</span>
                        ) : (
                          <span className="badge bg-danger">Debit</span>
                        )}
                      </td>
                      <td className="align-middle">
                        {transaction.status === 'success' ? (
                          <span className="badge badge-success">Success</span>
                        ) : transaction.status === 'pending' ? (
                          <span className="badge badge-warning">Pending</span>
                        ) : (
                          <span className="badge bg-danger">Failed</span>
                        )}
                      </td>
                    </tr>
                  ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="row my-4">
        <ChartCards data={stats.charts ?? {}}/>
      </div>
    </>
  )
}