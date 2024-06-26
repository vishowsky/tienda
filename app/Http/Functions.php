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
        '2' => 'prueba'

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
            ],
        'products' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => ' Modulo Productos',
            'keys' => [
                'products' => 'Puede ver los productos',
                'product_add' => 'Puede agregar nuevos productos',
                'product_edit' => 'Puede editar productos',
                'product_search' => 'Puede buscar productos',
                'product_delete' => 'Puede eliminar productos',
                'product_gallery_add' => 'Puede agregar imagenes a los productos',
                'product_gallery_delete' => 'Puede eliminar imagenes a los productos',
                'product_inventory' => 'Puede administrar el inventario de un producto',
                ]
        ],
        'categories' => [
            'icon' => '<i class="fa-solid fa-folder"></i>',
            'title' => ' Modulo Categorias',
            'keys' => [
                'categories' => 'Puede ver la lista de categorias.',
                'category_add' => 'Puede crear nuevas categorias.',
                'category_edit' => 'Puede editar las categorias.',
                'category_delete' => 'Puede eliminar las categorias.',
                ]
            ],
            'users' => [
                'icon' => '<i class="fas fa-user-friends"></i>',
                'title' => ' Modulo Categorias',
                'keys' => [
                    'user_list' => 'Puede ver la lista de usuarios.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_banned' => 'Puede bloquear.',
                    'user_permissions' => 'Puede administrar los permisos de usuario',
                    ]
                ],
                'settings' =>[
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'title' => ' Modulo Configuraciones',
                    'keys' => [
                        'settings' => 'Puede modificar la configuracion.',
                    ]
                ],
                'orders' =>[
                    'icon' => '<i class="fas fa-clipboard-list"></i>',
                    'title' => ' Modulo de pedidos',
                    'keys' => [
                        'orders_list' => 'puede ver los pedidos.',
                    ]

                ],'sliders' =>[
                    'icon' => '<i class="far fa-images"></i>',
                    'title' => ' Modulo de Carrusel',
                    'keys' => [
                        'sliders_list' => 'Puede administrar el carrousel.',
                        'slider_add' => 'Puede agregar elementos al carrousel.',
                        'slider_edit' => 'Puede editar elementos del carrousel.',
                        'slider_delete' => 'Puede eliminar elementos del carrousel.',

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
