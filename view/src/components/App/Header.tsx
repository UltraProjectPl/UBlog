import React from 'react';
import './App.css';
import { Link } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { useSelector } from '../../hooks/useSelector';

export const Header: React.FC = () => {
    const { t } = useTranslation();
    const isAuthenticated = '' !== useSelector(state => state.authentication.token);

    return (
        <header>
            <nav>
                <ul>
                    <li>
                        <Link to="/">UBlog</Link>
                    </li>
                    { isAuthenticated ? (
                        <Link to="/logout">{t('security.logout')}</Link>

                    ) : (<>
                        <li>
                            <Link to="/register">{t('register.sign-up')}</Link>
                        </li>
                        <li>
                            <Link to="/security">{t('security.sign-in')}</Link>
                        </li>
                    </>)}
                </ul>
            </nav>
        </header>
    );
};