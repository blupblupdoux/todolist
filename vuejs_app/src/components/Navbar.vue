<template>
  <v-app-bar app flat>
    <div class="navbar d-flex justify-space-between">
      <v-toolbar-title>Todo List</v-toolbar-title>
      <div class="filter d-flex">
        <div class="status">
          <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                v-bind="attrs"
                v-on="on"
              >
                Statut
                <v-icon>fa-angle-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item
                v-for="(item, index) in status"
                :key="index"
              >
                <v-list-item-title><a href="#">{{ item }}</a></v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
        <div class="category">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                v-bind="attrs"
                v-on="on"
              >
                Catégories
                <v-icon>fa-angle-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item
                v-for="(item, index) in categories"
                :key="index"
              >
                <v-list-item-title><a href="#">{{ item }}</a></v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
        <div class="archive">
          <a href="#">Voir les archives</a>
        </div>
      </div>
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

<style lang="scss" scoped>
  .navbar {
    width: 100%;
  }
</style>
