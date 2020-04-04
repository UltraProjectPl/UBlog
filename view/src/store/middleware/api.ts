import { Dispatch, Middleware, MiddlewareAPI } from 'redux';
import { ApplicationAction, ApplicationState, ThunkDispatch } from '../index';
import { AuthenticationActionTypes } from '../authentication/types';
import { request } from '../../services/Request';
import { AuthenticationActions } from '../authentication/actions';

export const apiMiddleware: Middleware = (api: MiddlewareAPI<ThunkDispatch, ApplicationState>) => {
    return (next: Dispatch) => async (action: ApplicationAction) => {
        switch (action.type) {
            case AuthenticationActionTypes.REGISTER: {
                const payload = action.payload;
                console.log(payload);

                const response = await request('auth/register', JSON.stringify(payload));

                api.dispatch(AuthenticationActions.redirectHomepage());

                break;
            }
            case AuthenticationActionTypes.SECURITY: {
                const payload = action.payload;

                const response = await request('auth/security', JSON.stringify(payload));

                if ('token' in response) {
                    api.dispatch(AuthenticationActions.authorization({
                        // @ts-ignore
                        token: response.token,
                        isRedirect: false,
                        ...payload
                    }));
                    api.dispatch(AuthenticationActions.redirectHomepage());
                }

                break;
            }
        }

        return next(action);
    }
};
