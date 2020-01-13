import { AuthenticationActionTypes, AuthenticationState, RegisterState, SecurityState } from './types';
import { ActionsUnion, createAction } from '../createAction';

export const AuthenticationActions = {
    authorization: (p: AuthenticationState) =>
        createAction(AuthenticationActionTypes.AUTHORIZATION, p),
    register: (p: RegisterState) =>
        createAction(AuthenticationActionTypes.REGISTER, p),
    security: (p: SecurityState) =>
        createAction(AuthenticationActionTypes.SECURITY, p),
    redirectAfterRegister: () =>
        createAction(AuthenticationActionTypes.REDIRECT_AFTER_REGISTER)
};

export type AuthenticationActions = ActionsUnion<typeof AuthenticationActions>
