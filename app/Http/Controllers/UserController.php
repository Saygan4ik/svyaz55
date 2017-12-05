<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
        $this->middleware('can:edit-users')->except(['saveAvatar', 'deleteAvatar', 'editProfile', 'updateProfile']);
    }

    public function index() {
        $users = $this->userRepository->paginate(config('base.users_per_page'));
        return view('admin/user/index', compact('users'));
    }

    public function edit($id) {
        $user = $this->userRepository->getById($id);
        return view('admin/user/edit', compact('user'));
    }

    public function update(UserRequest $request, $id) {
        $this->userRepository->update($id, $request);
        Session::flash('msg', 'Профиль успешно отредактирован!');
        return redirect('user/'.$id);
    }

    public function show($id) {
        $user = $this->userRepository->getById($id);
        return view('admin/user/show', compact('user'));
    }

    public function destroy($id) {
        $this->userRepository->delete($id);
        Session::flash('msg', 'Пользователь успешно удален!');
        return back();
    }

    public function saveAvatar(Request $request, $id) {
        if (Auth::user()->id == $id || Gate::allows('edit-users')) {
            if ($this->userRepository->saveAvatar($request, $id)) {
                Session::flash('msg', 'Аватар успешно изменен!');
                return response()->json([], 200);
            }
            else {
                Session::flash('msg', 'Ошибка при сохранение');
                return response()->json([], 200);
            }
        }
        else {
            return abort(403);
        }
    }

    public function deleteAvatar($id) {
        if (Auth::user()->id == $id || Gate::allows('edit-users')) {
            $this->userRepository->deleteAvatar($id);
            Session::flash('msg', 'Аватар успешно удален');
            return back();
        }
        else {
            return abort(403);
        }
    }

    public function editProfile($id) {
        if (Auth::user()) {
            if(Auth::user()->id == $id) {
                $user = $this->userRepository->getById($id);
                return view('user/edit', compact('user'));
            }
            else {
                return abort(403);
            }
        }
        else {
            return abort(401);
        }
    }

    public function updateProfile(UserRequest $request, $id) {
        if(Auth::user()->id == $id) {
            $this->userRepository->update($id, $request->all());
            Session::flash('msg', 'Профиль успешно отредактирован');
            return back();
        }
        else {
            return abort(403);
        }
    }
}
