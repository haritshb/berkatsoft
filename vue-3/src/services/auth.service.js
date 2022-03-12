import axios from 'axios';
const API_URL = 'http://localhost:8000/api/';
class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'login', {
        email: user.email,
        password: user.password
      })
      .then(response => {
        if (response.data.data.token) {
          localStorage.setItem('user', JSON.stringify(response.data.data));
        }
        //console.log(response.data.data)
        return response.data.data;
      });
  }
  logout() {
    localStorage.removeItem('user');
  }
  register(user) {
    return axios.post(API_URL + 'register', {
      name: user.name,
      email: user.email,
      password: user.password,
      confirm_password: user.confirm_password
    });
  }
}
export default new AuthService();