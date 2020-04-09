import * as Yup from 'yup';

export enum UserActionTypes {
    LOAD_DATA = '@@user/LOAD_DATA'
}

export interface UserLoadDataState {
    email: string;
}

export interface UserState {
    email: string,
    nick: string,
    birthDate: Date|undefined,
}

export const UserState = Yup.object().shape({
    email: Yup.string().email().required(),
    nick: Yup.string().required(),
    birthDate: Yup.date()
});
