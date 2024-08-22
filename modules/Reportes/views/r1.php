<div class="col-lg-12">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Inventario General</h5>
      <br>
      <!--             <button id="btnIngresarEquipo" name="btnIngresarEquipo" class="btn btn-primary"><i class="fas fa-save "></i>Ingresar Equipo</button>
            <button id="btnPrint" name="btnPrint" class="btn btn-warning"><i class="fas fa-print"></i>Imprimir Reporte</button>
 -->
      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button data-bs-toggle="modal" data-bs-target="#ExtralargeModal" id="btnIngresarEquipo" name="btnIngresarEquipo" type="button" class="btn btn-primary"><i class="fas fa-save "></i>Ingresar Equipo</button>
        <button id="btnPrint" name="btnPrint" type="button" class="btn btn-warning"><i class="fas fa-print"></i>Imprimir Reporte</button>
      </div>
      <br>
      <hr>
      <div class="col-md-12 table-responsive">
        <table class="table align-items-center table-flush table-striped" id="r1" name="r1">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID Equipo</th>
              <th scope="col">Descripción</th>
              <th scope="col">Categoria</th>
              <th scope="col">Precio de compra</th>
              <th scope="col">Fecha de compra</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Extra Large Modal -->

<div class="modal fade" id="ExtralargeModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingreso de Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="card">
        <div class="card-body">       

    <!-- Floating Labels Form -->
    <form class="row g-3 p-4" >

      <div class="col-md-6">
        <div class="form-floating mb-3">
          <select class="form-select" id="categoriaID" name="categoriaID" aria-label="State">
            <option selected>Selecciona una categoria</option>

          </select>
          <label for="floatingSelect">Categoria</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-floating">
          <input type="date" class="form-control" id="fechaAdquisicion" name="fechaAdquisicion" placeholder="Password">
          <label for="floatingPassword">Fecha de Compra</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-floating">
          <input type="number" class="form-control" id="precioAdquisicion" placeholder="City">
          <label for="precioAdquisicion">Precio de Compra</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-floating mb-3">
          <select class="form-select" id="proveedorID" name="proveedorID" aria-label="State">
            <option selected>Selecciona un proveedor</option>

          </select>
          <label for="floatingSelect">Proveedor</label>
        </div>
      </div>

      <div class="col-12">
        <div class="form-floating">
          <textarea class="form-control" placeholder="" id="floatingTextarea" id="descripcionGeneral" name="descripcionGeneral" style="height: 100px;"></textarea>
          <label for="floatingTextarea">Descripcion</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="serie" name="serie" placeholder="City">
            <label for="floatingCity">Serie</label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-floating mb-3">
          <select class="form-select" id="ubicacionID" name="ubicacionID" aria-label="State">
            <option selected>Selecciona una ubicación</option>

          </select>
          <label for="floatingSelect">Ubicación</label>
        </div>
      </div>
    </form><!-- End floating Labels Form -->

            </div>
          </div>

      <div class="modal-footer">
        <a type="submit" class="btn btn-primary" id="btnGuardarAsignacion"><i class="bi bi-cloud-check-fill"></i> Guardar</a>
        <a type="reset" class="btn btn-secondary" id="btnLimpiarAsignacion"><i class="bi bi-cloud-fog2"></i> Limpiar</a>
      </div>
      </div>
      </div>
</div><!-- End Extra Large Modal-->