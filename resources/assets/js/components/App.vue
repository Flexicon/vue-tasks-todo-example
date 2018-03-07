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
            <ul class="list-group">
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
                const self = this;
                self.$http.get('/api/tasks').then(function (res) {
                    self.tasks = res.body;
                });
            },

            createTask: function () {
                const self = this;
                self.$http.post('/api/task/store', self.task).then(function (res) {
                    self.task.body = '';
                    self.edit = false;
                    self.fetchTasksList();
                });
            },

            updateTask: function (id) {
                const self = this;
                self.$http.patch('/api/task/' + id, self.task).then(function (res) {
                    self.task.body = '';
                    self.task.id = '';
                    self.edit = false;
                    self.fetchTasksList()
                });
            },

            showTask: function (id) {
                const self = this;
                self.$http.get('/api/task/' + id).then(function (res) {
                    self.task.id = res.data.id
                    self.task.body = res.data.body
                    self.$refs.taskinput.focus();
                    self.edit = true;
                });
            },

            deleteTask: function (id) {
                const self = this;
                self.$http.delete('/api/task/' + id).then(function (res) {
                    self.fetchTasksList();
                });
            },
        }
    }
</script>