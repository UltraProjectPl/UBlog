import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

const resources = {
    en: {
        translation: {
            'app': {
                'not-found': 'Not found'
            },
            'email': 'Email',
            'password': 'Password',
            'nick': 'Nick',
            'birthDate': 'Date of birth',
            'register': {
                'sign-up': 'Sign up',
                'submit': 'Submit'
            },
            'security': {
                'sign-in': 'Sign in',
                'submit': 'Submit',
                'rememberMe': "Remember me",
                'logout': 'Logout'
            }
        },
    },
    pl: {
        translation: {
            'app': {
                'not-found': 'Nie znaleźono'
            },
            'email': 'Email',
            'password': 'Hasło',
            'nick': 'Nick',
            'birthDate': 'Data urodzenia',
            'register': {
                'sign-up': 'Zarejestruj się',
                'submit': 'Zarejestruj się za darmo!'
            },
            'security': {
                'sign-in': 'Zaloguj się',
                'submit': 'Zaloguj się',
                'rememberMe': 'Zapamiętaj mnie',
                'logout': 'Wyloguj'
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
