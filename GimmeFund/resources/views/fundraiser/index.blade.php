<?php
/* Importo la classe per le donazioni */
use App\Donation;
?>

@extends('layouts.app')

@section('content')
{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
    @foreach ($fundraisers as $fundraiser)
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ $fundraiser->name }}</h1>
                <p class="lead">{{ $fundraiser->description }}</p>
                    <hr class="my-4">
                {{-- Faccio alcune queries con eloquent  --}}
                <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
                <p>Raccolti: {{ number_format(Donation::select('amount')->where('fundraiser_id', $fundraiser->id)->sum('amount'), 2, '.', ',') }}</p>
                <p>Obiettivo: {{ number_format($fundraiser->goal, 2, ',', '.') }}</p>
                <p class="lead">
                    {{-- Sistemo il bottone, il quale linka ad una pagina di informazioni --}}
                    <a href="{{ URL::action('FundraiserController@show', $fundraiser->id) }}"><button type="button" class="btn btn-primary btn-lg">Altre informazioni</button></a>
                </p>
                    
                    {{-- Provo ad inserire la progressbar --}}
                    <script type="text/javascript">
                    $(function() {

                        let progressbar = $("#progressbar");
                        let fill = progressbar.find(".fill");
                        let incomplete = progressbar.find(".incomplete");
                      
                        $(".items.first-col").sortable({
                          connectWith: ".items.second-col",
                          receive: function(event, ui) {
                            recalculate(ui.item.closest(".items"));
                          }
                        });
                      
                        $(".items.second-col").sortable({
                          connectWith: ".items.first-col",
                          receive: function(event, ui) {
                            recalculate(ui.sender);
                          }
                        });
                      
                      
                        // Calculate items
                        function recalculate(items) {
                          let total = 0;
                      
                          items.find(".credits").each(function() {
                            total += parseInt(jQuery(this).val());
                          });
                      
                          // dont go over 80
                          if (total <= 80) {
                            let percentage = total * 80 / 100;
                            fill.width(percentage + "%");
                            fill.find("span").text(total);
                            incomplete.find("span").text(80 - total);
                          } else {
                            $("#timetable .items").sortable('cancel');
                          }
                      
                          progressbar.attr("data-full", "false");
                          if (total == 80) {
                            progressbar.attr("data-full", "true");
                            fill.width("100%");
                          }
                        }
                        recalculate(jQuery(".items.first-col"));
                        $(".items.first-col").sortable("refresh");
                      
                      });
                      </script>

                  <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                  </div>
                      {{-- Fine prova progress bar --}}
        </div>
    </div>
  @endforeach
@endsection
                    
