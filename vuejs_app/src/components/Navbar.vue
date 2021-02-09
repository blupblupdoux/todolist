<template>
  <div class="d-flex justify-space-between align-center mx-auto px-10 pt-2  d-flex light-green lighten-4">
    <v-toolbar-title>Todo List</v-toolbar-title>
    <div class="filter d-flex pt-6 ">
      <div class="status mr-3">
        <v-select
          class="pa-0 ma-0"
          color="light-green darken-4"
          :items="status"
          item-text="name"
          label="Statut"
          clearable
        >
        </v-select>
      </div>
      <div class="category mr-3">
        <v-select
          class="pa-0 ma-0"
          color="light-green darken-4"
          :items="categories"
          item-text="name"
          label="Catégories"
          clearable
        >
        </v-select>
      </div>
    </div>
  </div>
</template>

<script>

import { mapState } from 'vuex'

export default {
  name: 'Navbar',
  data: () => ({
    status: [{id:"0", name:'Incomplètes'}, {id:"1", name:'Complètes'}, {id:"2", name:'Archivées'}],
    categories: [],
  }),
  computed: {
    ...mapState(['apiURL']),
  },
  methods: {
    getCategories() {
      this.$axios
      .get(`${this.apiURL}/category`)
      .then(response => { this.categories = response.data })
    }
  },
  mounted() {
    this.getCategories()
    
  }
};
</script>

