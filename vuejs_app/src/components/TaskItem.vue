<template>
  <v-card class="task d-flex justify-space-between mt-4 pa-2" color="grey lighten-4" rounded flat>
      <v-card-text class="d-flex justify-space-between">
          <p class="task-title mb-0">A beautiful task to do</p>
          <p class="task-category mb-0 mr-8">Catego 1</p>
      </v-card-text>
      <v-card-actions>
          <v-btn class="green px-0 py-5" small><v-icon color="white">fa-check-square-o</v-icon></v-btn>
          <v-btn class="orange px-0 py-5" small><v-icon color="white">fa-pencil-square-o</v-icon></v-btn>
          <v-btn class="red px-0 py-5" small><v-icon color="white">fa-archive</v-icon></v-btn>
      </v-card-actions>
  </v-card>
</template>

<script>

export default {
name: 'TaskItem',
};
</script>
