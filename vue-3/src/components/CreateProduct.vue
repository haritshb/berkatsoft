<template>
    <div>
        <h3 class="text-center">Create Product</h3>
        <div class="row">
            <div class="col-md-6">
                <Form @submit="addProduct" :validation-schema="schema">
                    <div class="form-group">
                        <label>Title</label>
                        <Field type="text" class="form-control" name="title" />
                        <ErrorMessage name="title" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <Field type="text" class="form-control" name="description" />
                        <ErrorMessage name="description" class="error-feedback" />
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <Field type="text" class="form-control" name="price" />
                        <ErrorMessage name="price" class="error-feedback" />
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
                title: yup.string().required("Title is required!"),
                description: yup.string().required("Description is required!"),
                price: yup.string().required("Price is required!"),
            });
            return {
                product:{},
                loading: false,
                message: "",
                schema,
            };
        },
        methods: {            
            addProduct(product) {
                axios
                    .post('http://localhost:8000/api/products', product, { headers: authHeader() })
                    .then(response => (
                        console.log(response.data),
                        this.$router.push({ name: 'products' })
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