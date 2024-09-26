<p>Cher(e) <b>{{ $user->name }}</b>,</p>
<br>
<p>
    Vous recevez cet e-mail parce que vous avez demandé à réinitialiser votre mot de passe sur {{ get_settings()->site_name }}.
</p>
<p>
    Veuillez utiliser le lien ci-dessous pour le réinitialiser.
    <a href="{{ $actionLink }}" target="_blank">{{ $actionLink }}</a><br>
</p>
<p>
    Ce lien de réinitialisation du mot de passe est valable uniquement pendant les 15 prochaines minutes.
</p>
<p>
    Si vous rencontrez des problèmes avec le lien ci-dessus, copiez-le et collez-le dans votre navigateur web.
</p>
<p>
    NB : SI VOUS N'AVEZ PAS DEMANDÉ DE RÉINITIALISATION DE MOT DE PASSE, VEUILLEZ IGNORER CET E-MAIL.
</p>
<br>
----------------------------------------------
<p>
    Cet e-mail a été envoyé automatiquement par {{ get_settings()->site_name }}. Ne répondez pas à ce message.
</p>
