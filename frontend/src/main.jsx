import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './app/App.jsx'
import {AuthContextProvider} from "./contexts/AuthContextProvider.jsx";

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <AuthContextProvider>
      <App />
    </AuthContextProvider>
  </React.StrictMode>,
)
