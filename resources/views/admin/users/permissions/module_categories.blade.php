<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <h2 class="title"><i class="fa-solid fa-folder"></i></i>Modulo Categorias</h2>
            </h2>
            <div class="inside">
                <div class="form-check">
                    <input type="checkbox" value ="true"
                        name="categories"@if (kvfj($u->permissions, 'categories')) checked @endif> <label for="categories">Puede
                        ver la lista de categorias.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value ="true"
                        name="category_add"@if (kvfj($u->permissions, 'category_add')) checked @endif> <label
                        for="category_add">Puede crear nuevas categorias.
                    </label>

                </div>
                <div class="form-check">

                    <input type="checkbox" value ="true"
                        name="category_edit"@if (kvfj($u->permissions, 'category_edit')) checked @endif> <label
                        for="category_edit">Puede editar las categorias.
                    </label>

                </div>
                <div class="form-check">

                    <input type="checkbox" value ="true"
                        name="category_delete"@if (kvfj($u->permissions, 'category_delete')) checked @endif> <label
                        for="category_delete">Puede eliminar las categorias.
                    </label>
                </div>




            </div>
        </div>
    </div>
</div>
