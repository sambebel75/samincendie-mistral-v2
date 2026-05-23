exports.handler = async function (event) {
  // CORS preflight
  if (event.httpMethod === 'OPTIONS') {
    return {
      statusCode: 204,
      headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'POST, OPTIONS',
        'Access-Control-Allow-Headers': 'Content-Type',
      },
      body: '',
    };
  }

  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: JSON.stringify({ error: 'Method not allowed' }) };
  }

  try {
    const { email, firstName } = JSON.parse(event.body || '{}');

    if (!email || !firstName) {
      return {
        statusCode: 400,
        body: JSON.stringify({ error: 'Email et prénom requis' }),
      };
    }

    const res = await fetch('https://api.systeme.io/api/contacts', {
      method: 'POST',
      headers: {
        'X-API-Key': process.env.SYSTEME_API_KEY,
        'Content-Type': 'application/json',
        accept: 'application/json',
      },
      body: JSON.stringify({
        email,
        firstName,
        tags: [{ name: 'kit-gratuit-instagram' }],
      }),
    });

    const data = await res.json();

    if (!res.ok) {
      console.error('Systeme.io error:', data);
      return {
        statusCode: res.status,
        headers: { 'Access-Control-Allow-Origin': '*' },
        body: JSON.stringify({ error: 'Erreur Systeme.io', details: data }),
      };
    }

    return {
      statusCode: 200,
      headers: {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*',
      },
      body: JSON.stringify({ success: true }),
    };
  } catch (err) {
    console.error('Function error:', err);
    return {
      statusCode: 500,
      headers: { 'Access-Control-Allow-Origin': '*' },
      body: JSON.stringify({ error: 'Erreur serveur' }),
    };
  }
};
