<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\TeamRequest;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamController extends MainController
{
    /**
     * @var TagRepository
     */
    public $team_rep;

    public function __construct(TeamRepository $team_rep)
    {
        $this->template = 'admin.team.index';
        $this->team_rep = $team_rep;
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

        $this->title = 'Сотрудники';
        $teams = $this->getTeams();

        $this->content = view('admin.team.content')->with('teams', $teams);

        return $this->renderOutput();
    }

    public function getTeams()
    {
        return $this->team_rep->get(['id', 'name', 'profession'], false, true);

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

        $this->title = 'Создание члена команды';

        $this->content = view('admin.team.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        if(Gate::denies('CREATE_ITEMS')){
            return abort(404);
        }

        $result = $this->team_rep->createTeam($request);
        if(is_array($result) && !empty($result['errors'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('team.index')->with($result);
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

        $this->title = 'Редактирование члена команды';

        $team = $this->getTeam($id);

        $this->content = view('admin.team.edit')->with('team', $team);
        return $this->renderOutput();
    }

    public function getTeam($id) {

        return $this->team_rep->one($id) ?: false;
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

        $team = $this->getTeam($id);

        $result = $this->team_rep->updateTeam($request, $team);

        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('team.index')->with($result);

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
        $team = $this->getTeam($id);

        $result = $this->team_rep->deleteTeam($team);
        return (is_array($result) && !empty($result['errors'])) ? redirect()->back()->with($result) : redirect()->route('team.index')->with($result);
    }
}
