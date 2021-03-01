@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header py-2">
                  <h4>Gestione degli Utenti</h4></div>
                  {{-- Inserisco nella barra di ricerca nell'area "Gestione Utenti" un valore da cercare nella tabella --}}
                <div class="card-body">

                    <div class="input-group">
                      <span class="input-group-prepend" style="margin-top: 15; margin-bottom: 15px;">
                        <div class="input-group-text bg-transparent border-right-0">
                          <i class="fa fa-search"></i>
                        </div>
                      </span>
                      <input class="form-control py-2 border-left-0 border ricercaUtente" type="search"  id="inputRicercaUtente" onkeyup="filtraTabella()"  placeholder="cerca in base al nominativo, email o telefono dell'utente" title="Inserisci il nome, il telefono o l'email dell'utente da cercare" style="margin-top: 15; margin-bottom: 15px;"/>
                      <span class="input-group-append">
                        {{-- <button class="btn btn-outline-secondary border-left-0 border" type="button">
                        Search
                        </button> --}}
                      </span>
                    </div>        
                    {{-- <input type="search" id="inputRicercaUtente" class="ricercaUtente" onkeyup="filtraTabella()"  placeholder="cerca in base al nominativo, email o telefono dell'utente" title="Inserisci il nome, il telefono o l'email dell'utente da cercare"> --}}
                    <table id="usersDataTable" class="table table-striped table-hover table-bordered scrollTabellaGestioneUtentiAdmin">
                        {{-- Intestazione tabella --}}
                        <thead class="thead-dark">
                          <tr style="min-width: 872px;">
                            <th scope="col">#</th>
                            <th scope="col">Nominativo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Ruolo</th>
                            <th scope="col">Azioni</th>
                          </tr>
                        </thead>
                        {{-- Corpo tabella --}}
                        <tbody>
                            @foreach ($users as $u)
                            <tr>
                                <th scope="row">{{ $u->id }}</th>
                                <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone_number }}</td>
                                {{-- Separo i ruoli degli utenti, che sono restituiti dalla catena di chiamate di funzioni, sulla base del separatore ',' --}}
                                <td>{{ implode(', ', $u->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    {{-- Metto i bottoni per la Modifica e l'Eliminazione di un Utente. (Premendo su tali bottoni, ovviamente accedo alle rispettive pagine) --}}
                                    <a style="text-decoration:none" href="{{ URL::action('Admin\UsersController@edit', $u->id) }}"><button type="button" class="btn btn-primary align-self-xl-center botton-center m-1">Modifica</button></a>
                                    {{-- Preparo un form (con metodo POST) per l'eliminazione dell'utente --}}
                                    <form action="{{ URL::action('Admin\UsersController@destroy', $u->id)}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger align-content-xl-center botton-center m-1">Elimina</button>
                                    </form>
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


@section('script')
    <script type="text/javascript">
        /* Funzione che (in modo case sensitive) filtra le colonne della tabella in base al nominativo, email e telefono  */
        function filtraTabella() {
            console.log("funziona javascript!!");
            // Dichiaro alcune variabili 
            var input, filter, table, tr, td, i, txtValue1, txtValue2, txtValue3; 
            input = document.getElementById("inputRicercaUtente");
            filter = input.value;
            table = document.getElementById("usersDataTable"); // ottengo la tabella
            tr = table.getElementsByTagName("tr"); // ottengo il vettore delle righe
            //tds = tr.getElementsByTagName('td'); // ottengo un vettore di td
            //var tds = tr.getElementsByTagName('td');
            for (i = 0; i < tr.length; i++) 
            {
            td1 = tr[i].getElementsByTagName("td")[0]; // colonna nominativo
            td2 = tr[i].getElementsByTagName("td")[1]; // colonna email
            td3 = tr[i].getElementsByTagName("td")[2] // colonna telefono
                if (td1 && td2) 
                {
                txtValue1 = td1.textContent || td1.innerText; 
                txtValue2 = td2.textContent || td2.innerText;
                txtValue3 = td3.textContent || td3.innerText;
                if ( (txtValue1.indexOf(filter) > -1) || (txtValue2.indexOf(filter) > -1) || (txtValue3.indexOf(filter) > -1)  ) 
                { 
                tr[i].style.display = "";
                } 
                else 
                {
                tr[i].style.display = "none";
                }
            }       
            }
        } // fine function

        /* Funzione che ordina gli elementi della tabella */
        function sortTable()
        {
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

            const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
            v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
            )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

        // Fai il lavoro...
        document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
        const table = th.closest('table');
        Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
            .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
            .forEach(tr => table.appendChild(tr) );
        })));
        } // fine funzione sortTable
    </script>

         

@endsection

