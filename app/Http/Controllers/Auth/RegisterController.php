<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pic;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get name from Pic by NID.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNidData()
    {
        try {
            $nid = trim(request('nid'));
            
            if (!$nid) {
                return response()->json(['error' => 'NID harus diisi'], 422);
            }

            // Query ke tabel pics dengan relasi divisi
            $pic = Pic::where('nid_pic', $nid)
                ->with('divisi')
                ->first();
            
            if (!$pic) {
                return response()->json(['error' => 'NID tidak ditemukan di database'], 404);
            }

            // Get divisi name
            $divisiName = $pic->divisi ? $pic->divisi->nama_divisi : '-';

            return response()->json([
                'success' => true,
                'name' => $pic->nama_pic,
                'divisi' => $divisiName,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:20', 'unique:users,nid', 'regex:/^[a-zA-Z0-9]+$/'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Password di-generate dari NID
        $user = User::create([
            'name' => $data['name'],
            'nid' => $data['nid'],
            'password' => Hash::make($data['nid']),
            'role' => $data['role'],
        ]);

        // Assign role
        if ($data['role']) {
            $user->assignRole($data['role']);
        }

        return $user;
    }
}
