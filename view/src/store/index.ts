import { combineReducers } from 'redux';
import { AuthenticationActions } from './authentication/actions';
import { authenticationReducer } from './authentication/reducers';

export type ApplicationAction =
    | AuthenticationActions

export const createRootReducer = () => combineReducers({
    auth: authenticationReducer
});

export type ApplicationState = ReturnType<ReturnType<typeof createRootReducer>>;
