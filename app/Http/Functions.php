<?php
function kvfj($json, $key)
{
    if ($json == null):
        return null;
    else:
        //$json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;


}
function getModulesArray()
{
    $a = [
        '0' => 'Productos',
        '1' => 'Blog',
        '2' => 'Coso'

    ];
    return $a;

}

function getRoleUserArray($mode, $id)
{
    $roles = [
        '0' => 'Usuario normal',
        '1' => 'Administrador',
        '2' => 'weon'

    ];
    if (!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
    endif;

}

function getUserStatusArray($mode, $id)
{
    $status = [
        '0' => 'Registrado',
        '1' => 'Verificado',
        '100' => 'Suspendido'

    ];
    if (!is_null($mode)):
        return $status;
    else:
        return $status[$id];
    endif;
}

function user_permissions(){
    $p = [

        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => ' Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dashboard',
                'dashboard_small_stats' => 'Puede ver las estadisticas',
                'dashboard_sell_today' => 'Puede ver la recaudacion del dia',
            ]
        ]
    ];

    return $p;
}

function getUserYears(){
    $ya = date('y');
    $ym = $ya - 18;
    $yo = $ym - 62;

    return[$ym,$yo];
}
