<?php

namespace App\Http\Controllers\utilisateur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ParentLoginSuccess;
use App\Models\Classe;
use App\Models\students;
use Illuminate\Support\Facades\Log;
class UserControleur extends Controller
{
public function welcome(){
    return view('welcome');
}
    public function showStudent($id)
    {
        $student = students::find($id); // Utilise Student avec majuscule (convention Laravel)
    
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
    
        $classe = Classe::find($student->class_id);
    
        if (!$classe) {
            return redirect()->back()->with('error', 'Class not found for this student.');
        }
    
        return view('user.show', compact('student', 'classe'));
    }
    public function home(Request $request){
        $id = $request->query('id'); 
        return view('user.accueil', compact('id'));
    }
    public function login(){
        return view('user.login');
    }
    public function verifier(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Recherche de l'étudiant
        $student = students::where('parent_email', $request->email)->first();
        
        if ($student && $request->password===$student->initial_password) {
            // Si le mot de passe correspond, on envoie l'email
            $homePageLink = route('user.home', ['id' => $student->id]); // Lien vers la page d'accueil
    
            // Envoi de l'email avec le lien de connexion
            Mail::to($student->parent_email)->send(new ParentLoginSuccess($homePageLink));
    
            // Retour avec un message de succès
            return back()->with('success', 'For added security, the login link has been sent to your email.');
        }
          
      if(!$student){
        // Si l'étudiant n'existe pas
        return back()->withErrors(['email' => 'Incorrect Email.']);
      }
      if($request->password!=$student->initial_password){
        return back()->withErrors(['Mot de passe' => 'Incorrect Email Password.']);
      }
        // Si l'email ou le mot de passe est incorrect
    return back()->withErrors(['email et mot de passe' => 'Email et mot de passe incorrect.']);
       
    }
   
    
   public function forgotPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    // Vérifier si l'utilisateur existe
    $student = students::where('parent_email', $request->email)->first();

    if (!$student) {
        return back()->with('error', "This email does not exist.");
    }

    $password = $student->initial_password;

    // Envoyer l'ancien mot de passe par email
    
    return back()->with('success', "Your password is : $password.");
}
    
     }
