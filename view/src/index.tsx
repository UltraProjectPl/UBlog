import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { App } from './components/App/App';
import { Router } from 'react-router-dom'
import { Header } from './components/App/Header';
import { createBrowserHistory } from 'history';
import {loadToken, saveToken} from './services/LocalStorage';
import createStore from './store/createStore';
import * as serviceWorker from './serviceWorker';
import './i18n';
import './index.css';

let initialState = {};

const loadTokenFromStorage = loadToken();
if (null !== loadTokenFromStorage) {
    initialState = {
        authentication: {
            token: loadTokenFromStorage
        }
    };
}

const store = createStore(initialState);
const history = createBrowserHistory();

const container = document.querySelector('#root');

store.subscribe(() => {
    saveToken(store.getState().authentication.token);
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
