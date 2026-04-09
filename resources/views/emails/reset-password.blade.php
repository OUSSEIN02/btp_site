<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px;">
        
        <h2 style="color:#1a3a8f;">Réinitialisation du mot de passe</h2>

        <p>Bonjour,</p>

        <p>Vous avez demandé à réinitialiser votre mot de passe.</p>

        <p style="text-align:center; margin:30px 0;">
            <a href="{{ $url }}" 
               style="background:#1a3a8f; color:white; padding:12px 20px; border-radius:5px; text-decoration:none;">
                Réinitialiser mon mot de passe
            </a>
        </p>

        <p>Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.</p>

        <p style="margin-top:30px; font-size:12px; color:#999;">
            Ce lien expire dans 60 minutes.
        </p>

    </div>

</body>
</html>