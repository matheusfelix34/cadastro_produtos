<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

use App\Produto;


class ControllerProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexView()
    {
        
        $prods=Produto::all();
        //$cats=Categoria::all()->pluck('name','id');
       
        

       return view('produtos',compact('prods','cats'));
    }

    
    public function index()
    {
        
        $prods=Produto::all();
       // $cats=Categoria::all()->pluck('name','id');
       
        

       return $prods->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    
    {

        $cats=Categoria::all()->pluck('name','id'); 
        return view('novoproduto', compact('cats') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod= new Produto();
        
        $prod->name= $request->input('nomeProduto');
        $prod->estoque= $request->input('estoqueProduto');
        $prod->preco= $request->input('precoProduto');
        $prod->categoria_id= $request->input('categoria_id');
       
        $prod->save();

        return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod=Produto::find($id);
        if (isset($prod)) {
          return json_encode($prod);
        
        }
        return json_encode('Produto não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod=Produto::find($id);
        $cats=Categoria::all();

        if (isset($prod)) {
            
            return view('editarproduto',compact('prod','cats'));
            
        }

        return redirect('produtos');
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
       
        $prod=Produto::find($id);
        if (isset($prod)) {
            $prod->name=$request->input('name');
            $prod->estoque=$request->input('estoque');
            $prod->preco=$request->input('preco');
            $prod->categoria_id=$request->input('categoria_id');

        $prod->save();
        return json_encode($prod);
        
        }
        return response('Produto não encontrado', 404);
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Produto::find($id);
        if (isset($prod)) {
            $prod->delete();
            # code...
        }
      /*//codigo sem Jquery
       $prod=Produto::find($id);
       if (isset($prod)) {
        $prod->delete($id);

       }
       
       return redirect('produtos');*/
       

    }
}
