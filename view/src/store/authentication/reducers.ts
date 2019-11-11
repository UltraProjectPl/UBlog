import { AuthenticationActionTypes, AuthenticationState, RegisterState } from './types';
import { Reducer } from 'redux';
import { AuthenticationActions } from './actions';

const initialState: AuthenticationState = {
    email: '',
    password: ''
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initialState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.REGISTER: {
            return {
                email: '',
                password: ''
            }
        }
        default: {
            return state
        }
    }
};
