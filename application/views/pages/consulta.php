<main role="main" class="col-lg-12 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2 col-lg-6"><?= $title ?></h1>
        	<div class="input-group rounded">
				<input method="post" type="search" id="buscaMlb" class="form-control rounded p-2 col-lg-4 ml-8" placeholder="Insira o MLB" aria-label="Search" aria-describedby="search-addon" />
				<span class="input-group-text border-0 ml-2" id="search-addon">
				<i id="btnBuscarMlb" class="fas fa-search" type="button"></i>
        		</span>
        	</div>
	</div>


	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>MLB</th>
					<th>Título</th>
					<th>Link do Anúncio</th>
					<th>Seller_ID</th>
					<th>Categoria_ID</th>
					<th>Preço</th>
					<th>Tipo de <br>garatia</th>
					<th>Tempo de <br>garantia</th>
					<th>Imagem principal</th>
				</tr>
				
			</thead>
			<tbody id="tdTabela"></tbody>
        </table>

	</div>
</main>

