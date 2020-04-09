import { UserActionTypes, UserState } from './types';
import { ActionsUnion, createAction } from '../createAction';

export const UserActions = {
    loadData: (p: UserState) =>
        createAction(UserActionTypes.LOAD_DATA, p),
};

export type UserActions = ActionsUnion<typeof UserActions>
