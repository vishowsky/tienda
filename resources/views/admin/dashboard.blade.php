@extends('admin.master')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        @if (kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        Estadisticas
                    </h2>
                </div>
            </div>

            <div class="row mt16">
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-users"></i>
                                Usuarios registrados
                            </h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">{{ $users }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-boxes"></i>
                                Productos creados
                            </h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">{{ $products }}</div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">

                                <i class="fas fa-shopping-basket"></i>
                                Compras de hoy
                            </h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">0</div>

                        </div>
                    </div>
                </div>
                @if (kvfj(Auth::user()->permissions, 'dashboard_sell_today'))

                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-credit-card"></i>
                                Facturado Hoy
                            </h2>
                        </div>
                        <div class="inside">
                            <div class="big_count">0</div>

                        </div>
                    </div>
                </div>
                @endif
            </div>

    </div>
    @endif
    </div>
@endsection
