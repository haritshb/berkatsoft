<template>
    <div v-if="message"
        class="alert"
        :class="successful ? 'alert-success' : 'alert-danger'">
        {{ message }}
    </div>
    <div>
        <h2 style="float: left">Sales Order List</h2>
        <router-link to="/create_sales" class="btn btn-primary" style="float: right">
            + Add Sales Order
        </router-link>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Customer</th>                
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="sale in sale_orders" :key="sale.id">
                <td>{{ sale.id }}</td>
                <td>{{ sale.product.title }}</td>
                <td>{{ sale.customer.name }}</td>                
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit_sales', params: { id: sale.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteSale(sale.id)">Delete</button>
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
                sale_orders: [],
                message: "",
            }
        },
        created() {
            UserService.getAllSales().then(
                (response) => {
                    console.log(response.data.data.sales_order);
                    this.sale_orders = response.data.data.sales_order;
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
            
            deleteSale(id) { 
                axios
                    .delete(`http://localhost:8000/api/sales_orders/${id}`, { headers: authHeader() })
                    .then(response => {
                        let i = this.sale_orders.map(data => data.id).indexOf(id);
                        this.sale_orders.splice(i, 1);
                        this.successful = true;
                        this.message = response.data.message;
                    });
            }
            
        }
    }
</script>