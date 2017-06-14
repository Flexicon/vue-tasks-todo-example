<template>
    <div class="tasks-wrap">
        <div class="well well-sm">
            <div class="h3" v-show="!edit">New Task</div>
            <div class="h3" v-show="edit">Edit Task</div>

            <form action="#" @submit.prevent="edit ? updateTask(task.id) : createTask()">
                <div class="input-group">
                    <input v-model="task.body" ref="taskinput" type="text" name="body" class="form-control" autofocus>

                    <span class="input-group-btn">
                        <button v-show="!edit" type="submit" class="btn btn-primary">New Task</button>
                        <button v-show="edit" type="submit" class="btn btn-primary">Edit Task</button>
                    </span>
                </div>
            </form>
        </div>

        <div class="well well-sm">
            <div class="h3">Tasks List</div>
            <ul>
                <li class="list-group-item" v-for="task in tasks" :key="task.id">
                    {{ task.body }}
                    <button @click="showTask(task.id)" class="btn btn-primary btn-xs">Edit</button>
                    <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                tasks: [],
                task: {
                    id: '',
                    body: ''
                },
                edit: false,
            }
        },
        mounted: function () {
            this.fetchTasksList();
        },
        methods: {
            fetchTasksList: function () {
                this.$http.get('/api/tasks').then(function (res) {
                    this.tasks = res.body;
                });
            },

            createTask: function () {
                this.$http.post('/api/task/store', this.task)
                this.task.body = ''
                this.edit = false
                this.fetchTasksList()
            },

            updateTask: function (id) {
                this.$http.patch('/api/task/' + id, this.task)
                this.task.body = ''
                this.task.id = ''
                this.edit = false
                this.fetchTasksList()
            },

            showTask: function (id) {
                this.$http.get('/api/task/' + id).then(function (response) {
                    this.task.id = response.data.id
                    this.task.body = response.data.body
                })
                this.$refs.taskinput.focus()
                this.edit = true
            },

            deleteTask: function (id) {
                this.$http.delete('/api/task/' + id)
                this.fetchTasksList()
            },
        }
    }
</script>