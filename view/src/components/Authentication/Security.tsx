import * as React from 'react';
import { useState } from 'react';
import { useDispatch } from '../../hooks/useDispatch';
import { useFormik } from 'formik';
import { security } from '../../store/authentication/actions';
import { SecuritySchema } from '../../store/authentication/types';
import { useTranslation } from 'react-i18next';
import {useSelector} from "../../hooks/useSelector";
import {Redirect} from "react-router-dom";

export const Security: React.FC = () => {
    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');
    const [rememberMe, setRememberMe] = useState<boolean>(false);

    const dispatch = useDispatch();
    const { t } = useTranslation();


    const formik = useFormik({
        initialValues: {
            email,
            password,
            rememberMe
        },
        validationSchema: SecuritySchema,
        onSubmit: values => {
            dispatch(security(values))
        }
    });

    const isRedirect = useSelector(state => state.authentication.isRedirect);
    if (isRedirect) {
        return <Redirect to="/" />
    }

    return (
        <div>
            <form onSubmit={formik.handleSubmit}>
                <div>
                    <label htmlFor="email">{t('email')}:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder={t('email') + '...'}
                        onChange={formik.handleChange}
                        value={formik.values.email}
                    />
                    {formik.errors.email}
                </div>
                <div>
                    <label htmlFor="password">{t('password')}:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder={t('password') + '...'}
                        onChange={formik.handleChange}
                        value={formik.values.password}
                    />
                    {formik.errors.password}
                </div>
                <div>
                    <label htmlFor="rememberMe">{t('rememberMe')}</label>
                    <input
                        type="checkbox"
                        id="rememberMe"
                        name="rememberMe"
                        onChange={formik.handleChange}
                        value={formik.values.rememberMe ? 1 : 0}
                    />
                </div>
                <button type="submit">{t('security.submit')}</button>
            </form>
        </div>
    );
};
