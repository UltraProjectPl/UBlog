export const request = async (path: string, body: string): Promise<Response> => {
    const request = new Request('http://localhost/' + path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body
    });

    return await fetch(request);
};
