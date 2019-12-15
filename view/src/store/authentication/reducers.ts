import { AuthenticationActionTypes, AuthenticationState } from './types';
import { Reducer } from 'redux';
import { AuthenticationActions } from './actions';

const initialState: AuthenticationState = {
    email: '',
    password: '',
    token: '',
    isAuthenticated: false
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initialState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.AUTHORIZATION: {
            const payload = action.payload;
            console.log(payload);

            return Object.assign({}, state, payload)
        }
        default: {
            return state
        }
    }
};
