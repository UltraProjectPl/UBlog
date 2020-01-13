import { AuthenticationActionTypes, AuthenticationState } from './types';
import { Reducer } from 'redux';
import { AuthenticationActions } from './actions';

const initialState: AuthenticationState = {
    email: '',
    password: '',
    token: '',
    isAuthenticated: false,
    isRedirect: false
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initialState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.REDIRECT_AFTER_REGISTER: {
            return Object.assign({}, state, {
                isRedirect: true
            });
        }
        case AuthenticationActionTypes.AUTHORIZATION: {
            const payload = action.payload;

            return Object.assign({}, state, payload);
        }
        default: {
            return state
        }
    }
};
