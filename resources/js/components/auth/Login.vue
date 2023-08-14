<template>
    <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="d-flex flex-column mx-auto align-items-center">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                    <ul v-if="typeof errors === 'object'" class="list-disc text-red-400"  >
                        <li v-for="(value, index) in errors" :key="index">{{value[0]}}</li>
                    </ul>
                        <div class="alert alert-danger" v-if="errors && typeof errors === 'string'" role="alert">{{errors}}</div>


                    <form @submit.prevent = "handleLogin" method="POST">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" id="email_address" v-model="form.email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon"  required autofocus>
                 
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" id="password" v-model="form.password"   class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                     
                    </div>
                  
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember"  >
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                      
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                  <!-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                      Don't have an account?
                      <router-link  to="/register" class="text-info text-gradient font-weight-bold">Sign up</router-link>
                    </p>
                  </div> -->
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{asset('admin/assets/img/curved-images/curved6.jpg')}}')"></div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
export default {
 data()
 {
    return {
        errors:'',
        form:{
            email:'',
            password:''
        },
    }
 },

 methods:{
    async handleLogin()
    {
          await axios.post('http://localhost:8000/api/auth/login', this.form)
                    .then(response => {
                        if (response.status === 200 && response.data && response.data.token) {
                            localStorage.removeItem('APP_DEMO_USER_TOKEN')
                            localStorage.setItem('APP_DEMO_USER_TOKEN', response.data.token)
                             this.$emit('open-login')
                             this.$router.push('/admin/dashboard')
                        }
                               console.log(localStorage.getItem('APP_DEMO_USER_TOKEN'))
                    })
                    .catch(err => {
                        if(err && err.response.data && err.response.data.errors) {
                            this.errors = Object.values(err.response.data.errors)
                        } else {
                            this.errors = err.response.data.message || ""
                        }
                    })
                    .finally(() => this.loading = false);
    }
 }
}
</script>

<style>

</style>