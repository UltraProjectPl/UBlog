import React from 'react';
import './App.css';
import { Route } from 'react-router-dom';
import { Register } from "../Authentication/Register";
import { Security } from '../Authentication/Security';
import { useSelector } from '../../hooks/useSelector';

export const App: React.FC = () => {
    const isAuthenticated = useSelector(state => state.authentication.isAuthenticated);

    return (
        <main>
            {isAuthenticated ? (
                <Route path="/logout" />
            ) : (<>
                    <Route path="/register" component={Register} />
                    <Route path="/security" component={Security} />
                </>)}
        </main>
    );
};
