const CLIENT_ID = '280639681515-s3mthshvuqqc19s138j87o37br67qf9b.apps.googleusercontent.com';
const API_KEY = 'AIzaSyAkny1c8SJ6aULXbTWZT0QFXXmxjcSnAL4';
const SCOPES = 'https://www.googleapis.com/auth/admin.directory.user';

// --- LE GARDIEN (Vérification de session) ---
function checkAuth() {
    const isAuth = localStorage.getItem('isAuth');
    const expiry = localStorage.getItem('token_expiry');

    // Si on n'est pas sur la page de connexion ET qu'on n'est pas identifié
    if (!window.location.href.includes('index.html')) {
        if (!isAuth || (expiry && Date.now() > expiry)) {
            console.log("🚫 Accès refusé ou session expirée. Direction Accueil.");
            localStorage.clear();
            window.location.href = 'index.html';
        }
    }
}

// --- PARSER LES INFOS GOOGLE ---
function parseJwt(token) {
    try {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        return JSON.parse(decodeURIComponent(atob(base64).split('').map(c => '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)).join('')));
    } catch (e) {
        console.error("Erreur de décodage JWT", e);
        return null;
    }
}

// --- DÉCONNEXION ---
function logout() {
    localStorage.clear();
    window.location.href = 'index.html';
}

// Lancer la vérification immédiatement au chargement du script
checkAuth();
