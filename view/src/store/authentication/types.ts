export enum AuthenticationActionTypes {
    REGISTER = "@@authentication/REGISTER"
}

export interface AuthenticationState {
    email: string
    password: string
}

export interface RegisterState {
    email: string
    password: string
}
