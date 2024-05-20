import PropTypes from "prop-types";
import {useEffect, useRef} from "react";

export default function ChartCards({ data }) {
  const chartRef = useRef(null);

  useEffect(() => {
    const dailyValues = data.daily;

    const dailyData = {
      datasets: [{
        label: 'Daily Chart',
        data: dailyValues,
        backgroundColor: [
          'rgba(132, 90, 223, 0.2)',
          'rgba(35, 183, 229, 0.2)',
          'rgba(245, 184, 73, 0.2)',
          'rgba(73, 182, 245, 0.2)',
          'rgba(230, 83, 60, 0.2)',
          'rgba(38, 191, 148, 0.2)',
          'rgba(35, 35, 35, 0.2)'
        ],
        borderColor: [
          'rgb(132, 90, 223)',
          'rgb(35, 183, 229)',
          'rgb(245, 184, 73)',
          'rgb(73, 182, 245)',
          'rgb(230, 83, 60)',
          'rgb(38, 191, 148)',
          'rgb(35, 35, 35)'
        ],
        borderWidth: 1
      }]
    };
    const dailyConfig = {
      type: 'line',
      data: dailyData,
      options: {
        maintainAspectRatio: false,
        responsive: true,

        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        },
      },
    };

    if (chartRef.current) {
      chartRef.current.data = dailyData;
      chartRef.current.update();
    } else {
      chartRef.current = new window.Chart(
        document.getElementById('dailyChart'),
        dailyConfig
      );
    }
  }, [data?.daily]);

  return (
    <div className="col-lg-12 mb-md-0 mb-4">
      <div className="card shadow-xs border h-100">
        <div className="card-header pb-0">
          <h6 className="font-weight-semibold text-lg mb-0">
            Transactions chart
          </h6>
          <p className="text-sm">Basic chart based on transaction data</p>
          <div
            className="btn-group"
            role="group"
            aria-label="Basic radio toggle button group"
          >
            <input
              type="radio"
              className="btn-check"
              name="btnradio"
              id="btnradio1"
              autoComplete="off"
              defaultChecked=""
            />
            <label className="btn btn-white px-3 mb-0" htmlFor="btnradio1">
              12 months
            </label>
            <input
              type="radio"
              className="btn-check"
              name="btnradio"
              id="btnradio2"
              autoComplete="off"
            />
            <label className="btn btn-white px-3 mb-0" htmlFor="btnradio2">
              30 days
            </label>
            <input
              type="radio"
              className="btn-check"
              name="btnradio"
              id="btnradio3"
              autoComplete="off"
            />
            <label className="btn btn-white px-3 mb-0" htmlFor="btnradio3">
              7 days
            </label>
          </div>
        </div>
        <div className="card-body py-3">
          <div className="chart chartContainer mb-2">
            <canvas id="dailyChart" className="chart-canvas" />
          </div>
          <button className="btn btn-white mb-0 ms-auto">View report</button>
        </div>
      </div>
    </div>
  )
}

ChartCards.propTypes = {
  data: PropTypes.object.isRequired
}