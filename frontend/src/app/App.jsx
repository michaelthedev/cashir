import {BrowserRouter} from 'react-router-dom'
import { ToastContainer } from 'react-toastify';
import Routes from "./routes.jsx";

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes />
      </BrowserRouter>
      <ToastContainer />
    </>
  )
}

export default App