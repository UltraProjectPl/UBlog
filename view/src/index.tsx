import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import './index.css';
import { App } from './components/App/App';
import * as serviceWorker from './serviceWorker';
import createStore from './store/createStore';
import { Route, Router } from 'react-router-dom'
import { Register } from './components/Authentication/Register';
import { Header } from './components/App/Header';
import './i18n';
import { createBrowserHistory } from 'history';

const store = createStore();
const history = createBrowserHistory();

const container = document.querySelector('#root');

ReactDOM.render(
    <Provider store={store}>
        <Router history={history}>
            <Header />
            <main>
                <Route path="/" component={App} />
                <Route path="/register" component={Register} />
            </main>
        </Router>
    </Provider>,
    container
);

serviceWorker.unregister();
