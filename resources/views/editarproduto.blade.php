@extends('layout.app',["current" => "produtos"])

@section('body')

<div class="card border">
        <div class="card-body">
        <form action="/produtos/{{$prod->id}}" method="POST">
                    
                    {{ csrf_field() }}
                    <div class="form-group" >
                      <label for="nomeCategoria">Nome do Produto</label>
                            <input type="text"  class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto"  value="{{$prod->name}}">
                            <br>
                            <input type="number"  class="form-control" name="estoqueProduto" id="estoqueProduto" placeholder="Estoque"  value="{{$prod->estoque}}" >
                            <br>
                            <input type="number"  min="1"   class="form-control" name="precoProduto" id="precoProduto" placeholder="Preço"  value="{{$prod->preco}}" >



                    </div>

                    <div class="form-group">
                            <label for="categoria_id">Categoria:</label>
                            <select class="custom-select my-1 mr-sm-2" id="categoria_id" name="categoria_id" >
                                <option value="{{$prod->categoria_id}}" selected>{{$cats->find($prod->categoria_id)->name}}</option>
                                @if (count($cats)>0)
                                    @foreach ($cats as $cat)

                                    @if ($cat->id != $prod->categoria_id )
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endif
                                   
                                    @endforeach
                                @endif
                                
                                
                              </select>
                          </div>

                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <button type="cancel" class="btn btn-danger btn-sm" >Cancelar</button>

                </form>
        </div>
    </div>
    
@endsection