<template>

<v-card class="task mt-4 pa-2" color="grey lighten-4" rounded flat>
  <v-col cols=12 class="d-flex justify-space-between">
      <v-card-text class="d-flex justify-space-between">
          <p 
            class="task-title mb-0" 
            v-bind:class="{ 'text-decoration-line-through': task.status == 1, 'grey--text text--darken-2': task.status == 2 }"
          >
            {{ task.title }}
          </p>
          <p v-if="task.category" class="task-category mb-0 mr-8">{{ task.category.name }}</p>
      </v-card-text>

      <v-card-actions>
          <v-btn v-if="task.status == 0" @click="updateStatus(1)" class="green px-0 py-5" small><v-icon color="white">fa-square-o</v-icon></v-btn>
          <v-btn v-if="task.status == 1" @click="updateStatus(0)" class="green px-0 py-5" small><v-icon color="white">fa-check-square-o</v-icon></v-btn>
          <v-btn v-if="task.status == 2" @click="updateStatus(1)" class="green px-0 py-5" small><v-icon color="white">fa-undo</v-icon></v-btn>
          <v-btn class="orange px-0 py-5" small><v-icon color="white">fa-pencil-square-o</v-icon></v-btn>
          <v-btn v-if="task.status != 2" @click="updateStatus(2)" class="red px-0 py-5" small><v-icon color="white">fa-archive</v-icon></v-btn>
          <v-btn v-if="task.status == 2" class="red px-0 py-5" small><v-icon color="white">fa-trash</v-icon></v-btn>
      </v-card-actions>
  </v-col>

  <v-progress-linear 
    value="30"
    :background-color="task.status == 2 ? 'grey lighten-2' : 'light-green lighten-4'"
    :color="task.status == 2 ? 'grey darken-1' : 'light-green darken-3'"
  >
  </v-progress-linear>
</v-card>

</template>

<script>

import { mapState } from 'vuex'

export default {
  name: 'TaskItem',
  props: ['task'],
  data: () => ({
  }),
  computed: {
    ...mapState(['apiURL']),
  },
  methods: {
    updateStatus(newStatus) {

      // let newStatus = null;

      // switch (this.task.status) {
      //   case 0:
      //     newStatus = 1
      //     break;

      //   case 1:
      //     newStatus = 0
      //     break;

      //   case 2:
      //     newStatus = 1
      //     break;
      // }

      this.$axios
        .post(`${this.apiURL}/task/edit/status/${newStatus}`, JSON.stringify(this.task))
        .then(() => { this.$emit('updateTasks') })
    }
  },
};
</script>
