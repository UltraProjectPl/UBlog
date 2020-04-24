import {UserActionTypes, UserLoadDataState, UserSaveDataState} from './types';
import { ActionsUnion, createAction } from '../createAction';

export const UserActions = {
    loadData: (p: UserLoadDataState) =>
        createAction(UserActionTypes.LOAD_DATA, p),
    saveData: (p: UserSaveDataState) =>
        createAction(UserActionTypes.SAVE_DATA, p),
};

export type UserActions = ActionsUnion<typeof UserActions>
