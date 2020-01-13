import { ApplicationAction, ApplicationState, createRootReducer } from './index';
import { applyMiddleware, compose, createStore, Store } from 'redux';
import thunk, { ThunkMiddleware } from 'redux-thunk';
import { apiMiddleware } from './middleware/api';

declare global {
    interface Window {
        store?: Store<ApplicationState>;
        __REDUX_DEVTOOLS_EXTENSION_COMPOSE__: any;
    }
}

const composeEnhancers =
    typeof window === "object" && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__
        ? window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({})
        : compose;

export default (initialState: Partial<ApplicationState> = {}) =>
    createStore(
        createRootReducer(),
        initialState,
        composeEnhancers(
            applyMiddleware(
                thunk as ThunkMiddleware<ApplicationState, ApplicationAction>,
                apiMiddleware
            )
        )
    ) as Store<ApplicationState>;
