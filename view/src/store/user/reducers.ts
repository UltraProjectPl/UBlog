import {UserActionTypes, UserState} from './types';
import { Reducer } from 'redux';
import { UserActions } from './actions';

const initialState: UserState = {
    nick: '',
    email: '',
    birthDate: undefined
};

export const userReducer: Reducer<
    UserState,
    UserActions
> = (state = initialState, action) => {
    switch (action.type) {
        case UserActionTypes.SAVE_DATA: {
            const payload = action.payload as UserState;

            return {
                ...payload,
            }
        }
        default: {
            return state
        }
    }
};
