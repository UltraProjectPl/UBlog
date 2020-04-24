export const post = async (path: string, body: string): Promise<object> => {
    const headers = {
        'Content-Type': 'application/json'

    }

    const request = new Request('http://localhost/api/v1/' + path, {
        method: 'POST',
        headers,
        body
    });

    return await fetch(request)
        .then(response => response.json())
        .catch(err => console.error(err))
    ;
};

export const get = async (path: string, token: string|undefined = undefined): Promise<object> => {
    let headers = {};

    if (token !== undefined) {
        headers = Object.assign({
            ...headers,
            'X-AUTH-TOKEN': token
        })
    }

    const request = new Request('http://localhost/api/v1/' + path, {
        method: 'GET',
        headers,
    });

    return await fetch(request)
        .then(response => response.json())
        .catch(err => console.error(err))
    ;
};