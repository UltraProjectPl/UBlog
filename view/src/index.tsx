import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import './index.css';
import { App } from './components/App/App';
import * as serviceWorker from './serviceWorker';
import createStore from './store/createStore';
import { Route, BrowserRouter as Router } from 'react-router-dom'
import { Register } from './components/Authentication/Register';
import { Header } from './components/App/Header';

const store = createStore();

const container = document.querySelector('#root');

ReactDOM.render(
    <Provider store={store}>
        <Router>
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
