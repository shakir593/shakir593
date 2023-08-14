<template>
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <p class="btn-sm mb-0 me-3" target="_blank" >{{userData.name}}</p>
            </li>
            <li class="nav-item d-flex align-items-center">
              <button @click="logout" class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" >Log Out</button>
            </li>
     
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
</template>

<script>
export default {
  data(){
    return {
      userData:{},
    }
  },
   async created()
  {
          await axios.get('http://localhost:8000/api/user',{
                headers: {
                  'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                }
              })
            .then(response => {
                this.userData = response.data;
            }).catch((err) =>{
                    console.log(err)
                });
  },
  methods: {
     logout() {
      try {
        const response =  axios.post('/api/logout',null, {
         headers: {
          'Authorization': `Bearer ${localStorage.getItem('APP_DEMO_USER_TOKEN')}`
        }
      });
        console.log(response.message);
        localStorage.removeItem('APP_DEMO_USER_TOKEN')
        this.$router.push('/');
        // Perform any additional actions after successful logout
      } catch (error) {
        console.error('Error logging out:', error);
      }
    },
  },
}
</script>

<style>

</style>