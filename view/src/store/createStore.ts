import { ApplicationAction, ApplicationState, createRootReducer } from './index';
import { applyMiddleware, compose, createStore, Store } from 'redux';
import thunk, { ThunkMiddleware } from 'redux-thunk';

export default (initialState: Partial<ApplicationState> = {}) =>
    createStore(
        createRootReducer(),
        initialState,
        compose(applyMiddleware(
            thunk as ThunkMiddleware<ApplicationState, ApplicationAction>
        ))
    ) as Store<ApplicationState>;
