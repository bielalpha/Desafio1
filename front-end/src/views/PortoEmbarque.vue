<template>
<!-- Essa div visualisation emgloba todo o escopo princiol de projeto -->
  <div class="visualization">
    <h1>Porto de Embarque</h1>
    <div class="fields">
      <ul>
        <li>Nome</li>
        <li>Pais</li>
      </ul>
      <li class="desc-actions">Ações</li>
    </div>
    <!--Aqui temos a barra de pesquisar e ao mesmo tempo funciona como exibição de dados-->
    <div class="search-box">
      <input v-model="search" class="search-txt" type="text" placeholder="Pesquisar" />
      <a class="button" href="#">
        <img src="@/assets/search-24px.svg"/>
      </a>
    </div>
      <div class="porto" v-for="porto in portos" :key="porto.id">
        <div id="data">
          <ul>
            <form @submit.prevent="create_porto()">
            <li class="nome">{{porto.nome}}</li>
            <li class="pais">{{porto.pais}}</li>
             </form>
             </ul>
             <ul>
               <li>
                 <button v-on:click="show_porto(porto)"  @click="blur()">Editar</button>
               </li>
             </ul>
            <button class="delete" @click="delete_porto(porto.id)">Excluir</button>
        </div>
      </div>
<!-- ADICIONAR PORTO -->
<div id="popup">
     <div class="porto-register">
    <div class="info">
      <h1 class="tittle">Casdastro</h1>
      <hr class="line-register"/>
    </div>
    <form @submit.prevent="create_porto()">
      <div class="data-porto">
        <input
          type="text"
          name="nome"
          id="nome"
          v-model="nome"
          placeholder="Nome do Porto"
        />
        <input
          type="text"
          name="pais"
          id="pais"
          v-model="pais"
          placeholder="Pais de Embarque"
        />
        <div>
          <button type="submit" v-on:click="blur()">Salvar</button>
        </div>
      </div>
    </form>
  </div>
<!--EDITAR PORTO-->
<div id="popup">
     <div class="porto-register">
    <div class="info">
      <h1 class="tittle">Editar</h1>
      <hr class="line-register"/>
    </div>
    <form @submit.prevent="edit_porto()">
      <div class="data-porto">
        <input
          type="text"
          name="nome"
          id="nome"
          v-model="portoToUpdate.nome"
          placeholder="Nome do Porto"
        />
        <input
          type="text"
          name="pais"
          id="pais"
          v-model="portoToUpdate.pais"
          placeholder="Pais de Embarque"
        />
        <div>
          <button type="submit" v-on:click="blur()">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<div class="box-add">
        <button type="submit" v-on:click="blur()">Criar Novo Porto de Embarque</button>
    </div>
</div>
</template>

