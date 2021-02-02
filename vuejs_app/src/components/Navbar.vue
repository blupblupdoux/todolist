<template>
  <div class="d-flex justify-space-between align-center mx-auto px-10 py-5 d-flex indigo lighten-5">
    <v-toolbar-title>Todo List</v-toolbar-title>
    <div class="filter d-flex">
      <div class="filterItem status">
        <v-select
        class="pa-0 ma-0"
        :items="status"
          label="Statut"
        >
        </v-select>
      </div>
      <div class="filterItem category">
        <v-select
          class="pa-0 ma-0"
          :items="categories"
          label="Catégories"
        >
        </v-select>
      </div>
      <div class="filterItem archive d-flex align-center">
        <a class="" href="#">Voir les archives</a>
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
    }
  }
  
</style>
