export default async function handler(req, res) {
    const clientDetails = {
        redirect_uri: "/redirect",
        grant_type: "client_credentials",
        client_id: "15428",
        client_secret: "ktiopma89nmzx8"
    };
    try {
        const response = await fetch('https://www.orbyo.com/dev/internal/2.3/orbyo/oAuth/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(clientDetails)
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        res.status(200).json({ token: data.access_token });
    } catch (error) {
        console.error("Token fetch error:", error);
        res.status(500).json({ error: 'Failed to fetch token' });
    }
}
