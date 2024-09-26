<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\DB;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\File;
use App\Models\Concession;
use Toastr;

class UserController extends Controller
{
    public function login(Request $request){
        $data = [
            'pageTitle'=>'Connexion'
        ];
        return view('back.pages.user.auth.login',$data);
    } //End Method

    public function register(Request $request){
        $data = [
            'pageTitle'=>'Création de compte'
        ];
        return view('back.pages.user.auth.register',$data);
    } //End Method

    public function home(Request $request){
        $data = [
            'pageTitle'=>'Tableau de bord'
        ];
        return view('back.pages.user.home',$data);
    } //End Method

    public function createUser(Request $request){
        //Validate User Registration Form
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password'=>'min:8|max:45'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $saved = $user->save();

        if( $saved ){
           //Generate token
           $token = base64_encode(Str::random(64));

           VerificationToken::create([
              'user_type'=>'user',
              'email'=>$request->email,
              'token'=>$token
           ]);

           $actionLink = route('user.verify',['token'=>$token]);
           $data['action_link'] = $actionLink;
           $data['user_name'] = $request->name;
           $data['user_email'] = $request->email;

           //Send Activation link to this user email
           $mail_body = view('email-templates.user-verify-template',$data)->render();

           $mailConfig = array(
              'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
              'mail_from_name'=>env('EMAIL_FROM_NAME'),
              'mail_recipient_email'=>$request->email,
              'mail_recipient_name'=>$request->name,
              'mail_subject'=>'Verify User Account',
              'mail_body'=>$mail_body
           );

           if( sendEmail($mailConfig) ){
              return redirect()->route('user.register-success')->with('success','Vous avez reçu un lien de verification consulter votre email.');
           }else{
             return redirect()->route('user.register')->with('fail','Votre email est déjà vérifié.');
           }
        }else{
            return redirect()->route('user.register')->with('fail','Une erreur s\'est produite lors de l\'envoi du lien de vérification.');
        }
    } //End Method

    public function verifyAccount(Request $requet, $token){
        $verifyToken = VerificationToken::where('token',$token)->first();

        if( !is_null($verifyToken) ){
            $user = User::where('email',$verifyToken->email)->first();

            if( !$user->verified ){
                $user->verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->save();

                return redirect()->route('user.login')->with('success','Votre email est vérifié. Connectez-vous');
            }else{
                return redirect()->route('user.login')->with('info','Votre e-mail est déjà vérifié. Connectez-vous');
            }
        }else{
            return redirect()->route('user.register')->with('fail','Lien invalide.');
        }
    } //End Method

    public function registerSuccess(Request $request){
        return view('back.pages.user.register-success');
    } //End Method

    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if( $fieldType == 'email' ){
            $request->validate([
                'login_id'=>'required|email|exists:users,email',
                'password'=>'required|min:8|max:45'
            ],[
                'login_id.required'=>'L\'email ou le nom d\'utilisateur est requis.',
                'login_id.email'=>'Adresse email invalide.',
                'login_id.exists'=>'L\'email n\'existe pas dans le système.',
                'password.required'=>'Le mot de passe est requis'
            ]);
        }else{
            $request->validate([
                'login_id'=>'required|exists:users,username',
                'password'=>'required|min:8|max:45'
            ],[
                'login_id.required'=>'L\'email ou le nom d\'utilisateur est requis.',
                'login_id.exists'=>'Le nom d\'utilisateur n\'existe pas dans le système.',
                'password.required'=>'Le mot de passe est requis'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );

       if (Auth::guard('user')->attempt($creds)) {
        // Récupérer l'utilisateur connecté
        $user = auth('user')->user();

        // Vérifier le statut du compte
        if ($user->status == 0) {
            // Déconnecter l'utilisateur et rediriger avec un message d'erreur
            Auth::guard('user')->logout();
            return redirect()->route('user.login')->with('fail', 'Votre compte a été suspendu.');
        } elseif (!$user->verified) {
            // Déconnecter l'utilisateur et rediriger avec un message d'erreur pour compte non vérifié
            Auth::guard('user')->logout();
            return redirect()->route('user.login')->with('fail', 'Votre compte n\'est pas vérifié. Vérifiez votre email et cliquez sur le lien que nous avons envoyé pour vérifier votre compte.');
        } else {
            // Connexion réussie et redirection vers la page d'accueil
            return redirect()->route('user.home');
        }
    } else {
        // Échec de la connexion, redirection avec un message d'erreur
        return redirect()->route('user.login')->withInput()->with('fail', 'Mot de passe incorrect.');
     }
    } //End Method

    public function logoutHandler(Request $request){
        Auth::guard('user')->logout();
        return redirect()->route('user.login')->with('fail','Vous etes deconnecter !');
    } //End Method

    public function forgotPassword(Request $request){
       $data = [
        'pageTitle' => 'Forgot Password'
       ];
       return view('back.pages.user.auth.forgot',$data);
    } //End Method

    public function sendPasswordResetLink(Request $request){
        //Validate the form
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ],[
            'email.required'=>'L\'email est requis',
            'email.email'=>'Adresse email invalide',
            'email.exists'=>'L\'email n\'existe pas dans le système'
        ]);

