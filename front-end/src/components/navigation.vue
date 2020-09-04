<template>
<div class="menu-nav">
    <li><router-link class="card" :to="{name:'Ficha'}">Fichas</router-link></li>
    <li><router-link class="card" :to="{name:'Navio'}">Navios</router-link></li>
    <li><router-link class="card" :to="{name:'Usina'}">Usina</router-link></li>
    <li><router-link class="card" :to="{name:'Cliente'}">Clientes</router-link></li>
    <li><router-link class="card" :to="{name:'PortoDestino'}">Portos de Destino</router-link></li>
    <li><router-link class="card" :to="{name:'PortoEmbarque'}">Portos de Embarque</router-link></li>
</div>
</template>

<script>
export default {}
</script>
<style>
    .menu-nav {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translate(-50%, -50%);
    }
    .menu-nav li {
        list-style: none;
        margin-top: 60px;
        font-size: 20px;
    }
    .card {
         text-decoration: none;
         color: #dcdde1;
         transition: 0.5s;
         width: 100px;
         height: 100px;
         border-radius: 3px;
         color: black;
    }
</style>
