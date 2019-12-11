import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

const resources = {
    en: {
        translation: {
            'email': 'Email',
            'password': 'Password',
            'register': {
                'sign-up': 'Sign up',
                'submit': 'Submit'
            },
            'security': {
                'sign-in': 'Sign in',
                'submit': 'Submit',
                'rememberMe': "Remember me"
            }
        },
    },
    pl: {
        translation: {
            'email': 'Email',
            'password': 'Hasło',
            'register': {
                'sign-up': 'Zarejestruj się',
                'submit': 'Zarejestruj się za darmo!'
            },
            'security': {
                'sign-in': 'Zaloguj się',
                'submit': 'Zaloguj się',
                'rememberMe': "Zapamiętaj mnie"
            }
        }
    }
};

i18n
    .use(initReactI18next)
    .init({
        resources,
        lng: 'en',
        interpolation: {
            escapeValue: false
        }
    });

export default i18n;
