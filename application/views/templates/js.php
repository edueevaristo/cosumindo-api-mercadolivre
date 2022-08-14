<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
    var base = "<?= base_url('plataformas')?>";

    $(document).ready(function()
    {
        
        $('#btnBuscarMlb').click(function()
        {
            listaDados();
        });

        $('#btnBuscarCliente').click(function()
        {
            dadosCliente();
        });

        $('#btnBuscarApelido').click(function()
        {
            dadosClienteId();
        });
        
    });
    
    function listaDados()
            {
                var mlb = $('#buscaMlb').val();
                if($.trim(mlb)==""){
                   alert('Digite um MLB válido') ;
                   return;
                }

                $.post(base + "/listaTabela", {
                         'mlb' : mlb
                        },
                        function (recebe) {
                            $('#tdTabela').html(recebe.html);

                        }, 'json')
                        
            }
    
    function dadosCliente()
            {
                var id = $('#buscaCliente').val();
                if($.trim(id)==""){
                   alert('Digite um SellerID válido') ;
                   return;
                }

                $.post(base + "/listaTabelaCliente", {
                        recebeIdCliente : id
                    },
                    function (recebeCliente) {
                        $('#tdTabelaCliente').html(recebeCliente.html);
                    },'json')
            }

    function dadosClienteId()
            {
                var apelido = $('#buscaDadosCliente').val();
                if($.trim(apelido)==""){
                   alert('Digite um apelido válido') ;
                   return;
                }

                $.post(base + "/listaTabelaId", {
                    recebeApelidoCliente : apelido
                    },
                    function (recebeApelidoData) {
                        $('#tdTabelaClienteViaApelido').html(recebeApelidoData.html);
                    }, 'json')
            }   
            
            
</script>
</body>
</html>