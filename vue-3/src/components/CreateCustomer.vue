<template>
    <div>
        <h3 class="text-center">Create Customer</h3>
        <div class="row">
            <div class="col-md-6">
                <Form @submit="addCustomer" :validation-schema="schema">
                    <div class="form-group">
                        <label>Name</label>
                        <Field type="text" class="form-control" name="name" />
                        <ErrorMessage name="name" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <Field type="text" class="form-control" name="address" />
                        <ErrorMessage name="address" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <Field type="text" class="form-control" name="phone" />
                        <ErrorMessage name="phone" class="error-feedback" />
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
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
                name: yup.string().required("Name is required!"),
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
        methods: {            
            addCustomer(customer) {
                axios
                    .post('http://localhost:8000/api/customers', customer, { headers: authHeader() })
                    .then(response => (
                        console.log(response.data),
                        //this.$router.push({ name: 'customers' }),
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