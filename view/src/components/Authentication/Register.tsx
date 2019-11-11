import * as React from 'react';
import { useState } from 'react';
import { useDispatch } from '../../hooks/useDispatch';
import { useFormik } from 'formik';
import { AuthenticationActions } from '../../store/authentication/actions';
import { RegisterSchema } from '../../store/authentication/types';

export const Register: React.FC = () => {
    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');

    const dispatch = useDispatch();


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

    return (
        <div>
            <form onSubmit={formik.handleSubmit}>
                <div>
                    <label htmlFor="email">Email:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Email:"
                        onChange={formik.handleChange}
                        value={formik.values.email}
                    />
                    {formik.errors.email}
                </div>
                <div>
                    <label htmlFor="password">Password:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password:"
                        onChange={formik.handleChange}
                        value={formik.values.password}
                    />
                    {formik.errors.password}
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    );
};
