<template>
   <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{totalUsers}}
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Companies</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{totalCompanies}}
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Employees</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{totalEmployees}}
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  data()
  {
    return {
      totalCompanies:'',
      totalEmployees:'',
      totalUsers:''
    }
  },
  async created()
  {
          await axios.get('http://localhost:8000/api/dashboard-data',{
                headers: {
                  'Authorization': `Bearer ` + localStorage.getItem('APP_DEMO_USER_TOKEN')
                }
              })
            .then(response => {
                this.totalCompanies = response.data.totalCompanies;
                this.totalEmployees = response.data.totalEmployees;
                this.totalUsers = response.data.totalUsers;
            }).catch((err) =>{
                    console.log(err)
                });
  }
}
</script>

<style>

</style>