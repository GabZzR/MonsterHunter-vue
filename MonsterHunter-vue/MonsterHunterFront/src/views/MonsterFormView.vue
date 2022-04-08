<template>
  <div class="form">
    <form  v-on:submit.prevent="sendMonster">
         <div v-if="this.monsterId!=undefined">
            <label for="idmonster">ID:  </label>
            <input type="text" name="idmonster" id="idmonster"   v-model="form.id" >
        </div>
        <div>
            <label for="name">Nom:  </label>
            <input type="text" name="name" id="name"   v-model="form.name" >
        </div>
        <div>
            <label for="nickname">Nickname: </label>
            <input type="text" name="nickname" id="nickname" v-model="form.nickname">
        </div>
        <div>
            <textarea name="description" id="description" v-model="form.description" cols="50" rows="8"></textarea>
        </div>
        <div>
        <label for="specie" >Espèce: </label>        
        <input type="text" name="specie" id="specie"  v-model="form.specie"></div>
        <div>
            <label for="element">Element: </label>
            
            <input type="text" name="element" id="element" v-model="form.element">
        </div>
        <div>
            <label for="weakagainst">Faible contre: </label>
            
            <input type="text" name="weakagainst" id="weakagainst" v-model="form.weakagainst">
        </div>

          <div>
            <label for="lenghtmin">Taille min: </label>
            
            <input type="text" name="lenghtmin" id="lenghtmin" v-model="form.lengthmin">
        </div>
        <div>
            <label for="lenghtmmax"  >Taille max: </label>
            
            <input type="text" name="lenghtmax" id="lenghtmax" v-model="form.lengthmax">
        </div>
        <div>
            <label for="generation">Generation: </label>
            
            <input type="text" name="generation" id="generation"  v-model="form.generation">
        </div>
        <div>
            <label for="agro">Agressif: </label>
            
            <input type="checkbox" name="agro" id="agro"  v-model="form.agro">
        
        </div>
                <button  v-if="this.monsterId==undefined">Créer</button>

            <button v-if="this.monsterId!=undefined">Modifier</button>
    </form>
  </div>
</template>

<script>

import axios from "axios";

export default {
  name: "MonsterFormView",
  data: () => ({
         monsterId:"",
         monster:{},
          form: {
              id:'',
                name: '',
                nickname: '',
                description: '',
                specie: '',
                lenghtmax: '',
                lenghtmin: '',
                generation: '',
                weakagainst: '',
                aggro:'',
                element:'',
                
            },
            
  }),
  methods: {
  
      
      async sendMonster(){
if(this.monsterId!=undefined){
       await axios.put("http://localhost:15000/edit.php",this.form) //FU alto router
    
          this.$router.push({name: 'detail' , params: {id:this.monsterId}})
  }else{
      await axios.post("http://localhost:15000/insert.php",this.form) //FU alto router
  }
    }
  },
  components:{

  },
async created(){
    this.monsterId = this.$route.params.monsterId
   
    if(this.monsterId!=undefined){
 let monster = await axios.get(
      "http://localhost:15000/monster/" + this.monsterId
   
    );
       console.log(monster)
  
    this.monster = monster.data;
    this.form.id= this.monster.id;

    this.form.name = this.monster.name;
    this.form.nickname = this.monster.nickname;
    this.form.description = this.monster.description;
    this.form.specie = this.monster.specie;
    this.form.lengthmin = this.monster.lengthmin;
    this.form.lengthmax = this.monster.lengthmax;
    this.form.weakagainst = this.monster.weakagainst;
    this.form.generation = this.monster.generation;
    this.form.element = this.monster.element;

     if(this.monster.agro==1){
this.form.agro = true
    }else{
this.form.agro = false

    }







    
    }else{
        console.log("walou")
    }
}
};

</script>

<style scoped>
div{
    margin-bottom: 10px;
}
</style>