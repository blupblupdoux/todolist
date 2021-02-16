<template>
  <v-container>

    <Navbar @filters="getFilters" />

    <v-main class="mx-auto">

      <TaskForm @updateTasks="updateTasks" />

      <div v-if="tasks" class="tasks" >
        <TaskItem @updateTasks="updateTasks" v-for="task in tasks" :key="`task-${task.id}`" :task="task" />
      </div>

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
    filters: {},
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
    getFilters(payload) {
      this.filters = payload.filters
      this.updateTasks()
    },
    updateTasks() {

       if(!this.filters.status && !this.filters.category) {
        this.$axios
          .get(`${this.apiURL}/task`)
          .then( response => { this.tasks = response.data })

        return
      }

      if(this.filters.status && this.filters.category) {
          this.$axios
          .get(`${this.apiURL}/task/status/${this.filters.status}/category/${this.filters.category}`)
          .then( response => { this.tasks = response.data })

          return
      }

      if(this.filters.status) {
        this.$axios
          .get(`${this.apiURL}/task/status/${this.filters.status}`)
          .then( response => { this.tasks = response.data })

          return
      }

      if(this.filters.category) {
        this.$axios
          .get(`${this.apiURL}/task/category/${this.filters.category}`)
          .then( response => { this.tasks = response.data })

          return
      }
    }
  },
  mounted() {
    this.getTasks()
  }
};
</script>

<style lang="scss">
</style>
