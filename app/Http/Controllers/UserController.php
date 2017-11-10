<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function edit($id) {
        $user = $this->userRepository->getById($id);
        return view('test', compact('user'));
    }

    public function update(UserRequest $request, $id) {
        $this->userRepository->update($id, $request);
        Session::flash('msg', 'Профиль успешно отредактирован!');
        return redirect('user/2/edit');
    }
}
