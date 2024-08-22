<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Listado de modelos registrados en el sistema</h5>
            <br>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a data-bs-toggle="modal" data-bs-target="#modalModelo" id="btnNuevoModelo" name="btnNuevoModelo" type="button" class="btn btn-primary"><i class="bi bi-plus-square"></i> Nuevo Modelo </a>
            </div>
            <br>
            <hr>
            <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-12 table-responsive">
                        <table class="table align-items-center table-flush table-striped" id="tablaModelos" name="tablaModelos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Default Tabs -->
        </div>
    </div>
</div>
</div>

<!-- Extra Large Modal -->
<div class="modal fade" id="modalModelo" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ingrese un nuevo modelo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Floating Labels Form -->
                    <form id="modalModelos" name="modalModelos" class="row g-3 p-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="">
                                <label for="floatingCity">Nombre del modelo</label>
                            </div>
                            <div class="form-floating mt-3">
                                <select class="form-select" id="marcaID" name="marcaID">
                                    <option value="-1" selected>Selecciona una Marca</option>
                                </select>
                                <label for="floatingSelect">Marca</label>
                            </div>
                        </div>
                    </form><!-- End floating Labels Form -->
                </div>
            </div>
            <div class="modal-footer">
                <a type="submit" class="btn btn-primary" id="btnGuardarModelo"><i class="bi bi-cloud-check-fill"></i> Guardar</a>
            </div>
        </div>
    </div>
</div><!-- End Extra Large Modal-->