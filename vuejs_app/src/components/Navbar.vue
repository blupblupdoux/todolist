<template>
  <v-app-bar app flat>
      <v-toolbar-title>Todo List</v-toolbar-title>
      <div class="status">
        <v-select
          :items="status"
          label="Statut"
        ></v-select>
      </div>
      <div class="category">
       <v-select
          :items="categories"
          label="Catégories"
        ></v-select>
      </div>
      <div class="archive">
        <a href="#">Voir les archives</a>
      </div>
  </v-app-bar>
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
