<template>
  <v-container>

    <Navbar @filtered-tasks="updateTasks" />

    <v-main class="mx-auto">

      <div v-if="tasks" class="tasks" >
        <TaskItem @updateTasks="getTasks" v-for="task in tasks" :key="`task-${task.id}`" :task="task" />
      </div>

      <TaskForm @updateTasks="getTasks" />
      
    </v-main>
  </v-container>
</template>

<script>

import { mapState } from 'vuex'
import Navbar from '../components/Navbar.vue'
import TaskItem from '../components/TaskItem.vue'
import TaskForm from '../components/TaskForm.vue'


export default {
  name: 'Home',
  components: {
    Navbar,
    TaskItem,
    TaskForm,
  },
  data: () => ({
    tasks: [],
  }),
  computed: {
    ...mapState(['apiURL']),
  },
  methods: {
    getTasks() {
      this.$axios
        .get(`${this.apiURL}/task`)
        .then (response => { this.tasks = response.data })
    },
    updateTasks(payload) {
      this.tasks = payload.filteredTasks
    }
  },
  mounted() {
    this.getTasks()
  }
};
</script>

<style lang="scss">
</style>
