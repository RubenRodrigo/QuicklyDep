<div class="container p-0 m-0">
    <h3>FILTROS</h3>
    <div class="row border border-gray p-3 m-0 mt-4">
        <div class="form-row">
            <div class="col-md-12">            
                <h4>Tipo de publicación</h4>
            </div>
            <!--Señalamiento de filtrado de datos-->
            @isset($tipo)
            <div class="form-group col-md-10 offset-md-1">
                @if($tipo==='Venta')
                <button class="btn btn-secondary my-2 my-sm-0 btn-block" disabled><a class="dropdown-item btn btn-outline-light">Ventas</a></button>
                @else
                <button class="btn btn-outline-dark my-2 my-sm-0 btn-block"><a class="dropdown-item btn btn-outline-light" href="{{route('posts.filtro', ['tipo'=> 'Venta'])}}">Ventas</a></button>
                @endif
            </div>
            <div class="form-group col-md-10 offset-md-1">
                @if($tipo==='Alquiler')
                <button class="btn btn-secondary my-2 my-sm-0 btn-block" disabled><a class="dropdown-item btn btn-outline-dark">Alquiler</a></button>
                @else
                <button class="btn btn-outline-dark my-2 my-sm-0 btn-block"><a class="dropdown-item btn btn-outline-dark" href="{{route('posts.filtro', ['tipo'=> 'Alquiler'])}}">Alquiler</a></button>
                @endif
            </div>       
            @else
            <div class="form-group col-md-10 offset-md-1">
                <button class="btn btn-outline-dark my-2 my-sm-0 btn-block"><a class="dropdown-item btn btn-outline-dark" href="{{route('posts.filtro', ['tipo'=> 'Venta'])}}">Ventas</a></button>
            </div>
            <div class="form-group col-md-10 offset-md-1">
                <button class="btn btn-outline-dark my-2 my-sm-0 btn-block"><a class="dropdown-item btn btn-outline-dark" href="{{route('posts.filtro', ['tipo'=> 'Alquiler'])}}">Alquiler</a></button>
            </div>   
            @endisset 
        </div>
    </div>
    <div class="row border border-gray m-0 p-3">
        <form action="{{route('posts.precio',['precio'=>'100'])}}" method="GET">
            <div class="form-row">
                <div class="col-md-12">
                    <h3>Precio</h3>
                </div>     
                <!--Controlamos los aspectos de filtrado múltiple-->       
                @isset($precio1)
                <div class="form-group col-md-6">
                    <label>Desde: </label>
                    <input type="number" class="form-control" value="{{$precio1}}" name="precio1">
                    @isset($tipo)
                    @if($tipo==='Venta')
                    <input type="hidden" value="Venta" name="tipo">
                    @endif
                    @endisset
                </div>
                <div class="form-group col-md-6">
                    <label>Hasta: </label>
                    <input type="number" class="form-control" value="{{$precio2}}" name="precio2">
                    @isset($tipo)
                    @if($tipo==='Alquiler')
                    <input type="hidden" value="Alquiler" name="tipo">
                    @endif
                    @endisset
                </div>
                @else
                <div class="form-group col-md-6">
                    <label>Desde: </label>
                    <input type="number" class="form-control" value="" name="precio1">
                    @isset($tipo)
                    @if($tipo==='Venta')
                    <input type="hidden" value="Venta" name="tipo">
                    @endif
                    @endisset
                </div>
                <div class="form-group col-md-6">
                    <label>Hasta: </label>
                    <input type="number" class="form-control" value="" name="precio2">
                    @isset($tipo)
                    @if($tipo==='Alquiler')
                    <input type="hidden" value="Alquiler" name="tipo">
                    @endif
                    @endisset
                </div>
                @endisset
                <div class="form-group col-md-12">
                    <button class="btn btn-outline-dark btn-block my-2 my-sm-0" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

</div>