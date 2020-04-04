import { Action, combineReducers } from 'redux';
// @ts-ignore
import { ThunkDispatch } from 'redux-thunk';
import { AuthenticationActions } from './authentication/actions';
import { authenticationReducer } from './authentication/reducers';

export type ApplicationAction =
    | AuthenticationActions

export const createRootReducer = () => combineReducers({
    authentication: authenticationReducer
});

export type ApplicationState = ReturnType<ReturnType<typeof createRootReducer>>;

export type ThunkDispatch = ThunkDispatch<ApplicationState, {}, Action>;
