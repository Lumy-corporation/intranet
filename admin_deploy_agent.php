<?php
// admin_deploy_agent.php - Système de Déploiement d'Agents Lumy Corp

// 1. Protection de la page (Seulement toi, le PDG, peux y accéder)
// session_start();
// if($_SESSION['user_grade'] !== 'PDG') { die('Accès refusé - Autorisation de Niveau 5 requise.'); }

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $recovery_email = htmlspecialchars($_POST['recovery_email']);
    $ou = $_POST['ou'];
    
    // Génération automatique de l'email Lumy Corp (ex: j.dupont@lumycorp.com)
    $lumy_email = strtolower(substr($firstname, 0, 1) . "." . $lastname . "@lumycorp.com");
    
    // ICI : Plus tard, on insérera le code de l'API Google pour la création réelle
    // Pour l'instant, on simule la réussite
    $message = "<div class='success'>L'agent $firstname $lastname a été déployé avec succès : <strong>$lumy_email</strong></div>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>LUMY CORP - Déploiement d'Agent</title>
    <style>
        :root { --accent: #007bff; --bg: #0a0a0a; --card: #151515; }
        body { background: var(--bg); color: white; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .container { max-width: 600px; margin: 50px auto; }
        .card { background: var(--card); padding: 30px; border-radius: 10px; border-left: 5px solid var(--accent); box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        h2 { text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #888; font-size: 0.9em; }
        input, select { width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; box-sizing: border-box; }
        .btn-deploy { background: var(--accent); color: white; border: none; padding: 15px 25px; width: 100%; border-radius: 5px; cursor: pointer; font-weight: bold; text-transform: uppercase; transition: 0.3s; }
        .btn-deploy:hover { background: #0056b3; box-shadow: 0 0 15px var(--accent); }
        .success { background: #1b5e20; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #2e7d32; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>🚀 Déploiement Nouvel Agent</h2>
        <p>Interface de synchronisation directe Google Workspace Pro.</p>
        
        <?php echo $message; ?>

        <form method="POST" action="">
            <div class="form-group" style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label>Prénom</label>
                    <input type="text" name="firstname" required placeholder="Jean">
                </div>
                <div style="flex: 1;">
                    <label>Nom</label>
                    <input type="text" name="lastname" required placeholder="Dupont">
                </div>
            </div>

            <div class="form-group">
                <label>Email de récupération (Personnel)</label>
                <input type="email" name="recovery_email" required placeholder="perso@gmail.com">
            </div>

            <div class="form-group">
                <label>Unité Organisationnelle (Google OU)</label>
                <select name="ou">
                    <option value="/Agents">/Agents (Standard)</option>
                    <option value="/Vietnam">/Vietnam (Zone 02)</option>
                    <option value="/Admin">/Administration (Niveau 5)</option>
                </select>
            </div>

            <button type="submit" class="btn-deploy">⚡ Créer le compte Google Pro</button>
        </form>
    </div>
</div>

</body>
</html>
