<main role="main" class="col-lg-12 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2 col-lg-6"><?= $title ?></h1>
        	<div class="input-group rounded">
				<input method="post" type="search" id="buscaCliente" class="form-control rounded p-2 col-lg-4 ml-8" placeholder="Busca por id do cliente" aria-label="Search" aria-describedby="search-addon" />
				<span class="input-group-text border-0 ml-2" id="search-addon">
				<i id="btnBuscarCliente" class="fas fa-search" type="button"></i>
        		</span>
        	</div>
	</div>


	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Apelido</th>
					<th>Data de Cadastro</th>
					<th>Estado de Cadastro</th>
					<th>Tipo</th>
					<th>Pontos</th>
					<th>Link de acesso</th>
				</tr>
				
			</thead>
			<tbody id="tdTabelaCliente"></tbody>
        </table>

	</div>
</main>

