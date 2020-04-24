import * as React from 'react';
import { useSelector } from '../../hooks/useSelector';
import { useTranslation} from 'react-i18next';

export const Profile: React.FC = () => {
    const user = useSelector(state => state.user);
    const { t } = useTranslation();

    return (
        <>
            <p>{t('nick')}: {user.nick}</p>
            <p>{t('email')}: {user.email}</p>
            <p>{t('birthDate')}:: {user.birthDate}</p>
        </>
    )
};