@extends('layout.app' , ["current" => "categorias"])

@section('body')
        <h4>Pagina de Categorias</h4>
        <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Categorias</h5>
                 @if (count($cats)>0)
                     
                
                    <table class="table table-dark">
                        <thead>
                          <tr>
 
                            <th scope="col">Código</th>
                            <th scope="col">Nome da Categoria</th>
                            <th scope="col">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($cats as $cat)
                                    
                                <tr>

                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>
                                        <a href="/categorias/editar/{{$cat->id}}" class="btn btn-primary btn-sm">editar</a>
                                        <a href="/categorias/apagar/{{$cat->id}}" class="btn btn-danger btn-sm">Apagar</a>
                                </td>
                                              </tr>
                                @endforeach
                         
                        </tbody>
                      </table>
                      @endif

                </div>
                        <div class="card-footer">
                                <a href="/categorias/novo" class="btn btn-primary btn-sm" role="button">Nova Categoria</a>
                        </div>

            </div>

@endsection