<script>
export default {
  data: () => ({
    id: '',
    nome: '',
    pais: '',
    portoToUpdate: '',
    search: ''
  }),
  computed: {
    portos () {
      return this.$store.state.portosE.filter((porto) => {
        return porto.nome.match(this.search)
      })
    }
  },
  mounted () {
    this.$store.dispatch('GET_PORTO')
  },
  methods: {
    create_porto () {
      const porto = {
        nome: this.nome,
        pais: this.pais
      }
      this.$store.dispatch('ADD_PORTO', porto)
    },
    show_porto (porto) {
      this.portoToUpdate = porto
    },
    edit_porto () {
      const porto = {
        nome: this.portoToUpdate.nome,
        pais: this.portoToUpdate.pais,
        id: this.portoToUpdate.id
      }
      console.log(porto)
      this.$store.dispatch('EDIT_PORTO', porto)
    },
    delete_aliquot (aliquot) {
      this.$store.dispatch('DELETE_ALIQUOT', aliquot)
    },
    blur () {
      const popup = document.getElementById('popup')
      popup.classList.toggle('active')
    }
  }
}
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap");
h1 {
  position: absolute;
  left: 5%;
  top: 5%;
  background: none;
  font-family: "Poppins", sans-serif;
}
.fields {
  border: 0;
  background: #ffffff;
  text-align: center;
  border: none;
  outline: none;
  color: black;
  border-radius: 10px;
  position: absolute;
  height: 5%;
  width: 90%;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: 0.5s;
  font-size: 15px;
}
.fields .desc-actions {
  list-style: none;
  background: none;
}
.box-add {
  position: absolute;
  top: 13%;
  left: 84%;
  transform: translate(-50%, -50%);
  background: #f6e58d;
  width: 300px;
  height: 60px;
  border-radius: 10px;
  display: flex;
}
.box-add button[type="submit"] {
  position: absolute;
  background: #f6e58d;
  border: none;
  width: 300px;
  height: 60px;
  cursor: pointer;
  background: none;
}
.desc-actions {
  position: relative;
  left: 150px;
}
.porto {
  top: 270px;
  left: 50%;
  height: 50px;
  width: 90%;
  position: relative;
  transform: translate(-50%, -50%);
  background: #ffffff;
  border-radius: 10px;
  margin-bottom: 20px;
  align-content: center;
  text-align: center;
  float: left;
}
ul li {
  background: none;
  list-style-type: none;
  white-space: nowrap;
  width: 10px;
  display: inline;
  padding-right: 22%;
  padding-left: 10px;
  float: left;
}

.search-box {
  position: absolute;
  top: 13%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #ffffff;
  height: 41px;
  border-radius: 10px;
  padding: 10px;
  transition: 0.5s;
}
.search-box:hover > .search-txt {
  width: 240px;
  padding: 0 6px;
}
.button {
  background: #ffffff;
  float: right;
  width: 40px;
  height: 40px;
  border-radius: 10%;
  display: flex;
  justify-content: center;
  align-content: center;
  transition: 0.5s;
}
.search-box:hover > .button {
  background: #ecf0f1;
}
.search-txt {
  border: none;
  background: none;
  outline: none;
  float: left;
  padding: 0;
  color: black;
  font-size: 16px;
  transition: 0.5s;
  line-height: 40px;
  width: 0px;
}
img {
  background: none;
}
#popup {
  position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 280px;
  height: 410px;
  border-radius: 15px;
  box-shadow: 0 5px 30px rgba(0, 0, 0, 30);
  background: #ffffff;
  visibility: hidden;
  opacity: 0;
  transition: 0.5s;
}
#popup .tittle {
  position: relative;
  left: 87px;
}
#popup.active {
  top: 50%;
  visibility: visible;
  opacity: 1;
  transition: 0.5s;
}
.data-porto input[type="text"] {
  border: 0;
  background: none;
  display: block;
  margin: 30px auto;
  text-align: center;
  border: 2px solid #f1f2f6;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: black;
  border-radius: 15px;
  top: 20px;
  position: relative;
  transition: 0.25s;
}
.data-porto input[type="text"]:focus {
  border-color: #2ecc71;
}
.data-porto button[type="submit"] {
  border: 0;
  background: none;
  display: block;
  margin: 30px auto;
  text-align: center;
  border: 2px solid #f1f2f6;
  padding: 14px 10px;
  width: 150px;
  outline: none;
  color: black;
  border-radius: 15px;
  top: 20px;
  position: relative;
  transition: 0.25s;
}
.data-porto button[type="submit"]:hover {
  background: #2ecc71;
}
.data-porto {
  text-align: center;
  height: 40px;
}
.info {
  background: none;
  position: relative;
  right: 30px;
}
.line-register {
  width: 95%;
  position: relative;
  border: 1px solid #f1f2f6;
  top: 5px;
  left: 30px;
}
.test {
   overflow: auto;
}
.visualization {
  overflow-y: scroll;
  width: 70%;
  height: 90%;
  top: 50%;
  left: 50%;
  transform: translate(-35%, -50%);
  position: absolute;
  background: #95afc0;
  border-radius: 15px;
  margin-left: 10px;
}
::-webkit-scrollbar {
  width: 0px;
  background-color: hidden;
}
</style>
