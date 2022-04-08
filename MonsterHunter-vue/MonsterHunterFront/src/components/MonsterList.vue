<template>
<div>
<div class="new" v-if="displayAdmin == true" @click="goToForm()">Créer un nouveau monstre ➕</div>
  <div class="list">
      
    <table class="styled-table">
      <thead>
        <tr>
          <th>Icone</th>
          <th>Name</th>
          <th>Nickname</th>
          <th>Species</th>
          <th colspan="2">Element</th> 
          <th colspan="2">Weakness</th> 
         
        
        </tr>
      </thead>
      <tbody>
        <tr v-for="monster in movies" :key="monster.id" @click="goToMonster(monster.id)">
        <th>
                 <img :src="require(`../assets/icone/${monster.name.toLowerCase()}.png`)">

        </th>
          <th>{{monster.name}}</th>
          <th>{{monster.nickname}}</th>
          <th>{{monster.specie}}</th>
  <th> <img :src="require(`../assets/element/${monster.element.toLowerCase()}.png`)" v-if="monster.element!=''">
</th>
          <th >{{monster.element}}</th>
                    <th> <img :src="require(`../assets/element/${monster.weakagainst.toLowerCase()}.png`)">
</th>
          <th colspan="2">{{monster.weakagainst}}</th>
          <th v-if="displayAdmin == true"><span @click.stop="deleteMonster(monster.id)">🚮</span> | <span @click.stop="goToEditForm(monster.id)">🖋</span></th>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "MonsterList",
  data: () => ({
    movies:{},

  }),
  props:{
      displayAdmin:{
          type: Boolean,
          required:true
      }
  },
  methods: {
    goToMonster(monsterId){
        this.$router.push({name: 'detail' , params: {monsterId}})
    },
    goToForm(){
        this.$router.push({name: 'form'})
    },
    goToEditForm(monsterId){
        this.$router.push({name: 'formEdit', params :{monsterId}})
    },
    async deleteMonster(monster){

       await axios.post("http://localhost:15000/delete.php",{id:monster}) //FU alto router
     
     this.$router.go() //reload same page if no argument specified
    }
  },
  async created() {
    let movies = await axios.get("http://localhost:15000/monsters.php");
    console.log(movies);
    this.movies = movies.data;
    console.log(this.movies);
  },
};
</script>

<style scoped>
img{
  width: 50px;
}
tbody tr{
  cursor: pointer;
}
.new{
  cursor: pointer;
}
.list {
  display: flex;
  justify-content: center;
}
.styled-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  font-family: sans-serif;
  min-width: 800px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
  background-color: #009879;
  color: #ffffff;
}
.styled-table th,
.styled-table td {
  padding: 12px 15px;
}
.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}
</style>