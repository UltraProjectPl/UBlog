import { ApplicationState, createRootReducer } from './index';
import { applyMiddleware, compose, createStore } from 'redux';

export default (initialState: Partial<ApplicationState> = {}) =>
    createStore(
        createRootReducer,
        initialState,
        compose(applyMiddleware())
    );
