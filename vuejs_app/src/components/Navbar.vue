<template>
  <div class="d-flex justify-space-between align-center mx-auto px-10 pt-2  d-flex light-green lighten-4">
    <v-toolbar-title>Todo List</v-toolbar-title>
    <div class="filter d-flex pt-6 ">
      <div class="filterItem status">
        <v-select
        class="pa-0 ma-0"
        color="light-green darken-4"
        :items="status"
          label="Statut"
        >
        </v-select>
      </div>
      <div class="filterItem category">
        <v-select
          class="pa-0 ma-0"
          color="light-green darken-4"
          :items="categories"
          label="Catégories"
        >
        </v-select>
      </div>
      <div class="filterItem archive d-flex align-center">
        <a  href="#">Voir les archives</a>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Navbar',
  data: () => ({
    status: ['Toutes', 'Complètes', 'Incomplètes'],
    categories: ['Catego 1', 'Catego 2'],
  }),
};
</script>

<style lang="scss" scoped>
  .filter {

    .filterItem {
      margin-right: 20px;
    }

    .archive > a {
      white-space: nowrap;
      color: #33691E;
    }
  }
  
</style>
