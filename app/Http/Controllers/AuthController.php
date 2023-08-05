<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // The purpose of shareNavigationData() to share navigation data to all views or perform other tasks needed for each request.
    public function __construct()
    {
        $this->shareNavigationData();
    }

    // This method is responsible for displaying the login view.
    public function index()
    {
        return view('auth.login');
    }

    // This method is responsible for displaying the sign-up view.
    public function signup_view()
    {
        return view('auth.signup');
    }

    // This method handles the user sign-up process.
    public function signup(Request $request)
    {
        // Validate the incoming request data using the $request->validate() method.
        // Ensure that the required fields ('first_name', 'last_name', 'email', and 'password') are present and meet specific criteria (e.g., email format, uniqueness of email, and password confirmation).
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8|confirmed'
        ]);

        // Create a new user record in the database using the User::create() method.
        // The user's 'first_name', 'last_name', 'email', and hashed 'password' are saved based on the validated data.
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

         // After creating the user, check if the user was successfully created.
        // If the user was created, associate a new cart with the user by creating a new Cart model instance and saving it to the database. 
        if($user){
            $user->cart()->save(new Cart());
        }

         // Log in the newly created user using Auth::login($user).
        // This will make the user authenticated and can access restricted areas of the application.
        Auth::login($user);
        
        // Redirect the user to the 'main' route with a success message in the session.
        return redirect()->route('main')->with('success', 'Registration successful!');

    }

    // This method handles user authentication when logging in.
    public function authenticate(Request $request)
    {
        // Validate the incoming request data ('email' and 'password').
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user with the provided credentials using Auth::attempt($credentials).
        if(Auth::attempt($credentials)){
            // If authentication is successful, regenerate the session to prevent session fixation attacks.
            $request->session()->regenerate();

             // Check if the authenticated user is an admin or a regular user.
            if(auth()->user()->user === 'admin'){

                // If the user is an admin, redirect to the 'admin.dashboard' route.
                return redirect()->route('admin.dashboard');
            } else {

                // If the user is not an admin, redirect to the 'main' route.
                return redirect()->route('main');
            }
        }

        // If authentication fails, redirect back with an error message.
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    // This method handles user logout.
    public function logout(Request $request)
    {
        // Log the user out using Auth::logout().
        Auth::logout();

        // Invalidate the current session.
        $request->session()->invalidate();
        
        // Regenerate a new CSRF token to protect against Cross-Site Request Forgery (CSRF) attacks.
        $request->session()->regenerateToken();

         // Redirect the user to the 'main' route after successful logout.
        return redirect()->route('main');
    }


}