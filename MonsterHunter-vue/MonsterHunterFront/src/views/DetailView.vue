<template>
  <div >
    <div class="img-container">
               <img :src="require(`../assets/img/${monster.name.toLowerCase()}.png`)">
</div>
    <div class="courses-container">
      <div class="course">
        <div class="course-preview">
        </div>
        <div class="course-info">
          <h2>{{ monster.name }} ({{ monster.nickname }})</h2>
          <h4>{{ monster.specie }}</h4>
        
          <h4 v-if="monster.element == null">Element: Physique</h4>
          <h4 v-if="monster.element != null">Element: {{ monster.element }}</h4>
          <h4>Faiblesse: {{ monster.weakagainst }}</h4>
          <h4>Taille: {{ monster.lengthmin }} - {{ monster.lengthmax }}</h4>
          <h4>Generation: {{ monster.generation }}</h4>
          <h4 v-if="monster.agro == true" class="agressive">Aggresif</h4>
          <h4 v-if="monster.agro != true" class="passive">Passif</h4>
          <p>{{ monster.description }}</p>
        </div>
        <h6 @click="goBackToListing()">Retour</h6>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "DetailView",
  data: () => ({
    monster: {},
  }),
  methods: {
goBackToListing()
{
  this.$router.push({name:"list"})
}

  },
  async created() {
    let monster = await axios.get(
      "http://localhost:15000/monster/" + this.$route.params.monsterId
    );
    this.monster = monster.data;
  },
};
</script>

<style scoped>
p{
  margin: 0 200px;
}
.agressive{
  color: red;
}
.passive{
  color:green;
}
h6{
cursor: pointer;
padding: 5px;
color:white;
background-color: black;

}
.img-container{
  display: flex;
  justify-content: center;
  
  width:100%;
}

img{
  width: 50%;
}
.course-preview{
  width: 25%;
}

</style>