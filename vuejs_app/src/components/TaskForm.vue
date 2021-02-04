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
          label="Catégories"
        >
        </v-select>
      </v-col>
    </v-row>
      <v-btn class="mt-n2" color="light-green lighten-4">Ajouter</v-btn>
  </v-form>
</template>

<script>

export default {
  name: 'TaskForm',
  data: () => ({
    categories: ['Aucune', 'Catego 1', 'Catego 2'],
  }),
};
</script>

<style lang="scss" scoped>

</style>