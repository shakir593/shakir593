<template>
     <Sidebar />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
          <Navbar @close-login="closeLogin"/>
            <div class="container-fluid py-4">
              <router-view></router-view>
            </div>
        <Footer />
      </main>
</template>

<script>
import Footer from '../components/layouts/Footer.vue';
import Sidebar from '../components/layouts/Sidebar.vue';
import Navbar from '../components/layouts/Navbar.vue';
export default {
  components : {Footer, Sidebar, Navbar },
 
}
</script>

<style>

</style>