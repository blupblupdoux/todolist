<template>
  <v-main class="mx-auto">

    <div class="tasks">
      <TaskItem />
      <TaskItem />
      <TaskItem />
    </div>

    <TaskForm />
    
  </v-main>
</template>

<script>

import TaskItem from '../components/TaskItem.vue'
import TaskForm from '../components/TaskForm.vue'

export default {
  name: 'Home',
  components: {
    TaskItem,
    TaskForm,
  }
};
</script>

<style lang="scss">
</style>
