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


}
