{{-- Pagina dei dettagli della raccolta fondi: link:  --}}
@extends('layouts.app')

@section('content')
    
    <div class="container col-7">
        
        <div class="text text-center py-4">
            <h1>{{ $fundraiser->name }}</h1>
        </div>     
        <div class="card col-12 card-home" style="padding: 0px">
            <div class="card-img-top text-center" style="padding: 10px">
                {{-- Upload immagine da device dell'utente --}}
                <img style="width: 100%" src="{{ Storage::url("{$fundraiser->filename}") }}" alt="{{ $fundraiser->filename }}" />
            </div>
            <div class="card-header" style="height : 62px">
                <p class="card-title" style="font-size: 25px; text-align: center">Descrizione</p>
            </div>
            <div class="card-body">
                {{ $fundraiser->description }}
                <div class="py-4">
                    <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
                    <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
                    <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
                </div>
                <div class="blockquote-footer" >
                    <p>Creata da: {{ $author->first_name }} {{ $author->last_name }}</p>
                </div>
            </div> 
        </div>
    
        <div class="py-4">

            {{-- Controllo login utente/ruolo utente --}}
            @if (Auth::check() && Auth::user()->hasRole('user') && Auth::user()->id != $fundraiser->user_id)
                <a style="text-decoration: none"href="{{ URL::action('DonationController@create', $fundraiser->id) }}"><button type="button" class="btn btn-success btn-lg btn-block">Dona ora</button></a>
            @else
                {{-- Se utente è loggato ed è admin --}}
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="text-center">
                        <h3 style="color: #FF0000">Donazioni non autorizzate per l'utente Admin</h3>
                    </div>
                @endif

                {{-- Utente creatore della campagna --}}
                @if (Auth::check() && Auth::user()->id == $fundraiser->user_id)
                    <div class="text-center">
                        <h3 style="color: #FF0000">Non puoi donare alla tua stessa racconta fondi</h3>
                    </div>
                @endif

                {{-- Se utente non è loggato nel sito --}}
                @if(!Auth::check())
                    <div class="text text-center">
                        <a href="{{ route('login') }}" class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success">Accedi per iniziare a donare!</a>
                    </div>
                @endif
            
            @endif
        </div>


        <h3 style="margin-top: 60px"><i class="far fa-comments"></i> Commenti</h3>
        <table class="table table-striped card-home" id="comments-table">
                
                {{-- Corpo tabella --}}
                <tbody>
                    @foreach ($comments as $c)
                        <tr>
                            <td><i class='far fa-user-circle'></i> {{ $users[$c->id]->first_name }} {{ $users[$c->id]->last_name }}</td>
                            <td>{{ $c->text }}</td>
                            <td>{{ date('d/m/Y', strtotime($c->created_at)) }}</td>
                            <td>
                                @if ((Auth::check() && Auth::user()->id == $c->user_id) || (Auth::check() && Auth::user()->hasRole('admin')))
                                    <a class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $c->id }}" onclick="deleteComment(this)"><i class="fas fa-trash-alt"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach        
                </tbody>
        </table>
    
        <form action="{{ URL::action('CommentController@store') }}" method="POST">
            {{ method_field('POST') }}
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            @if(Auth::check() && Auth::user()->hasRole('user'))
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            @endif
            <input type="hidden" name="fundraiser_id" id="fundraiser_id" value="{{ $fundraiser->id }}">
            <div class="container" style="margin-bottom: 20px">
                <div class="row">
                    @if(Auth::check() && Auth::user()->hasRole('user'))
                    <div class="col-md-10">
                        <textarea name="comment_text" id="comment_text" class="form-control" placeholder="Scrivi un commento!" cols="100%" rows="2"></textarea>
                        <small id="invalid-comment-text-err" class="form-text" style="color: #ff0000"></small>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="add-comment-btn" name="add-comment-btn" class="btn btn-success m-1">Aggiungi</button>
                    </div>
                    @endif
                </div>
            </div>
        </form>            
        @if(Auth::check() && Auth::user()->hasRole('admin'))
            <div class="text-center py-3">
                <h3 style="color: red">L'admin non può inserire commenti</h3>
            </div>
        @elseif(!Auth::check()) 
            <div class="text-center py-3">
                <p>Accedi o Registrati per lasciare un commento</p>
            </div>
        @endif
        
    </div>
@endsection

@section('script')

<script type="text/javascript">

    $('#invalid-comment-text-err').hide();
    
    /* Chiamata ajax delete comment => ed eliminazione riga della tabella dei commenti */
    function deleteComment(html) {

        var row = $(html).parents('tr');
        var commentId = $(html).attr('data-id');
        var _token = $('#_token').val();

        $.ajax({
            url: '/comment/' + commentId,
            type: 'DELETE',
            dataType: 'json',
            data: {
                'commentId': commentId,
                '_token': _token
            },
            success: function (data, status) {
                if (data.status == 'success') {
                    $(row).remove();
                }
            },
            error: function (data, status) {
                console.log(data);
                console.log(status);
            }
        });
    }


    $(document).ready(function() {

        $('#comment-text').on('click', function () {
            $('#invalid-comment-text-err').hide();
        });

        $('#add-comment-btn').on('click', function (e) {
            e.preventDefault();

            var commentText = $('#comment_text').val();
            var userId = $('#user_id').val();
            var fundraiserId = $('#fundraiser_id').val();
            var _token = $('#_token').val();
            
            if (commentText.length == 0) {
                $('#invalid-comment-text-err').text('Inserisci un commento prima di pubblicare').show();
                return false;
            }

            $.ajax({
                url: '/comment',
                type: 'POST',
                dataType: 'json',
                data: {
                    'commentText': commentText,
                    'userId': userId,
                    'fundraiserId': fundraiserId,
                    '_token': _token
                },
                success: function (data, status) {

                    if (data.status == 'success') { // Success
                        // Costruire la riga della tabella con il nuovo commento
                        var userName = data.user.firstName + " " + data.user.lastName;
                        var newUserNameCol = $('<td/>').append("<i class='far fa-user-circle'></i> " + userName);
                        var newTextCol = $('<td/>', {text: data.comment.text});
                        var newDateCol = $('<td/>', {text: data.date});
                        var newRow = $('<tr/>').append(newUserNameCol).append(newTextCol).append(newDateCol);
                        
                        
                        var delAction = $('<a/>', {
                            html: '<i class="fas fa-trash-alt"></i>',
                            class: "btn btn-outline-danger btn-sm btn-delete",
                            onclick: 'deleteComment(this)',
                            "data-id": data.comment.id
                        });
                        
                        var newColAction = $('<td/>').append(delAction);
                        newRow.append(newColAction);
                        $('#comments-table').append(newRow);
                        
                        // Reset del commento
                        $('#comment_text').val('');
                    }
                },
                error: function (data, status) {
                    console.log(data);
                    console.log(status);
                }
            });
        });
    });

</script>

@endsection