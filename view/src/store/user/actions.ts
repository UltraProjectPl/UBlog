import { UserActionTypes, UserLoadDataState } from './types';
import { ActionsUnion, createAction } from '../createAction';

export const UserActions = {
    loadData: (p: UserLoadDataState) =>
        createAction(UserActionTypes.LOAD_DATA, p),
};

export type UserActions = ActionsUnion<typeof UserActions>
