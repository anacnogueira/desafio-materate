<?php

namespace Desafio\Http\Controllers;

use Desafio\Entities\User;
use Illuminate\Http\Request;
use redeJacarei\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Desafio\Contracts\ManageFile as ManageFileInterface;

class UsersController extends Controller
{
    private $manageFile;
    private $user;

    public function __construct(ManageFileInterface $manageFile, User $user)
    {
        $this->manageFile = $manageFile;
        $this->user = $user;        
    }

    public function profile()
    {
        $user = Auth::user();
        $user->img_path = !empty($user->image) ? 
        "storage/users/".$user->image :
        "img/user2-160x160.jpg";

        return view('users.profile', compact('user'));
    }

    public function index()
    {
        $users = $this->user->all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = [];
        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {       

        $validator = $this->validates($request, 'store');

        if ($validator->fails()){
            return redirect()->route('user.create')
            ->withErrors($validator)
            ->withInput();           
        }

        $data = $request->toArray();
        $data['password'] = bcrypt($data['password']); 

        //Upload Photo
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $data['image'] = $this->manageFile->store($request, $request->input('name').' '.date('dmyHis'),"storage/users", '');
        }
        
        $user = $this->user->create($data);
        
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (str_contains(URL::previous(),"perfil")){
            $failure_route = 'user.profile';
            $success_route = 'user.profile';
        } else {
            $failure_route = 'user.edit';
            $success_route = 'user.index';
        }

        $user = $this->user->find($id);

        $validator = $this->validates($request, 'update');
        

        if ($validator->fails()){
            session()->flash('error','Não foi possível atualizar o usuário.');
            return redirect()->route($failure_route,['id' => $id])
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->toArray();
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']); 
        } else {
            $data['password'] = $user->password;
        }

        //Upload Photo
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $data['image'] = $this->manageFile->store($request, $request->input('name').' '.date('dmYHis'), "storage/users", $request->input('oldfile'));
        }
            
        $user->update($data);      

        session()->flash('success', 'Usuário Atualizado com sucesso');
        return redirect()->route($success_route);
    }

    /* PRIVATE FUNCTIONS */ 
    private function validates($request, $action)
    {
        if ($action == 'store') {
            return Validator::make($request->all(), [
                'name' => 'required',  
                'email' => 'required',
                'password' => 'required',                      
            ]);
        } else if ($action == 'update') {
            return  Validator::make($request->all(), [
                'name' => 'required',  
                'email' => 'required',                     
            ]);
        }   
    } 


}
