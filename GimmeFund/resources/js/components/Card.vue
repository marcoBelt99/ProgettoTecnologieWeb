<!-- Componente per gestiere tutte le card-->

<template>
  <div class="card">
    <div class="card-header" v-bind:class="background">{{ title }}</div>

    <div class="card-body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  // Variabili 'title' e 'background'
  props: ["title", "background"],
  mounted() {
    console.log(this.background);
    this.background = "bg-" + (this.background || "primary");
  },
};
</script>


<style lang="scss" scoped>
.card {
  margin-bottom: 10px;
  .card-header {
    color: white;
  }
}
</style>

