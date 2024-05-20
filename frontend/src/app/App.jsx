import {BrowserRouter} from 'react-router-dom'
import { ToastContainer } from 'react-toastify';
import Routes from "./routes.jsx";
import { NavigationBar } from "../components/NavigationBar.jsx";

function App() {
  return (
    <>
      <BrowserRouter>
        <NavigationBar />
        <Routes />
      </BrowserRouter>
      <ToastContainer />
    </>
  )
}

export default App