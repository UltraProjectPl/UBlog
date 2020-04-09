import React from 'react';
import './App.css';
import { Route } from 'react-router-dom';
import { Register } from "../Authentication/Register";
import { Security } from '../Authentication/Security';
import { Logout } from '../Authentication/Logout';
import { useSelector } from '../../hooks/useSelector';

export const App: React.FC = () => {
    const isAuthenticated = '' !== useSelector(state => state.authentication.token);
    const user = useSelector(state => state.user);

    return (
        <main>
            { isAuthenticated ? (
                 <Route path="/logout" component={Logout} />
            ) : (<>
                    <Route path="/register" component={Register} />
                    <Route path="/security" component={Security} />
                </>)}
        </main>
    );
};
