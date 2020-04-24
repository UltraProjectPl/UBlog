import { Dispatch, Middleware, MiddlewareAPI } from 'redux';
import { ApplicationAction, ApplicationState, ThunkDispatch } from '../index';
import { AuthenticationActionTypes } from '../authentication/types';
import { get, post } from '../../services/Request';
import { AuthenticationActions } from '../authentication/actions';
import { UserActionTypes } from '../user/types';
import { UserActions } from '../user/actions';
import { validateLoadUserData, validateSecurity } from '../../api/validation';

export const apiMiddleware: Middleware = (api: MiddlewareAPI<ThunkDispatch, ApplicationState>) => {
    return (next: Dispatch) => async (action: ApplicationAction) => {
        switch (action.type) {
            case AuthenticationActionTypes.REGISTER: {
                const payload = action.payload;
                console.log(payload);

                const response = await post('auth/register', JSON.stringify(payload));

                api.dispatch(AuthenticationActions.redirectHomepage());

                break;
            }
            case AuthenticationActionTypes.SECURITY: {
                const payload = action.payload;

                const response = await post('auth/security', JSON.stringify(payload)) as { data: object };

                const dataResult = validateSecurity(response.data);

                if (dataResult.error !== null) {
                    throw new Error(`Invalid response from api. ${dataResult.error.message}`);
                }

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
            case UserActionTypes.LOAD_DATA: {
                const payload = action.payload;
                const token = api.getState().authentication.token;

                const response = await get(`user/data/${payload.email}`, token) as { data: object };

                const dataResult = validateLoadUserData(response.data);

                if (dataResult.error !== null) {
                    throw new Error(`Invalid response from api. ${dataResult.error.message}`);
                }

                // @ts-ignore
                api.dispatch(UserActions.saveData(response.data));

                break;
            }
        }
        return next(action);
    }
};
