<template>
    <div>
        <h3 class="text-center">Edit Customer</h3>
        <div class="row">
            <div class="col-md-6">
                <Form @submit="updateCustomer" :validation-schema="schema">
                    <div class="form-group">
                        <label>Name</label>
                        <Field type="text" class="form-control" name="name" v-model="customer.name" />
                        <ErrorMessage name="name" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <Field type="text" class="form-control" name="address" v-model="customer.address" />
                        <ErrorMessage name="address" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <Field type="text" class="form-control" name="phone" v-model="customer.phone" />
                        <ErrorMessage name="phone" class="error-feedback" />
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <div class="form-group">
                        <div v-if="message"
                            class="alert"
                            :class="successful ? 'alert-success' : 'alert-danger'">
                            {{ message }}
                        </div>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>
 
<script>
    import { Form, Field, ErrorMessage } from "vee-validate";
    import * as yup from "yup";
    import axios from 'axios';
    import authHeader from '../services/auth-header';
    export default {        
        components: {
            Form,
            Field,
            ErrorMessage,            
        },
        data() {
            const schema = yup.object().shape({
                name: yup.string().required("name is required!"),
                address: yup.string().required("Address is required!"),
                phone: yup.string().required("Phone is required!"),
            });
            return {
                customer:{},
                loading: false,
                message: "",
                schema,
            };
        },
        created() {
            axios
                .get(`http://localhost:8000/api/customers/${this.$route.params.id}`, { headers: authHeader() })
                .then((res) => {
                    console.log(res.data)
                    this.customer = res.data.data;
                });
        },
        methods: {            
            
            updateCustomer(customer) {
                axios
                    .patch(`http://localhost:8000/api/customers/${this.$route.params.id}`, customer, { headers: authHeader() })
                    .then((response) => {
                        console.log(response.data)
                        //this.$router.push({ name: 'home' });
                        this.successful = true;
                        this.message = response.data.message;
                        return response.data
                    });
                
            }            
        }
        
    }
</script>

<style scoped>
.error-feedback {
  color: red;
}
</style>