export const loadToken = (): string|null => {
    return localStorage.getItem('token');
};

export const saveToken = (token: string): void => {
    localStorage.setItem('token', token);
};