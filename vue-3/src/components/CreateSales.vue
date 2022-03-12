<template>
    <div>
        <h3 class="text-center">Create Sales Order</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addSalesOrder">
                    <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="form-control" v-model="sales_order.product_id" required>                                                        
                            <option
                            v-for="(product, id) in listProduct"
                            :value="product.id"
                            :key="id"
                            >
                            {{ product.title }}
                            </option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>Costumer</label>
                        <select name="customer_id" class="form-control" v-model="sales_order.customer_id" required>
                            <option
                            v-for="(costumer, id) in listCustomer"
                            :value="costumer.id"
                            :key="id"
                            >
                            {{ costumer.name }}
                            </option>
                        </select>                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Create</button>
                    <div class="form-group">
                        <div v-if="message"
                            class="alert"
                            :class="successful ? 'alert-success' : 'alert-danger'">
                            {{ message }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    //import { Form } from "vee-validate";
    //import * as yup from "yup";
    import axios from 'axios';
    import authHeader from '../services/auth-header';
    export default {        
        /*components: {
            Form,       
        },*/
        data() {
           
            return {
                sales_order:{},
                loading: false,
                message: "",
                //schema,
                listProduct: [],
                listCustomer: []
            };
        },
        created() {
            axios
                .get(`http://localhost:8000/api/products`, { headers: authHeader() })
                .then((res) => {
                    //console.log(res.data)
                    this.listProduct = res.data.data;
                });

            axios
                .get(`http://localhost:8000/api/customers`, { headers: authHeader() })
                .then((res) => {
                    //console.log(res.data)
                    this.listCustomer = res.data.data;
                });
        },
        methods: {            
            addSalesOrder() {
                console.log(this.sales_order);
                axios
                    .post('http://localhost:8000/api/sales_orders', this.sales_order, { headers: authHeader() })
                    .then(response => (
                        console.log(response.data),
                        //this.$router.push({ name: 'sales_order' }),
                        this.successful = true,
                        this.message = response.data.message
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
                
            }            
        }
        
    }
</script>

<style scoped>
.error-feedback {
  color: red;
}
</style>