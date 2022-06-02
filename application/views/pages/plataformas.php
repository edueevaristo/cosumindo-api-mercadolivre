<main role="main" class="col-lg-12 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"><?= $title ?></h1>
		
		<div class="col" style="text-align: right;">
        <a href="<?= base_url('')?>plataformas/cadastrar">
            <button type="button" class="btn btn-primary">
                Adicionar Plataforma +
            </button>
		</a>
    </div>
	</div>

	


	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Titulo</th>
					<th>Sigla</th>
					<th>Ativo</th>
					<th>Cadastro Novo</th>
					<th>Tipo</th>
					<th>Opções</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($plataformas as $plataforma) : ?>
					<tr>
						<td><?= $plataforma['id'] ?></td>
						<td><?= $plataforma['titulo']?></td>
						<td><?= $plataforma['sigla'] ?></td>
						<td><?= $plataforma['ativo'] ?></td>
						<td><?= $plataforma['cadastro_novo'] ?></td>
						<td><?= $plataforma['tipo'] ?></td>
						<td><a href="<?= base_url('')?>plataformas/mostrar/<?= $plataforma['id'] ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Alterar</a>
							<a href="javascript:deletarPlataforma(<?= $plataforma['id'] ?>)" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Excluir</a>
						</td>                        
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</main>

<script>
		function deletarPlataforma(id)
		{
			var myUrl = 'plataformas/deletar/'+id
			if (confirm("Deseja realmente apagar essa plataforma?")) {
				window.location.href = myUrl;
				alert("A plataforma foi deletado.");
			} else {
				alert("Processo não realizado.");
			}
			return;
		}
	</script>