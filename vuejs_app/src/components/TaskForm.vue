<template>
  <v-form class="d-flex">
    <v-row>
      <v-col cols="8">
        <v-text-field class="mr-8"></v-text-field>
      </v-col>
      
      <v-col cols="4">
        <v-select
          class="mr-8"
          :items="categories"
          label="Catégories"
        >
        </v-select>
      </v-col>
    </v-row>
      <v-btn>Ajouter</v-btn>
  </v-form>
</template>

<script>

export default {
  name: 'TaskForm',
  data: () => ({
    categories: ['Catego 1', 'Catego 2'],
  }),
};
</script>

<style lang="scss" scoped>

</style>