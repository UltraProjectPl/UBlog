import { AuthenticationActionTypes, RegisterState } from './types';
import { ActionsUnion, createAction } from '../createAction';

export const AuthenticationActions = {
    register: (p: RegisterState) =>
        createAction(AuthenticationActionTypes.REGISTER, p)
};

export type AuthenticationActions = ActionsUnion<typeof AuthenticationActions>
