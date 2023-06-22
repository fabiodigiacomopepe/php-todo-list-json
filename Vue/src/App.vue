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
      newTask: {
        name: "",
        done: false
      }
    }
  },
  methods: {
    invia() {
      const url = "http://localhost/22-06%20-%20PHP%20ToDo%20List%20JSON/php-todo-list-json/PHP/postTask.php";
      const data = this.newTask;

      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios
        .post(url, data, headers)
        .then(
          risultato => {
            this.tasks = risultato.data;
            this.newTask.name = "";
          }
        )
    },
    cambiaStato(task) {
      if (task.done == 'true') {
        task.done = 'false';
      } else {
        task.done = 'true';
      }
    },
    rimuoviItem(indice) {
      this.tasks.splice(indice, 1);
    },
  },
  mounted() {
    axios
      .get("http://localhost/22-06%20-%20PHP%20ToDo%20List%20JSON/php-todo-list-json/PHP/index.php")
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
    <input type="text" name="newTask" id="newTask" v-model="newTask.name">
    <input type="submit" value="INVIA">
  </form>

  <ul>
    <li v-for="(task, index) in tasks" :key="index" :class="((task.done === 'true') ? 'barrato' : '')"
      @click.stop="cambiaStato(task)">
      {{ task.name }}
      <i @click.stop="rimuoviItem(index)" class="fa-solid fa-xmark"></i>
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

.barrato {
  text-decoration: line-through;
}

li {
  cursor: pointer;
  margin-bottom: 10px;
}

i {
  margin-left: 30px;
  background-color: red;
  color: white;
  padding: 2px 5px;
}
</style>
