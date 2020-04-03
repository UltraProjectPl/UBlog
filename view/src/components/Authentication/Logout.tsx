import * as React from 'react';
import { useDispatch } from '../../hooks/useDispatch';
import { AuthenticationActions } from '../../store/authentication/actions';
import { Redirect } from 'react-router-dom';

export const Logout: React.FC = () => {
    const dispatch = useDispatch();
    dispatch(AuthenticationActions.logout());

    return <Redirect to="/"/>
};
