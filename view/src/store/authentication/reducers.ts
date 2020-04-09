import {AuthenticationActionTypes, AuthenticationState} from './types';
import {Reducer} from 'redux';
import {AuthenticationActions} from './actions';

const initialState: AuthenticationState = {
    email: '',
    password: '',
    token: '',
    isRedirect: false
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initialState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.REDIRECT_HOMEPAGE: {
            return Object.assign({}, state, {
                isRedirect: true
            });
        }
        case AuthenticationActionTypes.AUTHORIZATION: {
            const payload = action.payload;

            return Object.assign({}, state, payload);
        }
        case AuthenticationActionTypes.LOGOUT: {
            return Object.assign({}, state, {
                token: ''
            })
        }
        default: {
            return state
        }
    }
};
