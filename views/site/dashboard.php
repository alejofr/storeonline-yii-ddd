<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
$this->registerJsFile('/js/product.js', ['defer' => true]);
$this->registerJsFile('/js/logout.js', ['defer' => true]);

?>
<div class="content">
  <br>
  <br>
  <br>
  <div class = "container">
    <div class="row mb-5">
      <div class="col-lg-6 col-sm-12">
        <button type="button" id="btnPorduct" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear Producto</button>
      </div>
      <div class="col-lg-6 col-sm-12 justify-content-end d-flex">
        <button type="button" class="btn btn-danger" id="btnLogout">Cerrar sesion</button>
      </div>
    </div>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descrpcion</th>
                <th>stock</th>
                <th>price</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="dataProducts">
            
        </tbody>
    </table>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="formProduct">
        <input type="text" name="name" class="form-control mb-3" placeholder="Name">

        <input type="text" name="description" class="form-control mb-3" placeholder="description">

        <input type="number" name="stock" class="form-control mb-3" placeholder="Stock">

        <input type="text" name="price" pattern="^[0-9]+(.[0-9]+)?$" class="form-control" placeholder="Price">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnSaveProduct">Guardar</button>
      </div>
    </div>
  </div>
</div>