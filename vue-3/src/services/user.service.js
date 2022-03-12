import axios from 'axios';
import authHeader from './auth-header';
const API_URL = 'http://localhost:8000/api/';
class UserService {
  
  getAllProduct(){
    return axios.get(API_URL + 'products', { headers: authHeader() });
  }
  getAllCustomer(){
    return axios.get(API_URL + 'customers', { headers: authHeader() });
  }
  getAllSales(){
    return axios.get(API_URL + 'sales_orders', { headers: authHeader() });
  }
}
export default new UserService();