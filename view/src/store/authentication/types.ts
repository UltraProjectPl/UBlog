import * as Yup from 'yup';

export enum AuthenticationActionTypes {
    REGISTER = '@@authentication/REGISTER',
    SECURITY = '@@authentication/SECURITY',
    AUTHORIZATION = '@@authentication/AUTHORIZATION',
    REDIRECT_AFTER_REGISTER = '@@authentication/REDIRECT_AFTER_REGISTER'
}

export interface AuthenticationState {
    isAuthenticated: boolean
    email: string
    password: string
    token: string,
    isRedirect: boolean
}

export interface RegisterState {
    email: string
    password: string
}

export interface SecurityState {
    email: string
    password: string
    rememberMe: boolean
}

export const RegisterSchema = Yup.object().shape({
    email: Yup.string().email().required(),
    password: Yup.string().min(5).max(255).required(),
});

export const SecuritySchema = Yup.object().shape({
    email: Yup.string().email().required(),
    password: Yup.string().required(),
    requiredMe: Yup.bool().notRequired()
});
