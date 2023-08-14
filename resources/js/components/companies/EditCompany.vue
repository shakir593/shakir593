<template>
  <div class="row pt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Add Company</h6>
          
            </div>
            <div class="card-body px-0 pt-0 pb-2 ">
                <div class ="p-4 justify-content-center">
                       <form  @submit.prevent="updateEmployee"  enctype="multipart/form-data">
                        <div class="row">
                            <div class = "col-md-6">
                                <div class="form-group">
                                    <label for="price">Name:</label>
                                    <input type="text" class="form-control" v-model="company.name">
                                     <div v-if="formErrors">
                                            <span class="text-danger" v-if="formErrors.name">{{ formErrors.name[0] }}</span>
                                    </div>
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
                                          <div v-if="formErrors">
                                            <span class="text-danger" v-if="formErrors.logo">{{ formErrors.logo[0] }}</span>
                                    </div>
                                            <img :src="`http://127.0.0.1:8000/storage/companies/${(company.logo != '') ? company.logo : 'avatar.png'}`" class="img-thumbnail me-3 mt-2" value = "$company->logo" alt="user1" width="304" height="236">

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
                company: {
                    name:'',
                    email:'',
                    logo: null,
                    website: ''
                },
                 selectedFile:false,
                validationErrors: '',
                newImage:null

            }
             
        },
         computed: {
                formErrors(){
                 
                    console.log(this.validationErrors);
                    return this.validationErrors;
                },
                  
            },
        created() {
            axios.get(`http://localhost:8000/api/companies/${this.$route.params.id}`,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                .then((res) => {
                    this.company = res.data;
                }).catch((err) =>{
                        console.log(err)
                    });

        },
        methods: {
              onImageChange(event){
                this.company.logo = event.target.files[0];
                this.selectedFile = true;
                // this.company.newImage = this.newImage;
                //  console.log(this.company);

            },
            checkUploadImage()
            {
                if(this.selectedFile ===false)
                this.company.logo = null
            },

            async updateEmployee() {
                      this.checkUploadImage();
                      let config = { headers: {
                         'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN'),
                          'Content-Type': 'multipart/form-data',

                          }
                          }
                await axios.post(`http://localhost:8000/api/companies/${this.$route.params.id}?_method=PUT`,this.company,config)
                    .then((res) => {
                        this.$router.push('/admin/companies');
                    }).catch(err =>{
                         if (err.response.status == 422){
                            this.validationErrors = err.response.data.errors;
                            }
                        console.log(err)
                    });
            }
        }
    }
</script>

<style>

</style>