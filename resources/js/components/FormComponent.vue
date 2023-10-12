<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Student</div>

                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" v-model="name" class="form-control" id="name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" v-model="email" class="form-control" id="email">
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" v-model="phone" class="form-control" id="phone">
                            </div>
                            <button type="submit" @click.prevent="saveStudent" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">All Student</div>

                    <div class="card-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student,index) in students.data" :key="student.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ student.name }}</td>
                                    <td>{{ student.email }}</td>
                                    <td>{{ student.phone }}</td>
                                    <td>
                                        <button type="button" @click="editStudent(student.id)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Edit
                                        </button>
                                        <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">
                                            delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :data="students" @pagination-change-page="loadStudents" />
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="editname" class="form-label">Name</label>
                                <input type="text" v-model="editname" class="form-control" id="editname">
                            </div>

                            <div class="mb-3">
                                <label for="editemail" class="form-label">Email address</label>
                                <input type="email" v-model="editemail" class="form-control" id="editemail">
                            </div>
                            
                            <div class="mb-3">
                                <label for="editphone" class="form-label">Phone</label>
                                <input type="number" v-model="editphone" class="form-control" id="editphone">
                            </div>
                            <button type="submit" @click.prevent="updateStudent" class="btn btn-success" data-bs-dismiss="modal">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return{
                students : {},
                id: '',
                name: '',
                email: '',
                phone: '',
                editname : '',
                editemail : '',
                editphone : ''
            }
        },
        mounted() {
            this.loadStudents();
        },
        methods : {
            saveStudent(){
                axios.post('save_student',{
                    name : this.name,
                    email : this.email,
                    phone : this.phone
                })
                .then(response => {
                    this.name = '';
                    this.email = '';
                    this.phone = '';
                    this.loadStudents();
                });
            },
            loadStudents(page = 1) {
                axios.get('all_students?page=' + page)
                    .then(response => {
                        // console.log(response.data);
                        this.students = response.data;
                    });
            },
            editStudent(id){
                axios.get('edit_student/' + id)
                .then(response => {
                        this.id = response.data.id;
                        this.editname = response.data.name;
                        this.editemail = response.data.email;
                        this.editphone = response.data.phone;
                    });
            },
            updateStudent(){
                axios.put('update_student',{
                    id : this.id,
                    name : this.editname,
                    email : this.editemail,
                    phone : this.editphone
                })
                .then(response => {
                    this.loadStudents();
                });
            },
            deleteStudent(id){
                axios.delete('delete_student/' + id)
                    .then(response => {
                        this.loadStudents();
                    });
            }
        }
    }
</script>
