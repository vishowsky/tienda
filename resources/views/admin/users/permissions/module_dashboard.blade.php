<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <h2 class="title"><i class="fas fa-home"></i>Modulo Dashboard</h2>
            </h2>
            <div class="inside">
                <div class="form-check">
                    <input type="checkbox" value ="true" name="dashboard"@if(kvfj($u->permissions, 'dashboard' )) checked @endif>
                    <label for="dashboard">Puede ver el dashboard.
                    </label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value ="true" name="dashboard_small_stats"@if(kvfj($u->permissions, 'dashboard_small_stats' )) checked @endif>
                    <label for="dashboard_small_stats">Puede ver las estadisticas rapidas.
                    </label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value ="true" name="dashboard_sell_today"@if(kvfj($u->permissions, 'dashboard_sell_today' )) checked @endif>
                    <label for="dashboard_sell_today">Puede ver lo recaudado del dia.
                    </label>
                </div>

            </div>


        </div>
    </div>
</div>
