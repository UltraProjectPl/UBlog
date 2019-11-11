import { Dispatch, Middleware, MiddlewareAPI } from 'redux';
import { ApplicationAction, ApplicationState, ThunkDispatch } from '../index';
import { AuthenticationActionTypes } from '../authentication/types';

export const apiMiddleware: Middleware = (api: MiddlewareAPI<ThunkDispatch, ApplicationState>) => {
    return (next: Dispatch) => async (action: ApplicationAction) => {
        switch (action.type) {
            case AuthenticationActionTypes.REGISTER: {
                const payload = action.payload;

                const request = new Request('http://localhost/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const response = await fetch(request);
            }
        }

        return next(action);
    }
};
