<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title ?></h1>
      </div>

			<div class="col-md-12">
					<?php if(isset($plataforma)) : ?>
						<form action="<?= base_url('')?>plataformas/editar/<?= $plataforma['id'] ?>" method="post">
					<?php else : ?>
						<form action="<?= base_url('')?>plataformas/inserir" method="post">
					<?php endif; ?>


					<div class="col-md-6">
						<div class="form-group">
							<label for="id">ID</label>
							<input type="text" class="form-control" name="id" id="id" placeholder="ID" required value="<?= isset($plataforma) ? $plataforma["id"] : ""?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="name">Nome da Plataforma</label>
							<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Nome da Plataforma" required value="<?= isset($plataforma) ? $plataforma["titulo"] : ""?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="sigla">Sigla</label>
							<input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" required value="<?= isset($plataforma) ? $plataforma["sigla"] : ""?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="ativo">Ativo</label>
							<input type="text" class="form-control" name="ativo" id="ativo" placeholder="1 para ativo e 0 para inativo" value="<?= isset($plataforma) ? $plataforma["ativo"] : ""?>" required>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="cadastro_novo">Cadastro Novo?</label>
							<input type="text" class="form-control" name="cadastro_novo" id="cadastro_novo" placeholder="true para novo Cadastro" value="<?= isset($plataforma) ? $plataforma["cadastro_novo"] : ""?>" required>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="tipo">Tipo</label>
							<input type="text" class="form-control" name="tipo" id="tipo" placeholder="Marketplace our Ecommerce" value="<?= isset($plataforma) ? $plataforma["tipo"] : ""?>" required>
						</div>
					</div>


					<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>plataformas" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>
					</div>
				</form>
			</div>

    </main>
  </div>
</div>