<!-- Componente per gestire tutti i menu-->
<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" v-bind:href="url">
                {{ title }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                   
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
      // Variabili
        props:['title', 'url'],
        mounted(){
            console.log('ci siamo');
        }
    }
</script>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
};
</script>

<script>
export default {
  // Dichiaro le variabili 'title' ed 'url',  che richiamerò nel template
  props: ["title", "url"],
  mounted() {
    // Scrivo sulla console javascript
    console.log("ci siamo");
  },
};
</script>
