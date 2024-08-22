<div class="card">
  <div class="card-body">
    <h5 class="card-title">Control de asignaciones de equipo</h5>

    <!-- Floating Labels Form -->
    <form class="row g-3">


      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" class="form-control" id="codCategoria" placeholder="cod" readonly disabled>
          <label for="codCategoria">Código categoría</label>
        </div>
      </div>



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
          <input type="text" class="form-control" id="codUsuario" placeholder="cod" readonly disabled>
          <label for="codUsuario">Código Usuario</label>
        </div>
      </div>



      <div class="col-md-6">
        <div class="form-floating mb-3">
          <select class="form-select" id="usuarioID" name="usuarioID" aria-label="State">
            <option selected>Selecciona un usuario</option>

          </select>
          <label for="floatingSelect">Usuario</label>
        </div>
      </div>



      <div class="col-md-6">
        <div class="form-floating">
          <input type="text" class="form-control" id="codEquipo" placeholder="cod" readonly disabled>
          <label for="codEquipo">Código Equipo</label>
        </div>
      </div>



      <div class="col-md-6">
        <div class="form-floating mb-3">
          <select class="form-select" id="equipoID" name="equipoID" aria-label="State">
            <option selected>Selecciona un equipo</option>

          </select>
          <label for="floatingSelect">Equipo</label>
        </div>
      </div>

      <div class="text-center">
        <a type="submit" class="btn btn-primary" id="btnGuardarAsignacion"><i class="bi bi-cloud-check-fill"></i> Guardar</a>
        <a type="reset" class="btn btn-secondary" id="btnLimpiarAsignacion"><i class="bi bi-cloud-fog2"></i> Limpiar</a>
      </div>
    </form><!-- End floating Labels Form -->
  </div>
</div>