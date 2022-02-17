<template>
    <div :key="recipes.id" class="col-lg-3 col-md-6 col-12 listRecipe">
        <div class="imgRecipe"></div>
        <h2>{{recipes.nameRecipe}}</h2>
        <!--j'ajoute une limite de caractère pour la description de mon paragraphe-->
        <p>mon paragraphe</p>
        <!--<p>ajouter par  /*Auth::user()->pseudo*/</p>-->
        <a class="btn btn-primary" href="#">Voir la recette</a>
    </div>
</template>
<script>
export default {
    data() {
        return {
            recipes: {},
        };
    },

    created() {
        // je retourne une promesse qui récuperera mes données
        axios
            .get("/recipe-list")
            .then(response => this.recipes = response.data)
            .catch(error => console.log(error));
    },
};
</script>