        //Get User details
        $user = User::where('email',$request->email)->first();

        //Generate token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing reset password token for this user
        $oldToken = DB::table('password_reset_tokens')
                      ->where(['email'=>$user->email])
                      ->first();

        if( $oldToken ){
            //UPDATE EXISTING TOKEN
            DB::table('password_reset_tokens')
              ->where(['email'=>$user->email])
              ->update([
                'token'=>$token,
                'created_at'=>Carbon::now()
              ]);
        }else{
           //INSERT NEW RESET PASSWORD TOKEN
           DB::table('password_reset_tokens')
             ->insert([
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now()
             ]);
        }

        $actionLink = route('user.reset-password',['token'=>$token,'email'=>urlencode($user->email)]);

        $data['actionLink'] = $actionLink;
        $data['user'] = $user;
        $mail_body = view('email-templates.user-forgot-email-template',$data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('EMAIL_FROM_NAME'),
            'mail_recipient_email'=>$user->email,
            'mail_recipient_name'=>$user->name,
            'mail_subject'=>'Reset Password',
            'mail_body'=>$mail_body
        );

        if( sendEmail($mailConfig) ){
            return redirect()->route('user.forgot-password')->with('success','Le lien de réinitialisation de mot de passe a été envoyé.');
        }else{
            return redirect()->route('user.forgot-password')->with('fail','Une erreur est survenue , Veuillez réessayer.');
        }

    } //End Method

    public function showResetForm(Request $request, $token = null){
        //Check if token exists
        $get_token = DB::table('password_reset_tokens')
                       ->where(['token'=>$token])
                       ->first();

        if( $get_token ){
           //Check if this token is not expired
           $diffMins = Carbon::createFromFormat('Y-m-d H:i:s',$get_token->created_at)->diffInMinutes(Carbon::now());

           if( $diffMins > constDefaults::tokenExpiredMinutes ){
             //When token is older that 15 minutes
             return redirect()->route('user.forgot-password',['token'=>$token])->with('fail','Lien expiré ! Demandez un autre lien de réinitialisation du mot de passe.');
           }else{
            return view('back.pages.user.auth.reset')->with(['token'=>$token]);
           }
        }else{
            return redirect()->route('user.forgot-password',['token'=>$token])->with('fail','Lien invalide !, demandez un autre lien de réinitialisation du mot de passe.');
        }

    } //End Method

    public function resetPasswordHandler(Request $request){
      //Validate the form
      $request->validate([
         'new_password'=>'required|min:8|max:45|required_with:confirm_new_password|same:confirm_new_password',
         'confirm_new_password'=>'required'
      ]);

      $token = DB::table('password_reset_tokens')
                 ->where(['token'=>$request->token])
                 ->first();

      //Get user details
      $user = User::where('email',$token->email)->first();

      //Update user password
      User::where('email',$user->email)->update([
         'password'=>Hash::make($request->new_password)
      ]);

      //Delete token record
      DB::table('password_reset_tokens')->where([
         'email'=>$user->email,
         'token'=>$request->token
      ])->delete();

      //Send email to notify user for new password
      $data['user'] = $user;
      $data['new_password'] = $request->new_password;

      $mail_body = view('email-templates.user-reset-email-template',$data);

      $mailConfig = array(
        'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
        'mail_from_name'=>env('EMAIL_FROM_NAME'),
        'mail_recipient_email'=>$user->email,
        'mail_recipient_name'=>$user->name,
        'mail_subject'=>'Password Changed',
        'mail_body'=>$mail_body
      );

      sendEmail($mailConfig);
      return redirect()->route('user.login')->with('success','Votre mot de passe a été modifié. Utilisez le nouveau mot de passe pour vous connecter.');

    } //End Method

    public function profileView(Request $request){
        $data = [
            'pageTitle'=>'Profile'
        ];
        return view('back.pages.user.profile',$data);
    }

     public function changeProfilePicture(Request $request){
        $user = User::findOrFail(auth('user')->id());
        $path = 'images/users/';
        $file = $request->file('userProfilePictureFile');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $filename = 'USER_IMG_'.rand(2,1000).$user->id.time().uniqid().'.jpg';

        $upload = $file->move(public_path($path),$filename);

        if($upload){
            if( $old_picture != null && File::exists(public_path($path.$old_picture)) ){
                File::delete(public_path($path.$old_picture));
            }
            $user->update(['picture'=>$filename]);
            return response()->json(['status'=>1,'msg'=>'Votre photo de profil a été mise à jour avec succès.']);
            //  return toastr()->success('Data has been saved successfully!');
        }else{
            return response()->json(['status'=>0,'msg'=>'Une erreur est survenue , Veuillez réessayer.']);
        }
    }

    public function concessionSettings(Request $request){
        $user = USER::findOrFail(auth('user')->id());
        $concession = Concession::where('user_id',$user->id)->first();
        $concessionInfo = '';

        if( !$concession ){
            //Create concession for this user when not exists
            Concession::create(['user_id'=>$user->id]);
            $nconcession = Concession::where('user_id',$user->id)->first();
            $concessionInfo = $nconcession;
        }else{
            $concessionInfo = $concession;
        }

        $data = [
            'pageTitle'=>'Concession Settings',
            'concessionInfo'=>$concessionInfo
        ];

        return view('back.pages.user.concession-settings',$data);
    }

    public function concessionSetup(Request $request){
        $user = User::findOrFail(auth('user')->id());
        $concession = Concession::where('user_id',$user->id)->first();
        $old_logo_name = $concession->concession_logo;
        $logo_name = '';
        $path = 'images/concession/';

        //Validate the form
        $request->validate([
            'concession_name'=>'required|unique:concessions,concession_name,'.$concession->id,
            'concession_phone'=>'required|numeric:unique:concessions',
            'concession_address'=>'required',
            'concession_description'=>'required',
            'concession_logo'=>'nullable|mimes:jpeg,png,jpg|max:1024'
        ]);

        if( $request->hasFile('concession_logo') ){
            $file = $request->file('concession_logo');
            $filename = 'CONCESSIONLOGO_'.$user->id.uniqid().'.'.$file->getClientOriginalExtension();

            $upload = $file->move(public_path($path),$filename);

            if( $upload ){
                $logo_name = $filename;

                //Delete an existing concession logo
                if( $old_logo_name != null && File::exists(public_path($path.$old_logo_name)) ){
                    File::delete(public_path($path.$old_logo_name));
                }
            }
        }

        //Update User concession Details
        $data = array(
            'concession_name'=>$request->concession_name,
            'concession_phone'=>$request->concession_phone,
            'concession_address'=>$request->concession_address,
            'concession_description'=>$request->concession_description,
            'concession_logo'=>$logo_name != null ? $logo_name : $old_logo_name
        );

        $update = $concession->update($data);

        if( $update ){
            return redirect()->route('user.concession-settings')->with('success','Les informations de votre concession ont été mises à jour.');
        }else{
            return redirect()->route('user.concession-settings')->with('fail','Erreur lors de la mise à jour de vos informations de concession.');
        }
    }
}
