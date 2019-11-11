import { ApplicationAction, ApplicationState, createRootReducer } from './index';
import { applyMiddleware, compose, createStore, Store } from 'redux';
import thunk, { ThunkMiddleware } from 'redux-thunk';
import { apiMiddleware } from './middleware/api';

export default (initialState: Partial<ApplicationState> = {}) =>
    createStore(
        createRootReducer(),
        initialState,
        compose(applyMiddleware(
            thunk as ThunkMiddleware<ApplicationState, ApplicationAction>,
            apiMiddleware
        ))
    ) as Store<ApplicationState>;
