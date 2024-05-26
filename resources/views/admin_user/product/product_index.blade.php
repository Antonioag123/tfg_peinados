@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12 mb-4">
            <h1>Shopping</h1>
        </div>        
        {{-- Añadir producto si eres admin --}}
        @can('isAdmin')
            <div class="col-6 mb-3">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#product_modal">
                    <i class="bi bi-cart"></i> Add Product
                </button>
            </div>
        @endcan
        {{-- Con canany puedo pasarle un array de opciones del AuthServiceProvider. En este caso solo podrán acceder a este li los usuarios admin y user --}}
        @canany(['isAdmin', 'isUser'])
            {{-- Carrito --}}
            <a class="btn btn-outline-primary mb-3" href="{{ route('cart.listar') }}">Cart
                <span class="badge bg-danger">{{ count((array) session('cart')) }}</span>
            </a>
        @endcanany

        {{-- Productos --}}
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <form action="{{ route('products.addProduct', $product->id) }}" method="POST">
                        @csrf
                        <div class="card h-100 p-3">
                            <img src="{{ $product->url }}" class="card-img-top" style="height:230px;" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>Price: {{ $product->price }} €</strong></p>
                                <div class="d-grid gap-2 d-md-block">
                                    <button type="submit" class="btn btn-outline-secondary add_cart">
                                        <i class="bi bi-plus-lg"></i> Add to cart
                                    </button>                                                
                                    {{-- <button type="submit" class="btn btn-outline-danger btn_delete_product">
                                        <i class="bi bi-trash-fill"></i>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- Modales --}}
        <div class="modal fade" id="product_modal" tabindex="-1" aria-labelledby="product_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="" action="" id="form_product">
                        @csrf
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name: </label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Url image:</label>
                                        <input type="text" class="form-control" name="url" id="url">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        {{-- step="any" permite introducir numeros decimales o normales --}}
                                        <label for="price" class="form-label">Price: </label>
                                        <input type="number" step="any" class="form-control" name="price"
                                            id="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock: </label>
                                        <input type="number" class="form-control" name="stock" id="stock">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="save_product()">Save product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Se ejecuta cuando el documento html ha sido cargado totalmente. Evento de jQuery 
        $(document).ready(function() {
            // csrf
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        //////////////////////////////////////
        //FUNCTIONS
        //////////////////////////////////////


        // Funcion Guardar producto 
        let save_product = function() {
            // Mensaje de alerta
            Swal.fire({
                title: "Are you sure?",
                text: "Check data before sending",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Save",
                showLoaderOnConfirm: true,
                // En el caso de pulsar el botón true se realiza el preConfirm
                preConfirm: () => {
                    // Token CSRF
                    let token = $('meta[name="csrf-token"]').attr('content');
                    // Elementos de formulario de creación
                    let name_product = document.querySelector('#name').value;
                    let url = document.querySelector('#url').value;
                    let description = document.querySelector('#description').value;
                    let price = document.querySelector('#price').value;
                    let stock = document.querySelector('#stock').value;

                    // Crear objeto FormData
                    let formData = new FormData();
                    // Agregar datos del formulario al objeto
                    formData.append('name_product', name_product);
                    formData.append('url', url);
                    formData.append('description', description);
                    formData.append('price', price);
                    formData.append('stock', stock);

                    // Enviar solicitud fetch con los datos del formulario
                    return fetch('{{ route('products.store') }}', {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token
                        }
                    }).then(response => {
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(text);
                            });
                        } else {
                            return response.json();
                        }
                    }).catch(error => {
                        Swal.showValidationMessage(`Error: ${error.message}`);
                    });
                },
            }).then((result) => {
                if (result.isConfirmed) { // Cuando se haya confirmado la respuesta
                    Swal.fire({
                        title: "Attention",
                        text: "Registration completed",
                        icon: "success",
                        confirmButtonText: 'Accept',
                        timer: 2000, //2 segundos tardara en mostrar el cargando
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {}, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((confirmar) => {
                        if (confirmar.isConfirmed || confirmar.dismiss === Swal.DismissReason.timer) {
                            $('#form_product')[0].reset();
                            // Para esconder el modal una vez se ha creado
                            $('#product_modal').modal('hide');
                            window.location.reload();
                        }
                    });

                } else if (result.isDenied) { // En el caso de no haberse guardado correctamente
                    Swal.fire({
                        title: "Error", // Error de registro 
                        text: "",
                        icon: "error"
                    });
                }
            });
        };
        
    </script>
@endsection
