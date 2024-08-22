<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Inventario General de Equipo</h5>
            <br>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a data-bs-toggle="modal" data-bs-target="#nuevoEquipo" id="btnNuevoEquipo" name="btnNuevoEquipo" type="button" class="btn btn-primary"><i class="fas fa-save "></i>Nuevo equipo</a>
                <a data-bs-toggle="modal" data-bs-target="#asignarEquipoModal" id="btnAsignarEquipo" name="btnAsignarEquipo" type="button" class="btn btn-success"><i class="bi bi-chevron-bar-right"></i>Asignar equipo</a>
                <a data-bs-toggle="modal" data-bs-target="#modalPrint" id="btnPrint" name="btnPrint" type="button" class="btn btn-secondary"><i class="bi bi-collection"></i>Descargar Reporte</a>
            </div>
            <br>
            <hr>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="equipoAsignado" data-bs-toggle="tab" data-bs-target="#ss" type="button" role="tab" aria-controls="home" aria-selected="true">Equipo Asignado</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="equipoDisponible" data-bs-toggle="tab" data-bs-target="#disponible" type="button" role="tab" aria-controls="profile" aria-selected="false">Equipo disponible</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="original" data-bs-toggle="tab" data-bs-target="#dtodo" type="button" role="tab" aria-controls="contact" aria-selected="false">Todo el equipo</button>
                </li>
            </ul>

            <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="ss" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-12 table-responsive">
                        <table class="table align-items-center table-flush table-striped" id="TablaAsignaciones" name="TablaAsignaciones">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Codigo SAP</th>
                                    <th scope="col">Asignado a</th>
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Serie</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="disponible" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-12 table-responsive">
                        <table class="table align-items-center table-flush table-striped" id="TablaDisponibles2" name="TablaDisponibles2" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Codigo SAP</th>
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Serie</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="dtodo" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-12 table-responsive">
                        <table class="table align-items-center table-flush table-striped" id="todo" name="todo" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Codigo SAP</th>
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Serie</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
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

<div class="modal fade" id="asignarEquipoModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar Equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Floating Labels Form -->
                    <form id="modalLineas" name="modalEquiposAsignacion" class="row g-3 p-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="cempleado" name="cempleado" placeholder="City" disabled>
                                <label for="cempleado">Codigo de Empleado</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="usuarioID" name="usuarioID" aria-label="State">
                                    <option selected value="-1">Selecciona un usuario</option>
                                </select>
                                <label for="floatingSelect">Usuario a asignar</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="equipoID" name="equipoID" aria-label="State">
                                    <option selected value="-1">Selecciona un Equipo</option>
                                </select>
                                <label for="floatingSelect">Equipo a asignar</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="proyectoID" name="proyectoID" placeholder="City" disabled>
                                <label for="proyectoID">Pertenece al proyecto</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fechaAsignacionEquipo" name="fechaAsignacionEquipo" placeholder="City">
                                <label for="floatingCity">Fecha de asignación</label>
                            </div>
                        </div>


                        <div class="form-floating">
                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                            <textarea class="form-control" id="observaciones" placeholder="City"></textarea>
                            <label for="floatingCity">Observaciones</label>
                        </div>

                    </form><!-- End floating Labels Form -->
                </div>
            </div>
            <div class="modal-footer">
                <a type="submit" class="btn btn-primary" id="btnGuardarAsignarEquipo"><i class="bi bi-cloud-check-fill"></i> Guardar</a>
                <a type="reset" class="btn btn-secondary" id="btnLimpiarModalEquipo"><i class="bi bi-cloud-fog2"></i> Limpiar</a>
            </div>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<div class="modal fade" id="nuevoEquipo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear registro de nuevo equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Floating Labels Form -->
                    <form id="modalLineas" name="modalEquiposAsignacion" class="row g-3 p-4">
                        <input type="text" id="idEditarEquipo" hidden>
                        <div class="col-md-12">
                            <div class="form-floating floating-select2">
                                <select class="form-select Select2Modal1" id="categoria2" name="categoria2" aria-label="State">
                                    <option selected value="-1">Selecciona una categoria</option>
                                </select>
                                <label for="floatingSelect">Categoria:</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating floating-select2">
                                <select class="form-select Select2Modal1" id="marca2" name="marca2" aria-label="State">
                                    <option selected value="-1">Selecciona una Marca</option>
                                </select>
                                <label for="floatingSelect">Marca:</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating  floating-select2">
                                <select class="form-select Select2Modal1" id="modelo2" name="modelo2" aria-label="State">
                                    <option selected value="-1">Selecciona un modelo</option>
                                </select>
                                <label for="floatingSelect">Modelo:</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating floating-select2">
                                <select class="form-select Select2Modal1" id="proveedor2" name="proveedor2" aria-label="State">
                                    <option selected value="-1">Selecciona un proveedor</option>
                                </select>
                                <label for="floatingSelect">Selecciona un proveedor:</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="precio2" name="precio2" placeholder="City">
                                <label for="floatingCity">Precio:</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="fecha2" name="fecha2" placeholder="City">
                                <label for="floatingCity">Fecha de compra:</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating floating-select2">
                                <select class="form-select Select2Modal1" id="proyecto2" name="proyecto2" aria-label="State">
                                    <option selected value="-1">Selecciona un proyecto</option>
                                </select>
                                <label for="floatingSelect">Pertenece al proyecto:</label>
                            </div>
                        </div>

                        <div class="form-floating">
                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                            <textarea class="form-control" id="descripcion2" placeholder="City"></textarea>
                            <label for="floatingCity"> Descripcion general</label>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="serie2" name="serie2" placeholder="City">
                                <label for="floatingCity">Serie:</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="sap2" name="sap2" placeholder="City">
                                <label for="floatingCity">Codigo SAP:</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating floating-select2">
                                <select class="form-select Select2Modal1" id="estado" name="estado" aria-label="State">
                                    <option selected value="-1">Selecciona un estado</option>
                                </select>
                                <label for="floatingSelect">Estado:</label>
                            </div>
                        </div>
                    </form><!-- End floating Labels Form -->
                </div>
            </div>
            <div class="modal-footer">
                <a type="submit" class="btn btn-primary" id="btnEquipo"><i class="bi bi-cloud-check-fill"></i> Guardar</a>
                <a type="submit" class="btn btn-secondary" id="btnEditarEquipo"><i class="bi bi-cloud-fog2"></i> Editar</a>
            </div>
        </div>
    </div>
</div><!-- End Extra Large Modal-->

<div class="modal fade" id="modalPrint" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona un proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-12">
                    <div id="proyectosPrint" class="col-sm-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnPrintYA" type="button" class="btn btn-primary">Descargar reporte</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->