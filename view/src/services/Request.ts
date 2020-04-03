export const request = async (path: string, body: string): Promise<object> => {
    const request = new Request('http://localhost/' + path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body
    });

    return await fetch(request)
        .then(response => response.json())
        .catch(err => console.error(err))
    ;
};
