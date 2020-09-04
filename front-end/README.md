# front-end

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

### Estrutura Geral

O desafio de front-end não chegou a ser concluido,
mas a ideia era criar um pagina em que se pudesse navegar
de maneira simples entre as paginas, mas
ao mesmo tempo interage com as funções em geral do CRUD,
sendo assim possivel fazer operações e visualizar os dados
já sendo cadastrados.

O projeto é contituido de Assets,components,router,store,vues e main.

A estrutura foi adotada dessa maneira pois existe um padrão de projeto e como
são distribuidos os componentes e sua responsabilidades, sendo assim a partir 
desse padrão fiz algumas alterações a fim de melhorar o entendimento e a 
nabegação entre esses componentes.

Para usar o projeto basta usar o comando { npm run serve }
e usar o localhost gerado pelo vue

### Assets

Contem tudo pertinente a imagens e figuras visuais

### Components

Blocos de códigos reutilizaveis se encontram aqui

### Router

Nossa rotas

### Store

Gerenciador de estados com o vueX, foi segragado para melhor organização e entendimento.

Actions vão servir de gatilho para a mutation fazer o processo propriamente dito como uma
mutação pois não se pode alterar o estado diretamente dentro do VueJs, após a mutação o
produto dela é armazenado no state.

### Views

Nossas pagians que são acessadas com o nosso vue router

### Main.js 

É onde vamos chamar globalmente nossas bibliotecas pra dentro do nosso projeto,
como requisões http feitas com o axios.

### Uso geral 

Acessando a pagina você vai se deparar com uma SPA que foi adotada para o tamanho e proposito do projeto,
que possui as rotas
