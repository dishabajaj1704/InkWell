<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function __construct()
    {
        $this->middleware(['validateAdmin'])->only(['makeAdmin', 'index']);
    }
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {

        $users = User::where('id', '!=', auth()->user()->id)->orderBy('id', 'asc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function makeRevokeAdmin(int $userId)
    {
        // dd($user);
        // dd($userId); //why not user was wroking?
        $user = User::find($userId);

        if ($user->role === 'author') {
            if ($user->email_verified_at != null) {
                $user->role = 'admin';
                $user->save();
            } else {
                session()->flash('error', 'Cannot Switch to Admin. Please Verify Email First');
            }

        } else if ($user->role === 'admin') {

            if ($user->email_verified_at != null) {
                $user->role = 'author';
                $user->save();
            } else {
                session()->flash('success', 'Changes Made successfully!');
            }

        }

        return redirect(route('admin.users.index'));

    }

    public function verifyEmail(int $userId)
    {
        $user = User::find($userId);
        //dd(Carbon::now()->format('Y-m-d H:i:s'));
        if ($user->email_verified_at == null) {
            $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
            session()->flash('success', ' Email Verified successfully...');
        } else if ($user->email_verified_at != null) {
            $user->email_verified_at = null;
            if ($user->role === 'admin') {
                $user->role = 'author';
            }
            $user->save();
            session()->flash('success', ' Email UnVerified successfully...');
        }

        return redirect(route('admin.users.index'));

    }


}
