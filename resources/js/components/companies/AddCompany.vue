<template>
  <div class="row pt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Add Company</h6>
          
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class ="p-4 justify-content-center">
                    <form  @submit.prevent="addCompany"  enctype="multipart/form-data">
                        <div class="row">
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="price">Name:</label>
                                    <input type="text" class="form-control" v-model="company.name">
                                      <div v-if="formErrors">
                                            <span class="text-danger" v-if="formErrors.name">{{ formErrors.name[0] }}</span>
                                    </div>
                                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
                                </div>
                                    <span class="text-danger"></span>
                            </div>
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="price">Email:</label>
                                    <input type="text" class="form-control"  placeholder  = "abc@gmail.com" v-model="company.email">
                                    <div v-if="formErrors">
                                            <span class="text-danger" v-if="formErrors.email">{{ formErrors.email[0] }}</span>
                                    </div>
                                    <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>

                                </div>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="image">Logo: (min: 100 x 100)</label>
                                    <input type="file" class="form-control"  @change="onImageChange"  >
                                            <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="price">Website (URL):</label>
                                    <input type="text" class="form-control"  placeholder  = "www.xyz.com" v-model="company.website">
                                   
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
                errors:'',
                company: {
                   logo:null
                },
                    validationErrors: ''
            }
        },
        computed: {
                formErrors(){
                 
                    console.log(this.validationErrors);
                    return this.validationErrors;
                }
                  
            },
        methods: {
                onImageChange(event){
                this.company.logo = event.target.files[0];
                console.log(this.company.logo);
            },

           async addCompany() {
                 
                    await axios.post('http://localhost:8000/api/companies', this.company,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN'),
                      'Content-Type': 'multipart/form-data'

                    }
                  })
                    .then(response => {
                        this.$router.push('/admin/companies')
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                    this.validationErrors = err.response.data.errors;
                    }
                    })
                    .finally(() => this.loading = false);
            }
        }
    }
</script>

<style>

</style>