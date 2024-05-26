@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Carousel -->
                <div id="demo" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://economia3.com/wp-content/uploads/2020/03/peluquer%C3%ADa.jpg" alt="img1" class="d-block w-100" style="height:500px;">
                        </div>
                        <div class="carousel-item">
                            <img src="https://es.hairfinder.com/imagenes/consejos-de-peluqueria.jpg" alt="img2" class="d-block w-100" style="height:500px;">
                        </div>
                        <div class="carousel-item">
                            <img src="https://th.bing.com/th/id/OIP.LNZBYEtLwa6gKidqnAxuwQHaE8?rs=1&pid=ImgDetMain" alt="img3" class="d-block w-100" style="height:500px;">
                        </div>
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>      
            </div>
            
            <div class="row m-4">
                
                <div class="col-md-3">
                    <div class="card" style="width: 14rem;">
                        <img style="height:280px;" src="https://www.clara.es/medio/2018/10/08/peinados-trenzas-faciles-mujer-2018-holandesa_f52f86b7_1000x1500.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>        
                <div class="col-md-3">
                    <div class="card" style="width: 14rem; ">
                        <img style="height:280px;" src="https://th.bing.com/th/id/OIP._4Zdf65T9jqxdkKvEp3y5QHaJP?w=1086&h=1356&rs=1&pid=ImgDetMain" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>        
                <div class="col-md-3">
                    <div class="card" style="width:14rem;">
                        <img style="height:280px;" src="https://th.bing.com/th/id/R.4a3aa01abc32fe952162613e9ea88df0?rik=zRUVroxOTPrN8Q&riu=http%3a%2f%2fpaolinna.com%2fimages5%2f1120%2facconciature-estive-capelli-lunghi%2facconciature-estive-capelli-lunghi-60.jpg&ehk=%2bqz2ekM30OHJ7EpHz4o0tIRvCBQqUSOJahAU80lpSNE%3d&risl=&pid=ImgRaw&r=0" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>        
                <div class="col-md-3" >
                    <div class="card" style="width: 14rem;">
                        <img style="height:280px;" src="https://4.bp.blogspot.com/-vnJ0r9klZ1A/WqpvFhblvTI/AAAAAAAAhXQ/wHBR3xdytlAC2O3JIWg38UDUk6wb1VUxACPcBGAYYCw/s1600/trenzas-cabello-moda-estilo-3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>         
                        
            </div>

        </div>
    </div>
@endsection
