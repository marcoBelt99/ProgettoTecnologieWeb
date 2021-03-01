@extends('layouts.app')

@section('content')
    
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header py-2">
                    <h4>
                        Gestione delle categorie
                    </h4>
                </div>
            
                <div class="card-body">
                    <form action="{{ URL::action('Admin\CategoryController@store') }}" method="POST">
                        @csrf
                        {{ method_field('POST') }}

                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="category-name">Nome nuova Categoria</label>
                                        <input type="text" name="categoryName" id="category-name" class="form-control" placeholder="Nome Categoria">
                                        <small id="err-mess-small" style="color: #ff0000"></small>
                                    </div>
                                </div>

                                <div class="col-2" style="margin-top: 32px">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">AGGIUNGI</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body py-1">
                    <table class="table table-striped table-hover table-bordered" id="categories-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome Categoria</th>
                                <th scope="col">Raccolte fondi per categoria</th>
                                <th scope="col">Azioni Disponibili</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $fundraisersPerCategory[$category->id] }}</td>
                                    <td>
                                        <a style="text-decoration: none" href="{{ URL::action('Admin\CategoryController@edit', $category->id) }}"><button class="btn btn-primary align-self-xl-center botton-center-category m-1">Modifica</button></a>
                                        @if ($category->id != 1)
                                            <form action="{{ URL::action('Admin\CategoryController@destroy', $category->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" onclick="alert('Attenzione Operazione irreversibile')" class="btn btn-danger align-self-xl-center botton-center-category m-1">Elimina</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection


{{-- SCRIPT SECTION --}}
@section('script')

    <script type="text/javascript">

        $('#success-mess-alert').hide();
        $('#err-mess-small').hide();
        $('#error-mess-alert').hide();

        $(document).ready(function() {

            $('#category-name').on('click', function() {
                $('#error-mess-alert').hide();
                $('#err-mess-small').hide();
                $('#success-mess-alert').hide();
            });

            $('#submit-btn').on('click', function() {

                var newCategoryName = $('#category-name').val();
                var _token = $('#new-category-form-token').val();
                
                if (newCategoryName.length == 0) {
                    $('#err-mess-small').text('Inserire un nome valido').show();
                    return false;
                }
            });
        });
    </script>

@endsection