<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use File;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {

        try {
            $this->user = User::get();

            $this->page = [
                'title' => 'User',
                'sub_title' => 'Daftar User',
            ];

            $data = ['user', 'page'];

            return $this->view('user.read', $data);
        } catch (\Throwable $th) {
            dd('error', $th);
        }
    }

    public function loginPage()
    {
        $data = [];

        return $this->view('auth.login', $data);
    }

    public function registrationPage()
    {
        $data = [];

        return $this->view('auth.registrasi', $data);
    }

    public function loginData(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Error during the creation!');
    }

    public function registrationData(Request $request)
    {

        DB::beginTransaction();

        try {
            $request->role = (int)$request->role;

            $user = new User;
            
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:dns|unique:users',
                'no_hp' => 'required|numeric|digits_between:9,15',
                'alamat' => 'required|max:255',
                'npwp' => 'required|max:255',
                'role' => '',
                'jabatan' => 'required|max:255',
                'status' => '',
                'password' => 'required|min:5|max:255',
                'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
    
            $datenow = date('Y-m-d H.i.s');
            
            $file = $request->file('foto');
            $direktori_upload = 'data_file\foto_user';
            $file->move($direktori_upload, $validatedData['name'] . '-' . $datenow . '.' . $file->getClientOriginalExtension());
            
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['foto'] = $validatedData['name'] . '-' . $datenow . '.' . $file->getClientOriginalExtension();
            
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->no_hp = $validatedData['no_hp'];
            $user->alamat = $validatedData['alamat'];
            $user->npwp = $validatedData['npwp'];
            $user->jabatan = $validatedData['jabatan'];
            $user->status = $validatedData['status'];
            $user->foto = $validatedData['foto'];
            $user->role = $validatedData['role'];
            $user->password = $validatedData['password'];

            if (!$user->save()) {
                dd('hwlaw');
            }
            
            DB::commit();
            $data = [];
            
            return redirect()->route('read_user', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Registrasi User Gagal']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login_page');
    }

    public function editUserPage(Request $request)
    {
        if (!User::find($request->id_data)) {
            abort(404);
        }

        try {
            $this->user = User::find($request->id_data);

            $this->page = [
                'user' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'no_hp' => $this->user->no_hp,
                    'alamat' => $this->user->alamat,
                    'jabatan' => $this->user->jabatan,
                    'npwp' => $this->user->npwp,
                    'foto' => $this->user->foto,
                ],
                'title' => 'Edit User',
                'sub-title' => 'User',
            ];

            $data = ['user', 'page'];

            return $this->view('user.edit', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Gagal']);
        }
    }

    public function editUserData(Request $request)
    {
        if (!User::find($request->id)) {
            abort(404);
        }

        DB::beginTransaction();
        try {

            $user = User::find($request->id);
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:dns|unique:users,email,' . $user->id,
                'no_hp' => 'required|max:255',
                'alamat' => 'required|max:255',
                'npwp' => 'required|max:255',
                'jabatan' => 'required|max:255',
                'role' => 'required',
                'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->no_hp = $validatedData['no_hp'];
            $user->alamat = $validatedData['alamat'];
            $user->npwp = $validatedData['npwp'];
            $user->jabatan = $validatedData['jabatan'];
            $user->role = $validatedData['role'];

            if ($request->foto) {
                File::delete(public_path('data_file/foto_user/' . $user->foto));

                $foto = $request->file('foto');
                $datenow = date('Y-m-d H.i.s');
                $user->foto = $validatedData['name'] . '-' . $datenow . '.' . $foto->getClientOriginalExtension();

                $direktori_upload = 'data_file\foto_user';
                $foto->move($direktori_upload, $validatedData['name'] . '-' . $datenow . '.' . $foto->getClientOriginalExtension());
            }

            if (!$user->save()) {
            }
            DB::commit();

            return redirect()->route('read_user');
        }  catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Edit User Gagal']);
        }
    }

    public function detailUser(Request $request)
    {
        if (!User::find($request->id_data)) {
            abort(404);
        }

        try {
            $this->user = User::find($request->id_data);

            $this->page = [
                'user' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'no_hp' => $this->user->no_hp,
                    'alamat' => $this->user->alamat,
                    'jabatan' => $this->user->jabatan,
                    'npwp' => $this->user->npwp,
                    'foto' => $this->user->foto,
                ],
                'title' => 'Edit User',
                'sub-title' => 'User',
            ];

            $data = ['user', 'page'];

            return $this->view('user.detail', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function changeStatus(Request $request)
    {
        if (!User::find($request->id_data)) {
            abort(404);
        }


        try {
            $user = User::find($request->id_data);

            if ($user->status == 1) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }

            if (!$user->save()) {
            }
            DB::commit();

            return redirect()->route('read_user');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Ubah Status Profile Gagal']);
        }
    }

    public function setup_profile()
    {
        if (!User::find(auth()->user()->id)) {
            abort(404);
        }

        try {

            // dd('halo');
            $this->user = User::find(auth()->user()->id);

            $this->page = [
                'title' => 'Edit User',
                'sub-title' => 'User',
            ];

            $data = ['page', 'user'];
            return $this->view('profile.setup', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function setup_profile_data(Request $request)
    {
        if (!User::find(auth()->user()->id)) {
            abort(404);
        }

        DB::beginTransaction();
        try {

            $user = User::find(auth()->user()->id);
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:dns|unique:users,email,' . $user->id,
                'no_hp' => 'required|numeric|digits_between:9,15',
                'alamat' => 'required|max:255',
                'npwp' => 'required|max:255',
                'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->no_hp = $validatedData['no_hp'];
            $user->alamat = $validatedData['alamat'];
            $user->npwp = $validatedData['npwp'];

            if ($request->foto) {
                File::delete(public_path('data_file/foto_user/' . $user->foto));

                $foto = $request->file('foto');
                $datenow = date('Y-m-d H.i.s');
                $user->foto = $validatedData['name'] . '-' . $datenow . '.' . $foto->getClientOriginalExtension();

                $direktori_upload = 'data_file\foto_user';
                $foto->move($direktori_upload, $validatedData['name'] . '-' . $datenow . '.' . $foto->getClientOriginalExtension());
            }

            if ($request->new_password) {
                $request->validate([
                    'current_password' => ['required', new MatchOldPassword],
                    'new_password' => ['required'],
                    'new_confirm_password' => ['same:new_password'],
                ]);

                User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
            }

            if (!$user->save()) {
            }
            DB::commit();

            return redirect()->route('read_user');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Edit Profile Gagal']);
        }
    }

    public function resetPassword(Request $request)
    {
        if (!User::find(auth()->user()->id)) {
            abort(404);
        }

        DB::beginTransaction();
        try {
            $user = User::find($request->id_data);

            $password = Hash::make('password');

            $user->password = $password;

            if (!$user->save()) {
            }
            DB::commit();

            return redirect()->route('read_user');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage(), 'title' => 'Reset Password User Gagal']);
        }
    }
}
