<template>
  <div id="app">
    <nav class="navbar navbar-expand navbar-light bg-light">
      <a href="/" class="navbar-brand"><img src="Berkatsoft(font-hitam).png"></a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">               
        <li class="nav-item">
          <router-link v-if="currentUser" to="/products" class="nav-link">Products</router-link>
        </li>
        <li class="nav-item">
          <router-link v-if="currentUser" to="/customers" class="nav-link">Customer</router-link>
        </li>    
        <li class="nav-item">
          <router-link v-if="currentUser" to="/sales_order" class="nav-link">Sales Order</router-link>
        </li>  
        <li v-if="!currentUser" class="nav-item">
          <router-link to="/register" class="nav-link">
            <font-awesome-icon icon="user-plus" /> Sign Up
          </router-link>
        </li>
        <li v-if="!currentUser" class="nav-item">
          <router-link to="/login" class="nav-link">
            <font-awesome-icon icon="sign-in-alt" /> Login
          </router-link>
        </li>
      
        <li v-if="currentUser" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <font-awesome-icon icon="user" /> {{ currentUser.name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                       
            <a class="dropdown-item" @click.prevent="logOut"><font-awesome-icon icon="sign-out-alt" /> LogOut</a>
          </div>
        </li>
      </ul>
      </div>
      
      
        
      
    </nav>
    <div class="container">
      <router-view />
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    currentUser() {
      return this.$store.state.auth.user;
    },
    showAdminBoard() {
      if (this.currentUser && this.currentUser['roles']) {
        return this.currentUser['roles'].includes('ROLE_ADMIN');
      }
      return false;
    },
    showModeratorBoard() {
      if (this.currentUser && this.currentUser['roles']) {
        return this.currentUser['roles'].includes('ROLE_MODERATOR');
      }
      return false;
    }
  },
  methods: {
    logOut() {
      this.$store.dispatch('auth/logout');
      this.$router.push('/login');
    }
  }
};
</script>