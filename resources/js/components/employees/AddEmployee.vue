<template>
  <div class="row pt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Add Company</h6>
          
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class ="p-4 justify-content-center">
                    <form @submit.prevent="addEmployee" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" v-model="employee.first_name">
                                           <div v-if="validationErrors">
                                            <span class="text-danger" v-if="validationErrors.first_name">{{ validationErrors.first_name[0] }}</span>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" v-model="employee.last_name">
                                           <div v-if="validationErrors">
                                            <span class="text-danger" v-if="validationErrors.last_name">{{ validationErrors.last_name[0] }}</span>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="exampleFormControlSelect1">Company</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="employee.company">
                                        <option  :value="company.id" v-for="(company,index) in companies" :key="index" :selected="companies.selectedItem">{{company.name}}</option>

                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" v-model="employee.email">
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" v-model="employee.phone">
                                    </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                employee: {
                    first_name:'',
                    last_name:'',
                    email:'',
                    phone:0,
                    company:1
                },
                validationErrors: '',
                companies:{},
            }
        },
         async created() {
            await axios.get('http://localhost:8000/api/get-companies',{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                .then(response => {
                    this.companies = response.data;
                }).catch((err) =>{
                        console.log(err)
                    });
        },
        methods: {
           async addEmployee() {
                 
                    await axios.post('http://localhost:8000/api/employees', this.employee,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                    .then(response => {
                        this.$router.push('/admin/employees')
                    })
                    .catch(err => {
                      if (err.response.status == 422)
                          this.validationErrors = err.response.data.errors;
                    })
                    .finally(() => this.loading = false);
            }
        }
    }
</script>

<style>

</style>