@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 30px; ">
        <form action="{{ URL::action('UserController@update', Auth::user()) }}" method="POST">
            
            {{ method_field('PUT') }}

            <div class="card">
                <div class="card-header">
                    <h4>I miei dati personali</h4>
                    <div class="text-right" id="expand-card-body-btn1">
                        <a href="#" style="font-size: 16px">Mostra/Nascondi</a>
                    </div>
                </div>
                <div class="card-body" id="user-infos-cont">
                    {{-- Div messaggio successo cambio password --}}
                    <div class="container alert alert-success col-md-10" role="alert" id="changes-success"></div>
                    <p>Modifica e salva i tuoi dati</p>
                    
                    <hr>

                    {{-- Nome - Cognome --}}
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="first_name" class="form-check-label">Nome</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}">
                        </div>
                        
                        <div class="col-6">
                            <label for="last_name" class="form-check-label">Cognome</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}">
                        </div>

                    </div>

                    {{-- Email - Phone Number --}}
                    <div class="form-group row">
                        <label for="email" class="col-form-label col-md-2">Email</label>
                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control-plaintext col-md-6" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-form-label col-md-2">Numero di telefono</label>
                        <input type="text" class="form-control col-md-3" name="phone_number" id="phone_number" value="{{ Auth::user()->phone_number }}">
                    </div>
                    
                    {{-- Data di Nascita --}}
                    <div class="form-group row">
                        <label for="birthday" class="col-form-label col-md-2">Data di nascita</label>
                        <input type="date" class="form-control col-md-4" name="birthday" id="birthday" value="{{ Auth::user()->birthday }}">
                    </div>

                    {{-- Indirizzo - Città - CAP --}}
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="address" class="form-check-label">Indirizzo</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ Auth::user()->address }}">
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="form-check-label">Città</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ Auth::user()->city }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="CAP" class="form-check-label">CAP</label>
                            <input type="text" class="form-control" name="CAP" id="CAP" value="{{ Auth::user()->CAP }}">
                        </div>
                    </div>

                    {{-- hidden fields --}}
                    <div id ="hidden-form-fields">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_user-id" id ="_user-id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="form-group">
                        <a href="#" id="submit-btn" class="btn btn-primary col-md-2">Salva</a>
                    </div>
                    
                </div>
            </div>
        </form>

        {{-- FORM MODIFICA PASSWORD --}}
        {{-- Come cambiare la password => https://gist.github.com/Aslam97/4c320dac0c50f3bbfd64164ad8fdd61a --}}
        <form action="{{ URL::action('Auth\ChangePasswordController@update', Auth::user()) }}" method="POST">

            <div class="card" style="margin-top: 10px; margin-bottom: 30px;">
                <div class="card-header">
                    <h4>Cambia password</h4>
                    <div class="text-right" id="expand-card-body-btn2">
                        <a href="#" style="font-size: 16px">Mostra/Nascondi</a>
                    </div>
                </div>
                
                <div class="card-body" id="user-pass-infos-cont">
                    {{-- Div messaggio successo cambio password --}}
                    <div class="container alert alert-success col-md-10" role="alert" id="pass-change-success"></div>

                    {{-- Div messaggio errore cambio password --}}
                    <div class="container alert alert-danger col-md-10" role="alert" id="pass-error-message">
                        Se l'errore persiste contattare l'assistenza di GimmeFund.
                    </div>

                    <p>Modifica la tua password</p>
                    
                    <hr>

                    {{-- Old Password --}}
                    <div class="form-group row">
                        <div class="col-md-10">
                            <label for="old-password" class="form-check-label">Vecchia password</label>
                            <input type="password" name="old-password" id="old-password" class="form-control col-md-5" placeholder="Vecchia Password">
                            <small id="old-pass-error-mess" style="color: #ff0000"> </small>
                        </div>
                    </div>

                    {{-- New password - Confirm password --}}
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="new-password" class="form-check-label">Nuova Password</label>
                            <input type="password" class="form-control" name="new-password" id="new-password" placeholder="Nuova Password">
                            <small id="new-pass-error-mess" style="color: #ff0000"> </small>
                        </div>
                        
                        <div class="col-6">
                            <label for="confirm-password" class="form-check-label">Conferma Nuova Password</label>
                            <input type="password" class="form-control" name="confirm-new-password" id="confirm-new-password" placeholder="Conferma Nuova Password">
                            <small id="confirm-new-pass-error-mess" style="color: #ff0000"> </small>
                        </div>

                    </div>

                    {{-- hidden form fields --}}
                    <input type="hidden" name="_pass_form_token" id="_pass_form_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_user_id" id="_user_id" value="{{ Auth::user()->id }}">


                    <div class="form-group">
                        <a id="pass-submit-btn" type="submit" class="btn btn-primary col-md-2">Salva</a>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    

@endsection

@section('script')
    {{-- @author Breg - Change user info ajax script --}}
    <script type="text/javascript">

        $('#user-infos-cont').toggle(false);
        $('#user-pass-infos-cont').toggle(false);
        $('#changes-success').hide();


        $(document).ready(function() { 

            $('#expand-card-body-btn1').on('click', function() {
                $('#user-infos-cont').slideToggle(300);
            });

            $('#expand-card-body-btn2').on('click', function() {
                $('#user-pass-infos-cont').slideToggle(300);
            });

            // Form modifica dei dati inseriti
            $('#submit-btn').on('click', function(e) {
                e.preventDefault();

                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var phone_number = $('#phone_number').val();
                var birthday = $('#birthday').val();
                var address = $('#address').val();
                var city = $('#city').val();
                var cap = $('#CAP').val();
                var _token = $('#_token').val();
                var _user_id = $('#_user-id').val();

                $.ajax({
                    url: "/user/"+_user_id,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        'first_name': first_name,
                        'last_name': last_name,
                        'email': email,
                        'phone_number': phone_number,
                        'birthday': birthday,
                        'address': address,
                        'city': city,
                        'CAP': cap,
                        '_token': _token,
                    }, 
                    // In caso di successo
                    success: function(data) {
                        $('#changes-success').text('Modifiche salvate con successo!').show();
                    },
                    // In caso di errore
                    error: function(xhr, status) {
                        /* console.log(status);
                        console.log(xhr.responseJSON.message);
                        console.log(xhr); */
                    }
                }); // Fine AJAX
            });
        });
    </script>
    
    {{-- @author Breg - Change password ajax script --}}
    <script type="text/javascript">
        
        $('#pass-change-success').hide();
        $('#pass-error-message').hide();

        $('#new-password').on('click', function() {
            $('small#new-pass-error-mess').hide();
            $('small#confirm-new-pass-error-mess').hide();
        });


        $('#confirm-new-password').on('click', function() {
            $('small#new-pass-error-mess').hide();
            $('small#confirm-new-pass-error-mess').hide();
        });

        $(document).ready(function() {

            $('a[id=pass-submit-btn]').on('click', function(e) {
                e.preventDefault();

                var old_password = $('#old-password').val();
                var new_password = $('#new-password').val();
                var confirm_new_password = $('#confirm-new-password').val();
                var _user_id = $('#_user_id').val();
                var _token = $('#_pass_form_token').val();

                // Controllo che la vecchia password sia inserita
                if (old_password.length <= 0) {
                    $('#old-pass-error-mess').text('Inserire la password corrente');
                    return false;
                }

                //Controllo lunghezza di new_password 
                if (new_password.length <= 0) {
                    $('small#new-pass-error-mess').text("Inserire la nuova password");
                    return false;
                }

                //Controllo lunghezza di confirm_new_password 
                if (confirm_new_password.length <= 0) {
                    $('small#confirm-new-pass-error-mess').text("Ripeti la nuova password");
                    return false;
                }

                // Controllo che le password corrispondano
                if (new_password != confirm_new_password) {
                    $('small#new-pass-error-mess').text("Non coincidono");
                    $('small#confirm-new-pass-error-mess').text("Non coincidono");
                    return false;auth
                }

                $.ajax({
                    url: '/user/' + _user_id + '/password',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'old_password': old_password,
                        'new_password': new_password,
                        '_token': _token
                    },
                    // richiesta andata AJAX a buon fine
                    success: function(data) {
                        console.log(data);

                        // old_password inserita non corrisponde
                        if (data.status == 'error') {
                            $('#pass-change-success').hide();
                            $('#pass-error-message').text(data.message + "\nSe il problema persiste contatta l'assistenza GimmeFund.\n").show();
                        }

                        // old_password corrisponde a quella attuale
                        if (data.status == 'success') {
                            $('#pass-error-message').hide();
                            $('#pass-change-success').text(data.message + "\n").show();
                        }   
                    },
                    // Errore richiesta AJAX
                    error: function(xhr, status) {
                        console.log(xhr);
                        console.log(status);
                    }
                });

                $('#old-password').on('click', function() {
                    $('#pass-error-message').hide();
                    $('#pass-change-success').hide();
                });
                
            });

        });

        

    </script>
@endsection