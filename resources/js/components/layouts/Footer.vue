<template>
  <footer class="footer align-items-center text-center pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                {{newDate}}
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
</template>

<script>
export default {
    data(){
        return {
            newData : '',
            }
    },
methods:{
  getNewDate()
  {
    this.newDate = new Date().getFullYear();
    console.log(this.newDate);
  }
}
}
</script>

<style>

</style>