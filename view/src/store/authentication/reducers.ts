import { AuthenticationActionTypes, AuthenticationState } from './types';
import { Reducer } from 'redux';
import { AuthenticationActions } from './actions';

const initialState: AuthenticationState = {
    email: '',
    password: '',
    token: ''
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initialState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.REGISTER: {
            return Object.assign({}, state, {
                email: '',
                password: '',
                token: ''
            })
        }
        case AuthenticationActionTypes.SECURITY: {
            return Object.assign({}, state, {
                email: '',
                password: '',
                token: ''
            })
        }
        default: {
            return state
        }
    }
};
