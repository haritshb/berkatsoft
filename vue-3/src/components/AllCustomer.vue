<template>
    <div v-if="message"
        class="alert"
        :class="successful ? 'alert-success' : 'alert-danger'">
        {{ message }}
    </div>
    <div>
        <h2 style="float: left">Customer List</h2>
        <router-link to="/create_customer" class="btn btn-primary" style="float: right">
            + Add Customer
        </router-link>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <td>{{ customer.id }}</td>
                <td>{{ customer.name }}</td>
                <td>{{ customer.address }}</td>
                <td>{{ customer.phone }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit_customer', params: { id: customer.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteCustomer(customer.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    import UserService from "../services/user.service";
    import axios from 'axios';
    import authHeader from '../services/auth-header';
    export default {
        data() {
            return {
                customers: [],
                message: "",
            }
        },
        created() {
            UserService.getAllCustomer().then(
                (response) => {
                    console.log(response.data.data);
                    this.customers = response.data.data;
                },
                (error) => {
                    this.content =
                    (error.response &&
                        error.response.data &&
                        error.response.data.message) ||
                    error.message ||
                    error.toString();
                }
            );
        },
        methods: {
            
            deleteCustomer(id) { 
                axios
                    .delete(`http://localhost:8000/api/customers/${id}`, { headers: authHeader() })
                    .then(response => {
                        let i = this.customers.map(data => data.id).indexOf(id);
                        this.customers.splice(i, 1);
                        this.successful = true;
                        this.message = response.data.message;
                    });
            }
            
        }
    }
</script>