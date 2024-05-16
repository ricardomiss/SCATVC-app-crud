<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alumnos;
use App\Models\Grupos;
use App\Models\Arte;
use App\Models\Fisica;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function home(){

        return view('home');
    }
    public function form(){

        return view('add_alumno');
    }
    
    public function add_alumno(Request $request){
        $request->validate([
            'nombre'=>'required',
            'grupo_id'=>'required|max:2',
            'fecha_nacimiento'=>'required|date',
            'direccion'=>'required',
            'telefono'=>'required|numeric',
            'email'=>['required','email'],
            'arte_id'=>'required',
            'fisica_id'=>'required'
            
        ]);
        $data=new Alumnos;
        $data->nombre=$request->nombre;
        $data->grupo_id=$request->grupo_id;
        $data->fecha_nacimiento=$request->fecha_nacimiento;
        $data->direccion=$request->direccion;
        $data->telefono=$request->telefono;
        $data->email=$request->email;
        $data->arte_id=$request->arte_id;
        $data->fisica_id=$request->fisica_id;
        $data->save();
        return redirect()->back();

    }
    public function show_alumno(){
        $data=Alumnos::all();
        $artes=Arte::all();
        $fisicas=Fisica::all();
        return view( 'show_alumno',compact('data','artes','fisicas'));
    }
    public function delete_alumno($id){
        $data=Alumnos::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function update_alumno(Request $request, $id){
        $data = Alumnos::find($id);
        $grupos = Grupos::all();
        $artes = Arte::all();
        $fisicas = Fisica::all();
        
        if(!$data) {
            return redirect()->back()->with('error', 'No se encontró el alumno');
        }
        
        return view('update_alumno', compact('data', 'grupos', 'artes', 'fisicas'));
    }
    
    
    public function edit_alumno(Request $request, $id){
        $data=Alumnos::find($id);
        $data->nombre=$request->nombre;
        $data->grupo_id=$request->grupo_id;
        $data->fecha_nacimiento=$request->fecha_nacimiento;
        $data->direccion=$request->direccion;
        $data->telefono=$request->telefono;
        $data->email=$request->email;
        $data->arte_id=$request->arte_id;
        $data->fisica_id=$request->fisica_id;
        $data->save();
        return redirect('/show_alumno');
    }
    public function buscar(Request $request)
    {
        $grupo_id = $request->input('grupo_id');
        
        // Realizar la consulta para buscar usuarios con el grupo_id especificado
        $data = Alumnos::where('grupo_id', $grupo_id)->get();
        
        // Verificar si se encontraron datos antes de pasarlos a la vista
        if ($data->isEmpty()) {
            return view('buscar_usuarios', ['usuarios' => $data])
                ->with('mensaje', 'No se encontraron usuarios para el grupo ID ' . $grupo_id);
        }
    
        return view('buscar_usuarios', ['usuarios' => $data]);
    }
}
