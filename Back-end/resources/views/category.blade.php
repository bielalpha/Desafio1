@extends('layout.app', ["current" => "category" ])

@section('body')

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Categoria</h5>
        <table class="table table-ordered table-hover" id="tabelaEnterprise">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descricão</th>
                    <th>Ações</>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novaEmpresa()">Nova Categoria</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgEnterprise">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formEnterprise">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Cateogoria</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="description" class="control-label">Descrição </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="description" placeholder="Descrição">
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
    
    function novaEmpresa() {
        $('#id').val('');
        $('#description').val('');
        $('#dlgEnterprise').modal('show');
    }
    
    function carregarCategorias() {
        $.getJSON('/api/categorias', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].nome + '</option>';
                $('#categoriaProduto').append(opcao);
            }
        });
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.description+ "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editarEmpresa(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="removerEmpresa(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editarEmpresa(id) {
        $.getJSON('/categoria/editar/'+id, function(data) { 
            $('#id').val(data.id);
            $('#description').val(data.description);
            $('#dlgEnterprise').modal('show');            
        });        
    }

    
    function removerEmpresa(id) {
        $.ajax({
            type: "DELETE",
            url: "/categoria/destroy/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaEnterprise>tbody>tr");
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
    
    function carregarEmpresa() {
        $.getJSON('/categoria/carregar', function(enterprise) { 
            for(i=0;i<enterprise.length;i++) {
                linha = montarLinha(enterprise[i]);
                $('#tabelaEnterprise>tbody').append(linha);
            }
        });        
    }
    
    function SalvarEmpresa() {
        cate = { 
            description: $("#description").val(), 
        };
        $.post("/categoria/create",cate, function(data) {
            console.log(data)
            categoria = JSON.parse(data);
            linha = montarLinha(categoria);
            $('#tabelaEnterprise>tbody').append(linha);            
        });
    }
    
    function UpdateEmpresa() {
        cate = { 
            id: $('#id').val(),
            description: $("#description").val(), 
          
        };
        $.ajax({
            type: "PUT",
            url: "/categoria/update/" + cate.id,
            context: this,
            data:  cate,
            success: function(data) {
                cate = JSON.parse(data);
                console.log( cate)
                linhas = $("#tabelaEnterprise>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == cate.id );
                });
                if (e) {
                    e[0].cells[0].textContent = cate.id;
                    e[0].cells[1].textContent = cate.description;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formEnterprise").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
           UpdateEmpresa();
        else
           SalvarEmpresa();
            
       $("#dlgEnterprise").modal('hide');
    });
    
    $(function(){
       carregarEmpresa();
    })
    
</script>
@endsection
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     