<section class="content">
    <div class="title">
        <h1>Nueva Tarea</h1>
    </div>
    <form action="<?= URL ?>controller/controlador.php" class="form" method="post">
        <input type="hidden" name="accion" value="guardarTarea">
        <div class="content__input-task">
            <label for="tarea">Tarea</label>
            <input type="text" name="tarea" placeholder="Ingrese la tarea" id="tarea">
        </div>
        <div class="content__input-task">
            <label for="tiempo">Tiempo</label>
            <input type="number" name="tiempo" placeholder="Ingrese el tiempo o duración" id="tiempo">
        </div>
        <div class="content__input-task">
            <div class="checkbox-task__subtitle">Seleccione el dia</div>
            <div class="checkbox-task__days">
                <div class="content-task__day">
                    <div class="task__day">Lunes</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="lunes"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Martes</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="martes"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Miercoles</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="miercoles"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Jueves</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="jueves"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Viernes</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="viernes"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Sabado</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="sabado"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Domingo</div>
                    <div class="task__checkbox"><input type="checkbox" class="checkbox" name="option" value="domingo"></div>
                </div>
                <div class="content-task__day">
                    <div class="task__day">Todos los dias</div>
                    <div class="task__checkbox"><input type="checkbox" name="option" id="everyDay" value="todo los dias"></div>
                </div>
            </div>
        </div>
        <div class="content__input-task">
            <label for="dia">Selecione un dia en especifico</label>
            <input type="date" name="dia" id="dia">
        </div>
        <div class="content__input-task">
            <input type="submit" value="Agregar Tarea" id="btnNuevaTarea">
        </div>
    </form>
</section>