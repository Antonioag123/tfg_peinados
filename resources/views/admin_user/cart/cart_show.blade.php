@extends('layouts.app')

@section('content')

    <div class="row m-4">
        <div class="col-12">
            <h1>Shopping cart</h1><br />
            <a class="btn btn-outline-danger btn_volver" href="{{ route('products.index') }}">Back</a>
        </div>
    </div>
    <div class="container">
        <table id="cart" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @if (session('cart'))
                    @foreach (session('cart') as $id => $value)
                        <tr rowId="{{ $id }}">
                            <td>
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs">
                                        <img src="{{ $value['url'] }}" class="card-img-top" alt="">
                                    </div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $value['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{-- Debo de hacerlo en un formulario mejor --}}1
                                {{-- <input type="number" name="" id=""> --}}
                            </td>
                            <td>
                                {{ $value['price'] }}$
                            </td>
                            <td>
                                <form action="{{ route('paypal') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="price" value="{{ $value['price'] }}">
                                    <input type="hidden" name="product_name" value="{{ $value['name'] }}">
                                    <input type="hidden" name="quantity" value="1">
                                    @canany(['isAdmin', 'isUser'])
                                        <button type="submit">Pay with PayPal</button>
                                    @endcanany
                                </form>
                            </td>
                            <td>
                                
                                <a class="btn btn-outline-danger btn-sm delete_product"><i class="bi bi-trash"></i></a>
                                
                            </td>
                        </tr>
                    @endforeach
                @endif
               
                <td align="right" colspan="2">Total:</td>
                <td class="text-center" id="total"></td>


            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        // Una vez se ha cargado el contenido
        document.addEventListener('DOMContentLoaded', function() {

            /////////////////////////////
            // << AVISO >> SOLO PUEDO METER UN PRODUCTO,
            // PORQUE NO HE PODIDO PAGAR ARRAY DE PRODUCTOS.
            // Una vez que pagas se elimina de sesion
            /////////////////////////////

            //Recojo para sumar los precios en el total
            let priceElements = document.querySelectorAll('td:nth-child(3)');
            let total = 0;

            //Recorre los elementos td
            priceElements.forEach(function(element) {
                // Obtiene el texto del precio y elimina cualquier carácter que no sea un dígito o un punto decimal
                let priceText = element.textContent.trim().replace(/[^\d.]/g, '');          
                //  Lo pasamos a numero
                let price = Number(priceText);
                // Convierte el precio a un número flotante y lo suma al total
                total += parseFloat(price);
            });
            // Cogemos id donde queremos pintar el resultado final
            let tdTotal = document.getElementById('total');

            tdTotal.innerHTML = "";
            // Pintamos con dos decimales solo
            tdTotal.innerHTML += total.toFixed(2) + '$'
        });

        // Selecciona todos los botones con la clase 'delete_product'
        let btn_delete = document.querySelectorAll('.delete_product');

        // Añade un listener para cada botón
        btn_delete.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let ele = $(this);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('delete.product.cart') }}',
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: ele.parents("tr").attr("rowId")
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
