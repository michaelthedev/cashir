import { useContext } from "react";
import { useState } from "react";
import { createContext } from "react";
import PropTypes from "prop-types";

const AuthContext = createContext({
  user: null,
  userToken: null,
  setUser: () => {},
  setUserToken: () => {},
});

export const AuthContextProvider = ({ children }) => {
  const [user, setUser] = useState(null);

  const [userToken, _setUserToken] = useState(localStorage.getItem('TOKEN') || '');

  const setUserToken = (token) => {
    if (token) {
      localStorage.setItem('TOKEN', token)
    } else {
      localStorage.removeItem('TOKEN')
    }

    _setUserToken(token);
  }

  return (
    <AuthContext.Provider
      value={{
        user,
        setUser,
        userToken,
        setUserToken
      }}
    >
      {children}
    </AuthContext.Provider>
  );
};

AuthContextProvider.propTypes = {
  children: PropTypes.node
}

export const useStateContext = () => useContext(AuthContext);