const CLIENT_ID = '280639681515-s3mthshvuqqc19s138j87o37br67qf9b.apps.googleusercontent.com';
const API_KEY = 'AIzaSyAkny1c8SJ6aULXbTWZT0QFXXmxjcSnAL4';
const SCOPES = 'https://www.googleapis.com/auth/admin.directory.user';

// Fonction pour vérifier si on est déjà co au chargement d'une page
function checkAuth() {
    const token = localStorage.getItem('google_token');
    const expiry = localStorage.getItem('token_expiry');

    if (!token || Date.now() > expiry) {
        if (!window.location.href.includes('index.html')) {
            window.location.href = 'index.html';
        }
    } else {
        // Si on a un token valide, on l'injecte dans gapi (si gapi est chargé)
        if (typeof gapi !== 'undefined' && gapi.client) {
            gapi.client.setToken(JSON.parse(token));
        }
    }
}

// Pour parser les infos utilisateur du bouton Google
function parseJwt(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    return JSON.parse(decodeURIComponent(atob(base64).split('').map(c => '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)).join('')));
}

function logout() {
    localStorage.clear();
    window.location.href = 'index.html';
}
