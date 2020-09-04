@extends('layout.app', ["current" => "produtos" ])

@section('body')

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos</h5>

        <table class="table table-ordered table-hover" id="tabelaProdutos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Unidade</th>
                    <th>Preço</th>
                    <th>Referencia</th>
                    <th>Cod.Categoria</th>
                    <th>Des.Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Novo produto</a>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto">
                <div class="modal-header">
                    <h5 class="modal-title">Novo produto</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeProduto" class="control-label">Descrição</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="description" placeholder="Descrição">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="unidade" class="control-label">Unidade</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="unity" placeholder="Unidade">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precoProduto" class="control-label">Preço</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="price" placeholder="Preço do produto">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Referência</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="reference" placeholder="Referencia">
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="categoria_id" class="control-label">Categoria</label>
                        <div class="input-group">
                            <select class="form-control" id="categoria_id" >
                            </select>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoProduto() {
        $('#id').val('');
        $('#description').val('');
        $('#unity').val('');
        $('#price').val('');
        $('#reference').val('');
        $('#dlgProdutos').modal('show');
    }
    
    function carregarCategorias() {
        $.getJSON('/categoria/carregar', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].description+ '</option>';
                $('#categoria_id').append(opcao);
            }
        });
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.description + "</td>" +
            "<td>" + p.unity+ "</td>" +
            "<td>" + p.price + "</td>" +
            "<td>" + p.reference + "</td>" +
            "<td>" + p.categoria.id+ "</td>" +
            "<td>" + p.categoria.description+ "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('/produto/editar/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#description').val(data.description);
            $('#unity').val(data.unity);
            $('#price').val(data.price);
            $('#reference').val(data.reference);
            $('#categoria_id').val(data.categoria_id);
            $('#dlgProdutos').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/produto/destroy/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaProdutos>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarProdutos() {
        $.getJSON('/produto/carregar', function(produtos) { 
            for(i=0;i<produtos.length;i++) {
                linha = montarLinha(produtos[i]);
                $('#tabelaProdutos>tbody').append(linha);
            }
        });        
    }
    
    function criarProduto() {
        prod = { 
            id : $("#id").val(), 
            description: $("#description").val(), 
            unity: $("#unity").val(), 
            price: $("#price").val(), 
            reference: $("#reference").val(), 
            categoria_id: $("#categoria_id").val() 
        };
        $.post("/produto/create", prod, function(data) {
            produto = JSON.parse(data);
            linha = montarLinha(produto);
            $('#tabelaProdutos>tbody').append(linha);            
        });
    }


    
    function updateProduto() {
        prod = { 
            id : $("#id").val(), 
            description: $("#description").val(), 
            unity: $("#unity").val(), 
            price: $("#price").val(), 
            reference: $("#reference").val(), 
            categoria_id: $("#categoria_id").val() 
        };
        $.ajax({
            type: "PUT",
            url: "/produto/update/" + prod.id,
            context: this,
            data: prod,
            success: function(data) {
                prod = JSON.parse(data);
                linhas = $("#tabelaProdutos>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.description;
                    e[0].cells[2].textContent = prod.unity;
                    e[0].cells[3].textContent = prod.price;
                    e[0].cells[4].textContent = prod.reference;
                    e[0].cells[5].textContent = prod.categoria_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formProduto").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
             updateProduto();
        else
            criarProduto();
            
         //$("#dlgProdutos").modal('hide');
    });
    
    $(function(){
        carregarCategorias();
        carregarProdutos();
    })
    
</script>
@endsection
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     