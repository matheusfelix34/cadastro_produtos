@extends('layout.app', ["current" => "produtos" ])

@section('body')
        <h4>Pagina de Produtos</h4>
        <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                
                     
                
                    <table id="tabela_produtos" class="table table-dark">
                        <thead>
                          <tr>
 
                            <th >Código</th>
                            <th >Nome do  Produto</th>
                            <th >Preço</th>
                            <th >Categoria</th>
                            <th >Ações</th>
                          </tr>
                        </thead>
                        <tbody >
                               
                                
                         
                        </tbody>
                      </table>
                     

                </div>
                        <div class="card-footer">
                                <a  class="btn btn-primary btn-sm" role="button" onclick="novoProduto()">Novo Produto</a>


                        </div>

            </div>

             <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">


                                <div class="modal-header">
                                        <h1>Novo produto:</h1> 
                                        <br>
                                     </div>

                                <div class="modal-body">
                                        
                                           
                                {!! Form::open(['method' => 'POST','class' => 'form-horizontal', 'id' => 'formProduto']) !!}
                                
                                

                                {!! Form::hidden('id', 'value', ['class' => 'form-control', 'id' => 'id']) !!}


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
                
                                        <section id="teste_select"></section>
                               
                         
                                <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
                                {!! Form::label('categoria_id', 'Categoria:') !!}
                                {!! Form::select('categoria_id',[], null, ['id' => 'categoria_id', 'class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('categoria_id') }}</small>
                                </div>
                
                
                
                
                
                
                
                
                
                
                                <div class="btn-group pull-right">
                                <a class="btn btn-danger" onclick="cancelNovoProduto()"><i class="fa fa-btn fa-bank"></i>Cancel</a>
                                 {{--  <a class="btn btn-primary" onclick="cadastrarProduto()"><i class="fa fa-btn fa-bank"></i>Salvar</a> --}}

                              {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!} 
                                </div>
                                {!! Form::close() !!}

                        </div> 





                        </div>
                        
                     </div>



             </div>


@endsection

             @section('javascript')

             <script type="text/javascript">
                         
                        //funcao que vai setar um token csrf para todas as requisições 
                        //em vez de termos que adicinar manualmente em cada requisicao ajax
                $.ajaxSetup({
                     headers: {
                             'X-CSRF-TOKEN': "{{ csrf_token() }}"
                     }           

                });
               


             function novoProduto() {
                $('#id').val('');
                $('#nomeProduto').val('');
                $('#estoqueProduto').val('');
                $('#precoProduto').val('');
                $('#categoria_id').val('');
                

                $('#dlgProdutos').modal('show')
             }
                
                function cancelNovoProduto(){
                $("#dlgProdutos").modal('hide')
                }


                function carregarCategorias() {
                        $.getJSON('/api/categorias', function(data){
                               
                                
                                for(i=0;i<data.length;i++){
                                        opcao = '<option value="' + data[i].id +'">' +
                                        data[i].name + '</option>';
                                        $('#categoria_id').append(opcao);
                                }
                        });
                }



                //funcao para nome categoria



                function carregarProduto(p){
                        
                        var row = "<tr>"+
                        "<td>"+p.id+"</td>"+
                        "<td>"+p.name+"</td>"+        
                        "<td>"+p.preco+"</td>"+
                        "<td>"+p.categoria_id+"</td>"+
                        "<td>"+
                         '<button class="btn btn-xs btn-primary" onclick="editar('+p.id+')"> Editar </button>'+
                         '<button class="btn btn-xs btn-danger" onclick="remover('+p.id+')"> Apagar </button>'+
                        "</td>"+ 
                        "</tr>";
                       
                        return row;
                }

                function mostrarProdutos(){
                        
                        $.getJSON('/api/produtos', function(produtos){
                               
                                for (i= 0; i<produtos.length; i++) {
                                        
                                        row= carregarProduto(produtos[i]);
                                        $('#tabela_produtos>tbody').append(row);
                                      
                                }
                        });  
                }

               

                function cadastrarProduto(){
                        
                        nomeProduto=$('#nomeProduto').val();
                        estoqueProduto=$("#estoqueProduto").val();
                        precoProduto=$('#precoProduto').val();
                        categoria_id=$('#categoria_id').val();
                        prod={nomeProduto,estoqueProduto,precoProduto,categoria_id};
                        
                        $.post("/api/produtos", prod, function(data){
                                      //console.log(data);
                                        produto= JSON.parse(data);
                                        console.log(produto);
                                        row= carregarProduto(produto);
                                        $('#tabela_produtos>tbody').append(row);
                        });
   
                }

                 function remover(id){
                         $.ajax({
                                 type: "DELETE",
                                 url: "/api/produtos/" +id,
                                 context: this,
                                 success: function(){
                                        console.log('Apagou OK');
                                        linhas=$("#tabela_produtos>tbody>tr");
                                        //aqui estamos usando a funcao filter do jquery, para
                                        //ler as linhas da tabela e procurar a libha com o id que
                                        //queremos. As linhas são divididas em celulas, como 
                                        //sabemos que a primeira celula da linha é a que vai estar o id
                                        //sabemos que a celula que deve ser checada é a [0]
                                       e=linhas.filter(function(i, elemento) {
                                                return elemento.cells[0].textContent== id;
                                        });
                                        console.log(e);
                                        if(e)
                                          e.remove();
                                        
                                 },
                                 error: function(error) {
                                         console.log(error);
                                 }

                         });
                 }

                 function editar(id){
                         $.getJSON('/api/produtos/'+id, function(data){
                                console.log(data);
                                $('#id').val(data.id);
                                $('#nomeProduto').val(data.name);
                                $('#estoqueProduto').val(data.estoque);
                                $('#precoProduto').val(data.preco);
                                $('#categoria_id').val(data.categoria_id);
                                $('#dlgProdutos').modal('show');
                         });

                 }

                 function  salvarProduto() {
                        prod = {      
                        id: $("#id").val(),
                        name: $("#nomeProduto").val(),
                        estoque :$("#estoqueProduto").val(),
                        preco : $("#precoProduto").val(),
                        categoria_id : $("#categoria_id").val()
                               }; 
                               
                               console.log(prod);
                      $.ajax({
                              type: "PUT",
                              url: "/api/produtos/" + prod.id,
                              context: this,
                              data: prod,
                              success: function(data){
                                prod = JSON.parse(data);
                                //passamos para json aqui, devido a fato de que o filter só passa
                                //com o formato json
                                linhas=$("#tabela_produtos>tbody>tr");

                                e=linhas.filter(function(i, e){
                                        return (e.cells[0].textContent == prod.id);
                                });
                                if (e) {
                                        //O 'e', se trata de um array, e cada cell uma colua da linha
                                    
                                    e[0].cells[0].textContent = prod.id;
                                    e[0].cells[1].textContent = prod.name;
                                    e[0].cells[2].textContent = prod.preco;
                                    e[0].cells[3].textContent = prod.categoria_id;

                                }
                                 
                                console.log('Salvou OK');
                                

                                
                              },
                              error: function(error){
                                      console.log(error);
                              }
                                
                      });        


                      

                 }

                $("#formProduto").submit( function(event){
                        event.preventDefault();
                        if ($("#id").val() != '') {
                                salvarProduto();  
                                
                               
                        }else{

                                cadastrarProduto();
                        
                        }
                       
                        $("#dlgProdutos").modal('hide');

                });


                $( function(){
                        
                        mostrarProdutos();
                        carregarCategorias();
                });

             </script>
                

             @endsection

{{--
@section('body')
        <h4>Pagina de Produtos</h4>
        <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                 @if (count($prods)>0)
                     
                
                    <table class="table table-dark">
                        <thead>
                          <tr>
 
                            <th scope="col">Código</th>
                            <th scope="col">Nome do  Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Ações</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($prods as $prod)
                                    
                                <tr>

                                <td>{{$prod->id}}</td>
                                <td>{{$prod->name}}</td>
                                <td>{{$prod->preco}}</td>
                                <td>{{$cats->find($prod->categoria_id)->name}}</td>
                                <td>
                                        <a href="/produtos/editar/{{$prod->id}}" class="btn btn-primary btn-sm">editar</a>
                                        <a href="/produtos/apagar/{{$prod->id}}" class="btn btn-danger btn-sm">Apagar</a>
                                </td>
                                              </tr>
                                @endforeach
                         
                        </tbody>
                      </table>
                      @endif

                </div>
                        <div class="card-footer">
                                <a href="/produtos/novo" class="btn btn-primary btn-sm" role="button">Novo Produto</a>
                        </div>

            </div>

@endsection
 --}}