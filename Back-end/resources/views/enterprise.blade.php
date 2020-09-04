@extends('layout.app', ["current" => "enterprise" ])

@section('body')

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Empresa</h5>
        <table class="table table-ordered table-hover" id="tabelaEnterprise">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cnpj</th>
                    <th>Nome Empresa</th>
                    <th>Nome fantasia</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novaEmpresa()">Nova Empresa</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgEnterprise">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formEnterprise">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Empresa</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="name" class="control-label">Razão Social </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" placeholder="Razão Social">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fantasy_name" class="control-label">Nome Fantasia</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fantasy_name" placeholder="Nome Fantasia">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="cnpj" class="control-label">Cnpj</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cnpj" placeholder="Cnpj">
                        </div>
                    </div>              
                    
                    <div class="form-group">
                        <label for="registre_state" class="control-label">Inscrição Estadual</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="registre_state" placeholder="Inscricao Estadual">
                        </div>
                    </div> 
                    <input type="hidden" id="address_id" class="form-control">

                    <div class="form-group">
                        <label for="street" class="control-label">Rua</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="street" placeholder="Rua">
                        </div>
                    </div>   

                    <div class="form-group">
                        <label for="complement" class="control-label">Complemento</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="complement" placeholder="Complemento">
                        </div>
                    </div>   

                    <div class="form-group">
                        <label for="city" class="control-label">Cidade</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="city" placeholder="Cidade">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="state" class="control-label">Estado</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="state" placeholder="Estado">
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
        $('#name').val('');
        $('#fantasy_name').val('');
        $('#cnpj').val('');
        $('#registre_state').val('');
         $('#address_id').val('');
        $('#street').val('');
        $('#complement').val('');
        $('#city').val('');
        $('#state').val('');
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
            "<td>" + p.cnpj + "</td>" +
            "<td>" + p.name + "</td>" +
            "<td>" + p.fantasy_name + "</td>" +
            "<td>" + p.address_id+ "</td>" +
            "<td>" + p.address.street + "</td>" +
            "<td>" + p.address.city + "</td>" +
            "<td>" + p.address.state + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editarEmpresa(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="removerEmpresa(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editarEmpresa(id) {
        $.getJSON('/enterprise/editar/'+id, function(data) { 
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#fantasy_name').val(data.fantasy_name);
            $('#cnpj').val(data.cnpj);
            $('#registre_state').val(data.registre_state);
            $('#address_id').val(data.address_id);
            $('#street').val(data.address.street);
            $('#complement').val(data.address.complement);
            $('#city').val(data.address.city);
            $('#state').val(data.address.state);
            $('#dlgEnterprise').modal('show');            
        });        
    }

    
    function removerEmpresa(id) {
        $.ajax({
            type: "DELETE",
            url: "/enterprise/destroy/" + id,
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
        $.getJSON('/enteprise/carregar', function(enterprise) { 
            for(i=0;i<enterprise.length;i++) {
                linha = montarLinha(enterprise[i]);
                $('#tabelaEnterprise>tbody').append(linha);
            }
        });        
    }
    
    function SalvarEmpresa() {
        empre = { 
            name: $("#name").val(), 
            fantasy_name: $("#fantasy_name").val(), 
            cnpj: $("#cnpj").val(), 
            registre_state: $("#registre_state").val(), 
            address_id: $("#address_id").val(), 
            street: $("#street").val(), 
            complement: $("#complement").val(), 
            city: $("#city").val(), 
            state: $("#state").val(), 
        };
        $.post("/enteprise/create", empre, function(data) {
            console.log(data)
            empresa = JSON.parse(data);
            linha = montarLinha(empresa);
            $('#tabelaEnterprise>tbody').append(linha);            
        });
    }
    
    function UpdateEmpresa() {
        empre = { 
            id: $('#id').val(),
            name: $("#name").val(), 
            fantasy_name: $("#fantasy_name").val(), 
            cnpj: $("#cnpj").val(), 
            registre_state: $("#registre_state").val(), 
            address_id: $("#address_id").val(), 
            street: $("#street").val(), 
            complement: $("#complement").val(), 
            city: $("#city").val(), 
            state: $("#state").val(), 
        };
        $.ajax({
            type: "PUT",
            url: "/enterprise/update/" + empre.id,
            context: this,
            data: empre,
            success: function(data) {
                empre = JSON.parse(data);
                linhas = $("#tabelaEnterprise>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == empre.id );
                });
                if (e) {
                    e[0].cells[0].textContent = empre.id;
                    e[0].cells[1].textContent = empre.cnpj;
                    e[0].cells[2].textContent = empre.name;
                    e[0].cells[3].textContent = prod.fantasy_name;
                    e[0].cells[4].textContent = prod.street;
                    e[0].cells[5].textContent = prod.city;
                    e[0].cells[6].textContent = prod.state;
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
            
     //  $("#dlgEnterprise").modal('hide');
    });
    
    $(function(){
       carregarEmpresa();
    })
    
</script>
@endsection
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     