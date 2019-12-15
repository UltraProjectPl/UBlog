import { Dispatch, Middleware, MiddlewareAPI } from 'redux';
import { ApplicationAction, ApplicationState, ThunkDispatch } from '../index';
import { AuthenticationActionTypes } from '../authentication/types';
import { request } from '../../services/Request';

export const apiMiddleware: Middleware = (api: MiddlewareAPI<ThunkDispatch, ApplicationState>) => {
    return (next: Dispatch) => async (action: ApplicationAction) => {
        switch (action.type) {
            case AuthenticationActionTypes.REGISTER: {
                const payload = action.payload;

                const response = request('auth/register', JSON.stringify(payload));

                break;
            }
            case AuthenticationActionTypes.SECURITY: {
                const payload = action.payload;

                const response = request('auth/security', JSON.stringify(payload));
                break;
            }
        }

        return next(action);
    }
};
