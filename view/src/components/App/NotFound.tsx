import React from "react";
import { useTranslation } from 'react-i18next';

export const NotFound: React.FC = () => {
    const { t } = useTranslation();

    return (
        <div>
            <h3>{t('app.not-found')}</h3>
        </div>
    )
};