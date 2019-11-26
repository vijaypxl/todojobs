<template>
    <div>
        <create-todo v-on:todo-created="pushIntoList($event)" />
        <p v-if="isError">Something went wrong while fetching todo</p>
        <ul v-else class="list-group">
            <li class="list-group-item" v-for="todo in todosList" v-text="todo"></li>
        </ul>
    </div>
</template>

<script>
  import CreateTodo from "./CreateTodoComponent";
  export default {
    components: {
      CreateTodo
    },
    data(){
      return {
        todosList: [],
        isError: false
      }
    },
    methods: {
      pushIntoList(task){
        this.todosList.unshift(task)
      }
    },
    created() {
      axios.get('api/todos')
        .then(({data}) => {
          this.todosList = data.todos
        })
        .catch(({response}) => {
          this.isError = true
        });
    }
  }
</script>