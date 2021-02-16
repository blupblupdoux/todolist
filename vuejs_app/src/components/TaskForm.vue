<template>
  <v-form class="d-flex light-green lighten-5 d-flex align-center mt-4 pt-3 px-4">
    <v-row>
      <v-col cols="8">
        <v-text-field 
          v-model="task.title"
          class="mr-8" 
          color="light-green darken-4"
          placeholder="Sortir les poubelles"
          >
        </v-text-field>
      </v-col>
      
      <v-col cols="4">
        <v-select
          v-model="task.category"
          class="mr-8"
          color="light-green darken-4"
          :items="categories"
          item-text="name"
          item-value="id"
          label="Catégories"
          clearable
        >
        </v-select>
      </v-col>
    </v-row>
      <v-btn @click="onSubmit" class="mt-n2" color="light-green lighten-4">Ajouter</v-btn>
  </v-form>
</template>

<script>

import { mapState } from 'vuex'

export default {
  name: 'TaskForm',
  data: () => ({
    categories: [],
    task: {},
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
    onSubmit() {
      this.$axios
        .post(`${this.apiURL}/task/add`, JSON.stringify(this.task))
        .then(() => { 
          this.$emit('updateTasks') 
          this.task = {}
        })
    }
  },
  mounted() {
    this.getCategories()
    
  }
};
</script>

<style lang="scss" scoped>

</style>