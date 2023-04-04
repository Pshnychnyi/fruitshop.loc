<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends MainController
{
    /**
     * @var UserRepository
     */
    public $user_rep;

    public function __construct(UserRepository $user_rep)
    {
        $this->template = 'admin.user.index';
        $this->user_rep = $user_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW_ADMIN')){
            return abort(404);
        }

        $this->title = 'Пользователи';
        $users = $this->getUsers();

        $this->content = view('admin.user.content')->with('users', $users);

        return $this->renderOutput();
    }

    public function getUsers()
    {
        return $this->user_rep->get(['id', 'name', 'email'], false, true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }
        $this->title = 'Создание пользователя';

        $this->content = view('admin.user.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->user_rep->createUser($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('user.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }

        $this->title = 'Редактирование пользовтеля';

        $user = $this->getUser($id);

        $this->content = view('admin.user.edit')->with('user', $user);
        return $this->renderOutput();
    }

    public function getUser($id) {

        return $this->user_rep->one($id) ?: false;
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
        if(Gate::denies('UPDATE_ITEMS')){
            return abort(404);
        }
        $user = $this->getUser($id);

        $result = $this->user_rep->updateUser($request, $user);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('user.index')->with($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('DELETE_ITEMS')){
            return abort(404);
        }
        $user = $this->getUser($id);

        $result = $this->user_rep->deleteUser($user);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('user.index')->with($result);
    }
}
