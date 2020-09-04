<template>
<div id="app">
    <Navigation />
  <router-view />
</div>
</template>
<script>
import Navigation from '@/components/navigation'
export default {
  components: {
    Navigation
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;1,600&display=swap');
*{
  background: #ffffff;
  font-family: 'Poppins', sans-serif;
}
</style>
