<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission("listar_catalogo_proyectos")) {
            $projects = Project::with('assets')->get();
            // dd($);{}
            return view('catalogs.projects.index', compact('projects'));
        }
        return redirect()->back();
    }

    public function create(){
        if(userHasPermission("crear_catalogo_proyectos")) {
            $project = new Project();
            return view('catalogs.projects.create', compact('project'));
        }
        return redirect()->back();
    }

    public function store(ProjectRequest $request){
        try{
            Project::create($request->get('project'));
            $request->session()->flash('message', 'Project created successfully');
            return redirect()->route('projects.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        if(userHasPermission("editar_catalogo_proyectos")) {
            $project = Project::find($id);
            return view('catalogs.projects.edit', compact('project'));
        }
        return redirect()->back();
    }

    public function update(ProjectRequest $request, Project $project){
        try {
            $project->fill($request->get('project'));
            $project->save();
            $request->session()->flash('message', 'Project update successfully');
            return redirect()->route('projects.index');
        }catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id){
        $response = ['errors' => false];
        $project = Project::find($id);

        if(count($project->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        } else {
            try {
                $project->delete();
                Session::flash('message', 'Project delete successfully');
                return response()->json(['errors' => false]);
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['type_error'] = 'exception';
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors([$e->getMessage()])
                    ->render();
                return response()->json($response);
            }
        }
    }
}
