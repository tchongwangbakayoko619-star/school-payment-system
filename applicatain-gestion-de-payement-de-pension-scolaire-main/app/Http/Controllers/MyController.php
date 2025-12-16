<?php

namespace App\Http\Controllers;
use App\Models\students;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log; 

class MyController extends Controller
{
    public function login(){
       
        return view('login');

    }
    public function mode(){
       
        return view('modepayement');

    }
    

    public function connexion(Request $request)
    {
        $admin = DB::table('admins')->where('name', $request->input('admin'))->first();
    
        if (!$admin) {
            return back()->withErrors(['admin' => 'Nom d\'utilisateur incorrect.']);
        }
    
        if (!Hash::check($request->input('password'), $admin->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }
    
        // Authentification réussie
        return redirect()->route('home')->with('success', 'Bienvenue admin !');
    }
    
public function home()
{
    $eleves = DB::table('students')->get();
    $classes = DB::table('classes')->get();

    // Nombre d'élèves par salle et par sexe
    $studentsByClassAndGender = DB::table('students')
        ->join('classes', 'students.class_id', '=', 'classes.id')
        ->select('classes.nom as class_name', 'students.gender')
        ->get()
        ->groupBy('class_name')
        ->map(function ($students) {
            return $students->groupBy('gender')->map(function ($genderGroup) {
                return $genderGroup->count();
            });
        });

    // Statut de paiement des pensions par sexe
    $paymentStatusByGender = DB::table('students')
        ->select('gender', 'paid')
        ->get()
        ->groupBy('gender')
        ->map(function ($students) {
            return [
                'paid' => $students->where('paid', true)->count(),
                'unpaid' => $students->where('paid', false)->count(),
            ];
        })->toArray();

    return view('home', compact('eleves', 'classes', 'studentsByClassAndGender', 'paymentStatusByGender'));
}
public function add(){
    $classes = DB::table('classes')->get();
    return view('add new students',compact('classes'));

}

public function ajout(Request $request)
{
    $classes = DB::table('classes')->get();

    $validator = Validator::make($request->all(), [
        'firstName' => 'required|string|max:255|unique:students,name',
        'lastName' => 'required|string|max:255',
        'birthDate' => 'required|date_format:Y-m-d',
        'birthPlace' => 'nullable|string|max:255',
        'className' => 'required|exists:classes,id',
        'gender' => 'required|in:male,female,other',
        'parentEmail' => 'nullable|email|max:255',
        // 'initialPassword' => 'required|string|min:8|unique:students,initial_password', // Utilisez la règle 'unique'
        'studentImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->route('add')
            ->withErrors($validator)
            ->withInput();
    }

    // Si la validation réussit, continuez avec l'enregistrement de l'étudiant
    $student = new students();
    $student->date_of_birth = $request->input('birthDate');
    $student->place_of_birth = $request->input('birthPlace');
    $student->class_id = $request->input('className');
    $student->gender = $request->input('gender');
    // $student->parent_email = $request->input('parentEmail');
  
    $student->name = $request->input('firstName');
    $student->lastname = $request->input('lastName');

 if ($request->hasFile('studentImage')) {
        $imagePath = $request->file('studentImage')->store('students', 'public'); // stocke dans storage/app/public/students
        $student->image_path = $imagePath; // ex: students/photo.jpg
    }


    $student->save();

    return redirect()->route('add')->with('success', 'Student added successfully.'); // Traduction ici
}

public function afficher(Request $request)
{
    $classes = Classe::all();

    return view('afficher', compact('classes'));
}
public function afficheclass(Request $request)
{
    $selectedClass = $request->input('classeSelect');
    $classe = Classe::findOrFail($selectedClass);
    $eleves = Students::where('class_id', $selectedClass)
                    ->orderBy('name')
                    ->orderBy('lastname')
                    ->paginate(2); // Pagination de 5 éléments par page

    return view('afficheclass', [
        'classeNom' => $classe->nom,
        'eleves' => $eleves, // Passer la collection paginée sous la clé 'eleves'
        'selectedClass' => $selectedClass,
    ]);
}
public function destroy(string $id)
    {
        $student = students::findOrFail($id); // Recherche l'étudiant par ID ou lance une erreur 404 si non trouvé
        $student->delete(); // Supprime l'étudiant de la base de données

        // Optionnellement, vous pouvez rediriger l'utilisateur vers la liste des étudiants avec un message de succès
        return Redirect::back();
    }
    public function edit (string $id)
    {
        $student = students::findOrFail($id); // Recherche l'étudiant par ID ou lance une erreur 404 si non trouvé
        $classes = Classe::all();
        return view('modifier', compact('student','classes')); // Passe l'étudiant à la vue
    }
    public function update(Request $request, $id)
    {
        $student = students::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255|unique:students,name',
            'lastName' => 'required|string|max:255',
            'studentImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthDate' => 'nullable|date',
            'birthPlace' => 'required|string|max:255',
            'className' => 'required|exists:classes,id',
            'gender' => 'required|in:male,female,other',
            // 'parentEmail' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student->name = $request->input('firstName');
        $student->lastname = $request->input('lastName');
        $student->date_of_birth = $request->input('birthDate');
        $student->place_of_birth = $request->input('birthPlace');
        $student->class_id = $request->input('className');
        $student->gender = $request->input('gender');
        // $student->parent_email = $request->input('parentEmail');

        if ($request->hasFile('studentImage')) {
            // Delete the old image if it exists
            if ($student->image_path) {
                Storage::delete('public/' . $student->image_path);
            }

            $imagePath = $request->file('studentImage')->store('images', 'public');
            $student->image_path = str_replace('public/', '', $imagePath);
        }

        $student->save();
        return redirect()->back()->with('success', 'The modification was successful');
    }
    public function downloadStudentListPDF($classId)
    {
        $classe = Classe::findOrFail($classId);
        $eleves = Students::where('class_id', $classId)
        ->orderBy('name')     // En cas d'égalité de nom de famille, tri par prénom (name)
        ->orderBy('lastname') // Tri par nom de famille (lastname) par ordre alphabétique
        ->get();
        // Créer une vue Blade pour afficher la liste des élèves (voir l'étape suivante)
        $pdf = Pdf::loadView('students_list', [
            'eleves' => $eleves,
            'classe' => $classe,
        ]);

        // Personnaliser le nom du fichier PDF
        $filename = 'liste_eleves_' . str_replace(' ', '_', $classe->nom) . '.pdf';
     // Télécharger le PDF avec un nom de fichier spécifique
     return $pdf->download($filename);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirigez l'utilisateur vers la page de connexion après la déconnexion
    }
}


