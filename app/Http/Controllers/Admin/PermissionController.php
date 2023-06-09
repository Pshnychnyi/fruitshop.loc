<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends MainController
{
    /**
     * @var PermissionRepository
     */
    public $per_rep;
    public $rol_rep;

    public function __construct(PermissionRepository $per_rep, RoleRepository $rol_rep)
    {
        $this->template = 'admin.permission.index';
        $this->per_rep = $per_rep;
        $this->rol_rep = $rol_rep;
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
        $this->title = 'Роли и привелегии';
        $permissions = $this->getPermissions();
        $roles = $this->getRoles();

        $this->content = view('admin.permission.content', compact('permissions', 'roles'));

        return $this->renderOutput();
    }

    public function getPermissions()
    {
        return $this->per_rep->get(['id', 'name']);
    }
    public function getRoles()
    {
        return $this->rol_rep->get(['id', 'name']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('CHANGE_PERMISSION')){
            return abort(404);
        }

        $result = $this->per_rep->changePermission($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('permission.index')->with($result);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
