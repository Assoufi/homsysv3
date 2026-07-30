<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #2c3e50; line-height: 1.6; }
        .email-wrap { max-width: 560px; margin: 0 auto; padding: 20px; }
        .email-header { text-align: center; padding: 20px 0; border-bottom: 2px solid #007bff; }
        .email-header img { max-height: 50px; }
        .email-body { padding: 24px 0; }
        .email-body h2 { color: #2c3e50; font-size: 1.3rem; }
        .email-body p { color: #475569; margin-bottom: 16px; }
        .btn-reset {
            display: inline-block;
            background: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 5px;
            margin: 16px 0;
        }
        .btn-reset:hover { background: #0056b3; }
        .email-footer { border-top: 1px solid #e2e8f0; padding-top: 16px; font-size: 0.85rem; color: #64748b; }
        .email-footer a { color: #007bff; }
    </style>
</head>
<body>
    <div class="email-wrap">
        <div class="email-header">
            <img src="{{ url('img/logo.png') }}" alt="HOMSYS">
        </div>

        <div class="email-body">
            <h2>Réinitialisation de votre mot de passe</h2>
            <p>Bonjour,</p>
            <p>Vous avez demandé la réinitialisation de votre mot de passe pour votre compte HOMSYS.</p>
            <p>Cliquez sur le bouton ci-dessous pour choisir un nouveau mot de passe :</p>

            <p style="text-align: center;">
                <a href="{{ $link }}" class="btn-reset">
                    <i class="fa fa-key"></i> Réinitialiser mon mot de passe
                </a>
            </p>

            <p style="color: #d9534f; font-size: 0.9rem;">
                <strong>Important :</strong> Ce lien expire dans 60 minutes. Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.
            </p>

            <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :</p>
            <p style="font-size: 0.85rem; word-break: break-all; color: #007bff;">{{ $link }}</p>
        </div>

        <div class="email-footer">
            <p>Cordialement,<br><strong>L'équipe HOMSYS</strong></p>
            <p>
                <a href="{{ url('/') }}">www.homsys.ma</a> &bull;
                <a href="{{ url('mails/contactus') }}">Contact</a>
            </p>
        </div>
    </div>
</body>
</html>