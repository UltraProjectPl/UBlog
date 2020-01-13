import * as React from 'react';
import { useState } from 'react';
import { useDispatch } from '../../hooks/useDispatch';
import { useFormik } from 'formik';
import { AuthenticationActions } from '../../store/authentication/actions';
import { RegisterSchema } from '../../store/authentication/types';
import { useTranslation } from 'react-i18next';
import { Redirect } from 'react-router-dom';
import { useSelector } from '../../hooks/useSelector';

export const Register: React.FC = () => {
    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');

    const dispatch = useDispatch();
    const { t } = useTranslation();

    const formik = useFormik({
        initialValues: {
            email,
            password
        },
        validationSchema: RegisterSchema,
        onSubmit: values => {
            dispatch(AuthenticationActions.register(values))
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
                <button type="submit">{t('register.submit')}</button>
            </form>
        </div>
    );
};
