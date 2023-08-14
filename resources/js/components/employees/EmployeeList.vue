<template>
<div class="row pt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Companies</h6>
              <div class="d-flex justify-content-end">
                  <router-link  to="/admin/employee/create" class="btn btn-primary">	
                    <span class="btn-inner--text">Add Employee</span>
                  </router-link>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Company</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10 ps-2">Phone</th>
                      <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th> -->
                      <th class="text-secondary opacity-7">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in employees.data" :key="employee.id">
                     
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{employee.id}}</p>
                      </td>
                       <td>
                        <p class="text-xs font-weight-bold mb-0">{{employee.first_name}} {{employee.last_name}}</p>
                      </td>
                       <td>
                        <p class="text-xs font-weight-bold mb-0">{{employee.email}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0" >{{employee.company ? employee.company.name : ''}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{employee.phone}}</p>
                      </td>
                      <!-- <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td> -->
                  
                      <td class="align-middle">
                        <router-link :to="`/admin/employee/edit/${employee.id}`" class="btn btn-primary" >
                          <i class="fa fa-pen"></i>                        
                        </router-link>
                        <button class="btn btn-success"  @click="deleteEmployee(employee.id)">
                          <i class="fa fa-trash"></i>                        
                        </button>
                      </td>
                    </tr>
              
                  </tbody>
                </table>
              </div>
                <div class="d-flex justify-content-center">
                    <pagination   class="mb-0"
                          :data="employees"
                          @pagination-change-page="getPageData"></pagination>
                    
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
                employees: {},
            }
        },

      mounted()
      {
        this.getPageData(1)
      },
        methods: {

        /* Getting Current Page Data */
          async getPageData(page=1) {
            await axios.get(`http://localhost:8000/api/employees?page=${page}`,{
                    headers: {
                      'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                    }
                  })
                .then(response => {
                    this.employees = {
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
                }).catch((err) =>{
                        console.log(err)
                    });
        },

        /* Delete Employee */
        async deleteEmployee(id) { 
            await axios.delete(`http://localhost:8000/api/employees/${id}`,{
                headers: {
                  'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                }
              })
                .then(response => {
                    let i = this.employees.data.map(data => data.id).indexOf(id);
                    this.employees.data.splice(i, 1)
                }).catch((err) =>{
                    console.log(err)
                });
        }
        }
    }
</script>

<style>

</style>