<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = [
            'password.regex' => 'Formato incorrecto. La contraseña debe contener como mínimo 8 caracteres: al menos una letra mayúscula, una letra minúscula y un número.',
        ];

        $this->validate($request, [
            'name' => 'required',
            'cuil' => 'required',
            'email' => 'required|email|unique:users,email',
            'cargo' => 'required',
            'password' => 'required|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'roles' => 'required',
        ], $messages);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        //Registro de LOG
        $responsable_id = User::findOrFail(auth()->id())->id;
        $responsable_nombre = User::findOrFail(auth()->id())->name;
        $responsable_email = User::findOrFail(auth()->id())->email;

        DB::connection('mysql')
        ->table('eventos_log')->insert(['EL_Evento' => 'Se ha creado el usuario: ' . $request->name . ', cuil número: ' . $request->cuil . ', cargo: ' . $request->cargo . ' email: ' . $request->email . '.',
        'EL_Evento_Fecha' => Carbon::now(),
        'EL_Id_Responsable' => $responsable_id,
        'EL_Nombre_Responsable' => $responsable_nombre,
        'EL_Email_Responsable' => $responsable_email]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'password.regex' => 'Formato incorrecto. La contraseña debe contener como mínimo 8 caracteres: al menos una letra mayúscula, una letra minúscula y un número.',
        ];


        $this->validate($request, [
            'name' => 'required',
            'cuil' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'cargo' => 'required',
            'password' => 'nullable|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'roles' => 'required',
        ], $messages);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        //Registro de LOG
        $responsable_id = User::findOrFail(auth()->id())->id;
        $responsable_nombre = User::findOrFail(auth()->id())->name;
        $responsable_email = User::findOrFail(auth()->id())->email;

        DB::connection('mysql')
        ->table('eventos_log')->insert(['EL_Evento' => 'Se ha modificado el usuario: ' . $request->name . ', cuil número: ' . $request->cuil . ', cargo: ' . $request->cargo . ' email: ' . $request->email . '.',
        'EL_Evento_Fecha' => Carbon::now(),
        'EL_Id_Responsable' => $responsable_id,
        'EL_Nombre_Responsable' => $responsable_nombre,
        'EL_Email_Responsable' => $responsable_email]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request, $id)
    {
        //Expresion regular que valida al menos un simbolo (mas completa).
        //$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

        $input = $request->all();
        
        if (!empty($input['password']) && !empty($input['new-password']) && !empty($input['confirm-password'])) {

            if (Hash::check($input["password"], $request->user()->password)) {

                if ($input['new-password'] == $input['confirm-password']) {

                    if (preg_match($regex, $input['new-password'])) {

                        $password= Hash::make($input['new-password']);
                    } else {
                        return redirect()->back()->
                        withErrors(['msg' => 'Formato incorrecto. La contraseña debe contener como mínimo 8 caracteres: al menos una letra mayúscula, una letra minúscula y un número.']);
                    }

                } else {
                    $input = Arr::except($input, array('new-password'));
                    return redirect()->back()->
                        withErrors(['msg' => 'Las contraseñas NO coinciden']);
                }
            } else {
                $input = Arr::except($input, array('new-password'));
                return redirect()->back()->
                    withErrors(['msg' => 'La contraseña actual NO es válida']);
            }

        } else {
            $input = Arr::except($input, array('new-password'));
            return redirect()->back()->
                withErrors(['msg' => 'Los campos NO pueden estar vacíos']);
        }

        $user = User::find($id);
        $user->password = $password;
        $user->save();

        //Registro de LOG
        $responsable_id = User::findOrFail(auth()->id())->id;
        $responsable_nombre = User::findOrFail(auth()->id())->name;
        $responsable_email = User::findOrFail(auth()->id())->email;

        DB::connection('mysql')
        ->table('eventos_log')->insert(['EL_Evento' => 'Se ha modificado la contraseña del usuario: ' . $user->name . '.',
        'EL_Evento_Fecha' => Carbon::now(),
        'EL_Id_Responsable' => $responsable_id,
        'EL_Nombre_Responsable' => $responsable_nombre,
        'EL_Email_Responsable' => $responsable_email]);

        return redirect()->route('home')
            ->with('success', 'Su Contraseña ha sido actualizada con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        User::find($id)->delete();

        //Registro de LOG
        $responsable_id = User::findOrFail(auth()->id())->id;
        $responsable_nombre = User::findOrFail(auth()->id())->name;
        $responsable_email = User::findOrFail(auth()->id())->email;

        DB::connection('mysql')
        ->table('eventos_log')->insert(['EL_Evento' => 'Se ha eliminado el usuario: ' . $user->name . ', cuil número: ' . $user->cuil . ', cargo: ' . $user->cargo . ' email: ' . $user->email . '.',
        'EL_Evento_Fecha' => Carbon::now(),
        'EL_Id_Responsable' => $responsable_id,
        'EL_Nombre_Responsable' => $responsable_nombre,
        'EL_Email_Responsable' => $responsable_email]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente !');
    }
}
