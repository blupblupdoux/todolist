<template>
  <v-form class="d-flex light-green lighten-5 d-flex align-center mt-4 pt-3 px-4">
    <v-row>
      <v-col cols="8">
        <v-text-field 
          class="mr-8" 
          color="light-green darken-4"
          placeholder="Sortir les poubelles"
          >
        </v-text-field>
      </v-col>
      
      <v-col cols="4">
        <v-select
          class="mr-8"
          color="light-green darken-4"
          :items="categories"
          item-text="name"
          label="Catégories"
          clearable
        >
        </v-select>
      </v-col>
    </v-row>
      <v-btn class="mt-n2" color="light-green lighten-4">Ajouter</v-btn>
  </v-form>
</template>

<script>

import { mapState } from 'vuex'

export default {
  name: 'TaskForm',
  data: () => ({
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

<style lang="scss" scoped>

</style>