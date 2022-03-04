@extends('layout.app', ["current" => "produtos"])


@section('body')
    
        <div class="card border">

            <div class="card-header">
                <div class="card-title">
                   <h1>Novo produto:</h1> 
                   <br>
                </div>

        </div>
            <div class="card-body">

                <br>
                {!! Form::open(['method' => 'POST', 'route' => 'produtos', 'class' => 'form-horizontal']) !!}
                

                <div class="form-group{{ $errors->has('nomeProduto') ? ' has-error' : '' }}">
                {!! Form::label('nomeProduto', 'Nome:') !!}
                {!! Form::text('nomeProduto', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('nomeProduto') }}</small>
                </div>

                <div class="form-group{{ $errors->has('estoqueProduto') ? ' has-error' : '' }}">
                {!! Form::label('estoqueProduto', 'Estoque:') !!}
                {!! Form::number('estoqueProduto', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('estoqueProduto') }}</small>
                </div>

                <div class="form-group{{ $errors->has('precoProduto') ? ' has-error' : '' }}">
                {!! Form::label('precoProduto', 'Preço:') !!}
                {!! Form::number('precoProduto', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('precoProduto') }}</small>
                </div>


               
         
                <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
                {!! Form::label('categoria_id', 'Input label') !!}
                {!! Form::select('categoria_id', $cats, null, ['id' => 'categoria_id', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('categoria_id') }}</small>
                </div>










                <div class="btn-group pull-right">
               {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} 
                {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}


                 {{--
                    <form action="/produtos" method="POST">
                        
                        {{ csrf_field() }}
                        <div class="form-group" >
                            <label for="nomeCategoria">Nome do Produto</label>
                            <input type="text"  class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto" required>
                            <br>
                            <input type="number"  class="form-control" name="estoqueProduto" id="estoqueProduto" placeholder="Estoque" required>
                            <br>
                            <input type="number"  min="1"   class="form-control" name="precoProduto" id="precoProduto" placeholder="Preço" required>


                            
                        </div>

                        <div class="form-group">
                            <label for="categoria_id">Categoria:</label>
                            <select class="custom-select my-1 mr-sm-2" id="categoria_id" name="categoria_id" required>
                                <option selected>Escolha...</option>
                                @if (count($cats)>0)
                                    @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                @endif
                                
                                
                              </select>
                          </div>
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        

                    </form>

                   --}}
                    <a href="/produtos" class="btn btn-danger btn-sm">Cancelar</a>
            </div>
        </div>
            
@endsection