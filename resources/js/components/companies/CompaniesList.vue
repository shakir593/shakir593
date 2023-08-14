<template>


<div class="row pt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Companies</h6>
              <div class="d-flex justify-content-end">
                  <router-link  to="/admin/company/create" class="btn btn-primary">	
                    <span class="btn-inner--text">Add Company</span>
                  </router-link>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Website</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Phone</th>
                      <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> -->
                      <!-- <th class="text-secondary opacity-7">Actions</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="company in companies.data" :key="company.id">
                        <td>
                        <p class="text-xs font-weight-bold mb-0">{{company.id}}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img :src="`http://127.0.0.1:8000/storage/companies/${(company.logo != '') ? company.logo : 'avatar.png'}`" class="avatar avatar-xl me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{company.name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{company.email}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{company.website}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{company.phone}}</p>
                      </td>
                      <!-- <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td> -->
                  
                      <td class="align-middle">
                        <router-link :to="`/admin/company/edit/${company.id}`" class="btn btn-primary" >
                          <i class="fa fa-pen"></i>                        
                        </router-link>
                        <button class="btn btn-success"  @click="deleteCompany(company.id)">
                          <i class="fa fa-trash"></i>                        
                        </button>
                      </td>
                    </tr>
              
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-center">
                  <pagination   class="mb-0"
                        :data="companies"
                        @pagination-change-page="list"></pagination>
                  
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
            companies: {},
        }
        },
      
     mounted()
     {
      this.list(1)
     },
        methods: {
              async list(page=1) {
            await axios.get(`http://localhost:8000/api/companies?page=${page}`,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                .then(response => {
                    // this.companies = response.data.data;
                    
            this.companies = {
                current_page: page,
                data: response.data.data,
                from: page,
                last_page: response.data.last_page,
                next_page_url: response.data.next_page_url,
                per_page: response.data.per_page,
                prev_page_url: response.data.prev_page_url,
                to: response.data.to,
                total: response.data.total
            };
            //   this.companies = {
            //     data: response.data.data,
            //     links: {
            //         first: response.data.first_page_url,
            //         last: response.data.last_page_url,
            //         prev: response.data.prev_page_url,
            //         next: response.data.next_page_url
            //     },
            //     meta: {
            //         current_page: response.data.current_page,
            //         from: page,
            //         last_page: response.data.last_page,
            //         path: response.data.path,
            //         per_page: response.data.per_page,
            //         to: response.data.to,
            //         total: response.data.total
            //     }
            // };
                      // this.paginationData = {
                      //     current_page: response.data.current_page,
                      //     last_page: response.data.last_page,
                      //   };
                }).catch((err) =>{
                        console.log(err)
                    });
        },
            async deleteCompany(id) { 
                await axios.delete(`http://localhost:8000/api/companies/${id}`,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                    .then(response => {
                        let i = this.companies.data.map(data => data.id).indexOf(id);
                        this.companies.data.splice(i, 1)
                    }).catch((err) =>{
                        console.log(err)
                    });
            }
        }
    }
</script>

<style>

</style>