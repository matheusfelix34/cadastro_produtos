<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;


class ControllerCategoria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cats =Categoria::all();
        return view('categorias',compact('cats'));
    }


    public function indexJson()
    {

        $cats =Categoria::all();
        return json_encode($cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novacategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat= new Categoria();
        $cat->name = $request->input('nomeCategoria');
       
       
           $cat->save();
          
        return redirect('categorias');
        
        
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
        $cat=Categoria::find($id);
       
        if (isset($cat)) {
            return view('editarcategoria',compact('cat'));
        }

        return redirect('categorias');
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
        $cat=Categoria::find($id);
        if (isset($cat)) {
            $cat->name=$request->input('nomeCategoria');
            $cat->save();
        }

        return redirect('categorias');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $categoria=Categoria::find($id);
        if (isset($categoria)) {
            $categoria->delete();
        }
        return redirect('categorias');
    }



}
