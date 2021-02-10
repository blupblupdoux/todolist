<template>
  <div class="d-flex justify-space-between align-center mx-auto px-10 pt-2  d-flex light-green lighten-4">
    <v-toolbar-title>Todo List</v-toolbar-title>
    <div class="filter d-flex pt-6 ">
      <div class="status mr-3">
        <v-select
          @change="onChange"
          v-model="filters.status"
          :items="status"
          item-text="name"
          item-value="id"
          label="Statut"
          class="pa-0 ma-0"
          color="light-green darken-4"
          clearable
        >
        </v-select>
      </div>
      <div class="category mr-3">
        <v-select
          @change="onChange"
          v-model="filters.category"
          :items="categories"
          item-text="name"
          item-value="id"
          label="Catégories"
          class="pa-0 ma-0"
          color="light-green darken-4"
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
    categories: [],
    filters: {status: null, category: null},
    status: [{id:"0", name:'Incomplètes'}, {id:"1", name:'Complètes'}, {id:"2", name:'Archivées'}],
  }),
  computed: {
    ...mapState(['apiURL']),
  },
  methods: {
    getCategories() {
      this.$axios
      .get(`${this.apiURL}/category`)
      .then(response => { this.categories = response.data })
    },
    onChange() {

      if(!this.filters.status && !this.filters.category) {
        this.$axios
          .get(`${this.apiURL}/task`)
          .then( response => { this.$emit('filtered-tasks', {filteredTasks: response.data}) })

        return
      }

      if(this.filters.status && this.filters.category) {
          this.$axios
          .get(`${this.apiURL}/task/status/${this.filters.status}/category/${this.filters.category}`)
          .then( response => { this.$emit('filtered-tasks', {filteredTasks: response.data}) })

          return
      }

      if(this.filters.status) {
        this.$axios
          .get(`${this.apiURL}/task/status/${this.filters.status}`)
          .then( response => { this.$emit('filtered-tasks', {filteredTasks: response.data}) })

          return
      }

      if(this.filters.category) {
        this.$axios
          .get(`${this.apiURL}/task/category/${this.filters.category}`)
          .then( response => { this.$emit('filtered-tasks', {filteredTasks: response.data}) })

          return
      }
    }
  },
  mounted() {
    this.getCategories()
    
  }
};
</script>

