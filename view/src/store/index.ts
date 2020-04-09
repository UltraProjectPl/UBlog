import { Action, combineReducers } from 'redux';
// @ts-ignore
import { ThunkDispatch } from 'redux-thunk';
import { AuthenticationActions } from './authentication/actions';
import { authenticationReducer } from './authentication/reducers';
import { userReducer } from './user/reducers';
import {UserActions} from "./user/actions";

export type ApplicationAction =
    | AuthenticationActions
    | UserActions

export const createRootReducer = () => combineReducers({
    authentication: authenticationReducer,
    user: userReducer
});

export type ApplicationState = ReturnType<ReturnType<typeof createRootReducer>>;

export type ThunkDispatch = ThunkDispatch<ApplicationState, {}, Action>;
