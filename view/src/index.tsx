import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import './index.css';
import { App } from './components/App/App';
import * as serviceWorker from './serviceWorker';
import createStore from './store/createStore';
import { Route, Router } from 'react-router-dom'
import { Register } from './components/Authentication/Register';
import { Security } from './components/Authentication/Security';
import { Header } from './components/App/Header';
import { createBrowserHistory } from 'history';
import './i18n';

const store = createStore();
const history = createBrowserHistory();

const container = document.querySelector('#root');

ReactDOM.render(
    <Provider store={store}>
         <Router history={history}>
             <Header />
             {store.getState().authentication.isAuthenticated ? <p>true</p> : <p>false</p>}
             <App />
         </Router>
    </Provider>,
    container
);

serviceWorker.unregister();
