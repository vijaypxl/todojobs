<template>
    <div>
        <input type="text" @keyup.enter="addTodo"placeholder="Add new" v-model="title" v-on:input="error = ''" />
        <span v-if="error">{{ error }}</span>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        title: '',
        error: ''
      }
    },
    methods: {
      addTodo(){
        if(!this.title){
          this.error = "Please enter title"
        }
        else {
          axios.post('api/todos', {
            title: this.title
          })
            .then(() => {
              this.$emit('todo-created', this.title)
              this.title = ''
            })
            .catch(({response}) => {
              this.error = response.data.errors.title[0]
            });
        }
      }
    }
  }
</script>