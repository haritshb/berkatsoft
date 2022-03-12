<template>
    <div v-if="message"
                            class="alert"
                            :class="successful ? 'alert-success' : 'alert-danger'">
                            {{ message }}
                        </div>
    <div>
        <h2 style="float: left">Products List</h2>
        <router-link to="/create_product" class="btn btn-primary" style="float: right">
            + Add Product
        </router-link>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit_product', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
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
                products: [],
                message: "",
            }
        },
        created() {
            UserService.getAllProduct().then(
                (response) => {
                    console.log(response.data.data);
                    this.products = response.data.data;
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
            
            deleteProduct(id) { 
                axios
                    .delete(`http://localhost:8000/api/products/${id}`, { headers: authHeader() })
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(id);
                        this.products.splice(i, 1);
                        this.successful = true;
                        this.message = response.data.message;
                    });
            }
            
        }
    }
</script>