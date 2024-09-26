<p>Cher(e) {{ $user->name }}</p><br>
<p>
    Votre mot de passe sur {{ get_settings()->site_name }} a été changé avec succès. Voici vos nouvelles informations de connexion :
    <br>
    <b>ID de connexion : </b>{{ isset($user->username) ? $user->username.' ou ' : '' }} {{ $user->email }}
    <br>
    <b>Mot de passe : </b>{{ $new_password }}
</p>
<br>
Veuillez garder vos informations confidentielles. Votre ID de connexion et votre mot de passe sont personnels et vous ne devez les partager avec personne d'autre.

<p>
    {{ get_settings()->site_name }} ne pourra être tenu responsable de tout usage inapproprié de votre ID de connexion ou de votre mot de passe.
</p>
<br>
---------------------------------------
<p>
    Cet e-mail a été envoyé automatiquement par {{ get_settings()->site_name }}. Ne répondez pas à ce message.
</p>
