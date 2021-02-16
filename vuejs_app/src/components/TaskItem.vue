<template>

<v-card class="task mt-4 pa-2" color="grey lighten-4" rounded flat>
  <v-col cols=12 class="d-flex justify-space-between">
      <v-card-text class="d-flex justify-space-between align-center">
        <div>
          <p 
            v-if="updatingTitle == false" 
            @click="updatingTitle = !updatingTitle"
            class="task-title mb-0" 
            v-bind:class="{ 'text-decoration-line-through': task.status == 1, 'grey--text text--darken-2': task.status == 2 }"
          >
            {{ task.title }}
          </p>
          <v-form v-if="updatingTitle == true" @submit.prevent="updateTaskTitle" >
            <v-text-field 
              @blur="updateTaskTitle"
              v-model="clonedTask.title"
              color="orange darken-3"
              hide-details="auto"
              dense
            >
               <template slot="append-outer">
                <v-btn type="submit" small depressed><v-icon color="orange darken-3" dense>fa-floppy-o</v-icon></v-btn>
              </template>
            </v-text-field>
          </v-form>
          
        </div>

        <div>
          <p v-if="task.category" class="task-category mb-0 mr-8">
            {{ task.category.name }}
          </p>
        </div>
          
      </v-card-text>

      <v-card-actions>
          <v-btn v-if="task.status == 0" @click="updateStatus(1)" class="green px-0 py-5" small><v-icon color="white">fa-square-o</v-icon></v-btn>
          <v-btn v-if="task.status == 1" @click="updateStatus(0)" class="green px-0 py-5" small><v-icon color="white">fa-check-square-o</v-icon></v-btn>
          <v-btn v-if="task.status == 2" @click="updateStatus(1)" class="green px-0 py-5" small><v-icon color="white">fa-undo</v-icon></v-btn>
          <!-- <v-btn class="orange px-0 py-5" small><v-icon color="white">fa-pencil-square-o</v-icon></v-btn> -->
          <v-btn v-if="task.status != 2" @click="updateStatus(2)" class="red px-0 py-5" small><v-icon color="white">fa-archive</v-icon></v-btn>
          <v-btn v-if="task.status == 2" @click="deleteTask" class="red px-0 py-5" small><v-icon color="white">fa-trash</v-icon></v-btn>
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
    updatingTitle: false,
    updatingCategory: false,
    clonedTask: {}
  }),
  computed: {
    ...mapState(['apiURL']),
  },
  methods: {
    updateStatus(newStatus) {
      this.$axios
        .post(`${this.apiURL}/task/edit/status/${newStatus}`, JSON.stringify(this.task))
        .then(() => { this.$emit('updateTasks') })
    },
    deleteTask() {
      this.$axios
        .post(`${this.apiURL}/task/delete`, JSON.stringify(this.task))
        .then(() => { this.$emit('updateTasks') })
    },
    updateTaskTitle() {
      this.$axios
        .post(`${this.apiURL}/task/edit`, JSON.stringify(this.clonedTask))
        .then(() => { this.updatingTitle = false})
    },
    updateTaskCategory() {

    },
  },
  mounted() {
    this.clonedTask = this.task
  }
};
</script>
