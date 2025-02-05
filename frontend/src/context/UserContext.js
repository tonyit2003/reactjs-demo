const { createContext, useState } = require("react");

const UserContext = createContext();

const UserProvider = ({ children }) => {
    const [user, setUser] = useState({ email: "", auth: false });

    const login = (email) => {
        setUser({ email, auth: true });
    };

    const logout = () => {
        setUser({ email: "", auth: false });
    };

    return (
        <UserContext.Provider value={{ user, login, logout }}>
            {children}
        </UserContext.Provider>
    );
};

export { UserContext, UserProvider };
