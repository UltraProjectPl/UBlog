import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { App } from './components/App/App';
import { Router } from 'react-router-dom'
import { Header } from './components/App/Header';
import { createBrowserHistory } from 'history';
import createStore from './store/createStore';
import * as serviceWorker from './serviceWorker';
import './i18n';
import './index.css';

// @ts-ignore
const persistedState = localStorage.getItem('state') ? JSON.parse(localStorage.getItem('state')) : {};

const store = createStore(persistedState);
const history = createBrowserHistory();

const container = document.querySelector('#root');

store.subscribe(() => {
    localStorage.setItem('state', JSON.stringify(store.getState()));
});

ReactDOM.render(
    <Provider store={store}>
         <Router history={history}>
             <Header />
             <App />
         </Router>
    </Provider>,
    container
);

serviceWorker.unregister();
