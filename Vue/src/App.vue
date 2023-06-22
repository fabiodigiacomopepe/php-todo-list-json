<script>
import { store } from './store.js'
import axios from 'axios'
import AppHelloWorld from './components/AppHelloWorld.vue'


export default {
  components: {
    AppHelloWorld,
  },
  data() {
    return {
      store,
      tasks: [],
      nuovaTask: {
        name: "",
        done: false
      }
    }
  },
  methods: {
    invia() {

      const url = "http://localhost/22-06%20-%20PHP%20ToDo%20List%20JSON/php-todo-list-json/PHP/";
      const data = this.nuovaTask;

      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios
        .post(url, data, headers)
        .then(
          risultato => {
            console.log(risultato.data);
          }
        )
    }
  },
  mounted() {
    axios
      .get("http://localhost/22-06%20-%20PHP%20ToDo%20List%20JSON/php-todo-list-json/PHP/")
      .then(
        risultato => {
          this.tasks = risultato.data;
        }
      )
  }
}
</script>

<template>
  <form @submit.prevent=invia()>
    <label for="task">Inserisci task </label>
    <input type="text" name="newTask" id="newTask" v-model="nuovaTask.name">
    <input type="submit" value="INVIA">
  </form>

  <ul>
    <li v-for="(task, index) in tasks" :key="index">
      {{ task.name }}
    </li>
  </ul>
</template>

<style lang="scss">
@use './styles/general.scss' as *;
@use './styles/partials/variables.scss' as *;
@use './styles/partials/mixins.scss' as *;

body {
  padding: 30px;
}

ul {
  margin: 30px 0 0 15px;
}
</style>
