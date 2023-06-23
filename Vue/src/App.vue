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
      const url = "http://localhost/22-06%20-%20PHP%20ToDo%20List%20JSON/php-todo-list-json/PHP/deleteTask.php";
      const data = { "indice": indice };
      const headers = {
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      axios
        .post(url, data, headers)
        .then(
          risultato => {
            const data = risultato.data;
            this.tasks = data;
          }
        )
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
  <div class="container">
    <h1>Todo List</h1>
    <div class="list">
      <ul>
        <li v-for="(task, index) in tasks" :key="index" @click.stop="cambiaStato(task)">
          <span :class="((task.done === 'true') ? 'barrato' : '')">
            {{ task.name }}
          </span>
          <i @click.stop=" rimuoviItem(index)" class="fa-solid fa-xmark"></i>
        </li>
      </ul>
    </div>

    <form @submit.prevent=invia()>
      <input type="text" name="newTask" id="newTask" v-model="newTask.name" placeholder="Inserisci elemento...">
      <input type="submit" id="submit" value="Inserisci">
    </form>
  </div>
</template>

<style lang="scss">
@use './styles/general.scss' as *;
@use './styles/partials/variables.scss' as *;
@use './styles/partials/mixins.scss' as *;

.container {
  width: 50%;
  margin: 0 auto;
  margin-top: 40px;
  text-align: center;

  h1 {
    font-size: 80px;
    text-align: center;
    color: #6b747c;
  }

  .list {
    background-color: #ffffff;
    color: black;
    border-radius: 5px;

    li {
      cursor: pointer;
      border: 1px solid gray;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 5px 20px;
      font-size: 25px;

      .barrato {
        text-decoration: line-through;
      }

      i {
        margin-left: 30px;
        background-color: red;
        color: white;
        padding: 2px 5px;
        text-decoration: none;
      }
    }
  }

  form {
    width: 100%;
    margin-top: 20px;
    font-size: 35px;
    display: flex;
    align-items: center;

    #newTask {
      padding: 5px 15px;
      width: 100%;
    }

    #submit {
      padding: 5px 15px;
      background-color: #001632;
      color: #b78417;
      border: 2px solid #b78417;
      border-radius: 5px;
      font-weight: bold;
    }

  }
}
</style>
