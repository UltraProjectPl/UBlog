import { AuthenticationActionTypes, AuthenticationState, RegisterState } from './types';
import { Reducer } from 'redux';
import { AuthenticationActions } from './actions';

const initalState: AuthenticationState = {
    email: '',
    password: ''
};

export const authenticationReducer: Reducer<
    AuthenticationState,
    AuthenticationActions
> = (state = initalState, action) => {
    switch (action.type) {
        case AuthenticationActionTypes.REGISTER: {
            return {
                email: '',
                password: ''
            }
        }
        default:
            return state
    }
};
