@extends('layouts.app')

@section('content')
    
    <div class="container">

        <div class="card shadow p-3 mb-5 bg-white rounded" style="margin-top: 20px;">
            <div class="card-body">
                <h3 class="card-title">
                    Edit Categoria
                </h3>
                
                <div class="alert alert-success align-center" id="success-mess-container">
                    <!-- Informations Goes Here -->   
                </div>

                <form action="{{ URL::action('Admin\CategoryController@update', $category->id) }}" method="POST">
                    {{-- Hidden form field --}}
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="category-id" id="category-id" value="{{ $category->id }}">

                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col">
                            <div class="from-group">
                                <label for="new-category-name">Modifica nome categoria</label>
                                <input type="text" class="form-control" name="new-category-name" id="new-category-name" value="{{ $category->name }}">
                                <small id="help-mess" class="form-text text-muted">Modifica il nome della categoria: {{ $category->name }}</small>
                            </div>
                        </div>
                        <div class="col">
                            <a class="btn btn-success" type="submit" id="submit-btn" name="submit-btn" style="margin-top: 32px;">Salva</a>
                            <a href="{{ URL::action('Admin\CategoryController@index') }}" class="btn btn-secondary" type="submit" style="margin-top: 32px;">Indietro</a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

    </div>

@endsection

@section('script')
    {{-- Script section --}}

    <script type="text/javascript">

        $('#success-mess-container').hide();

        $(document).ready(function () {
            
            $('#submit-btn').on('click', function() {

                var categoryId = $('#category-id').val();
                var newCategoryName = $('#new-category-name').val();
                var _token = $('#_token').val();

                $.ajax({
                    url: '/admin/category/' + categoryId,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        'categoryId': categoryId,
                        'newCategoryName': newCategoryName,
                        '_token': _token
                    },
                    success: function (data, status) {
                        /* console.log(status);
                        console.log(data); */
                        $('#success-mess-container').text('Categoria aggiornata con successo').show();
                    }, 
                    error: function name(xhr) {
                        console.log(xhr);
                    }
                });

            })
        });
        

    </script>

@endsection