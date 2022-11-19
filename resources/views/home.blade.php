@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Nejnovější příspěvky' }}</p>
    <div class="row">
        <div class="col">
            <div class="card-body">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>
                            <a href="#">
                                XDDDD
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla non lectus sed nisl molestie
                            malesuada. Mauris tincidunt sem sed arcu. Nulla accumsan, elit sit amet varius semper, nulla
                            mauris mollis quam, tempor suscipit diam nulla vel leo. Pellentesque sapien. Nam sed tellus
                            id magna elementum tincidunt. Praesent id justo in neque elementum ultrices. Integer
                            vulputate sem a nibh rutrum consequat. Aliquam erat volutpat. Itaque earum rerum hic tenetur
                            a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut
                            perferendis doloribus asperiores repellat. Temporibus autem quibusdam et aut officiis
                            debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et
                            molestiae non recusandae. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="card-footer">
                        Přidal: <a href="#">Petr</a>
                        <div class="float-right">12.12.2020</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
