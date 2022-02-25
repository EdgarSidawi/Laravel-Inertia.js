<template>
    <div class="container">
        <h3 class="header">My Favourite things</h3>

        <div v-if="!isEditing" class="field">
            <input class="input" type="text" v-model="fav" placeholder="My favourite things"> 
            <input class="input add" type="submit" value="Add" @click="saveFavourite"> <br>
            <span v-if="errors"> {{errors.name}} </span>
        </div>

        <div v-else class="field">
            <input class="input" type="text" v-model="fav" placeholder="My favourite things">
            <input class="input update" type="submit" value="Update" @click="updateFavourite">
        </div>

        <div class="display">
        <ul>
            <li v-for="(favourite) in favourites.data" :key="favourite.id">
                <div>
                {{favourite.name}}
                </div>

                <div>
                <button style="backgroundColor: green" @click="editFavourite(favourite.name,favourite.id)">Edit</button>
                <button style="backgroundColor: red" @click="deleteFavourite(favourite.id)">Delete</button>
                </div>
            </li>
            
        </ul>
        </div>
    </div>
</template>

<script>
import {ref} from 'vue'
import {Inertia} from '@inertiajs/inertia'

export default {
    props:['name', 'favourites', 'errors' ],

    setup() {
        let fav = ref('')
        let favId = ref(null)
        let isEditing = ref(false)

        let saveFavourite = () => {
            Inertia.post('/create', 
                {'name' : fav.value}
            )
            fav.value = ""
        }

        let editFavourite = (favourite,id) => {
            isEditing.value = true
            fav.value = favourite
            favId.value = id
        }

        let deleteFavourite = (id) => {
            Inertia.delete(`/delete/${id}`)
        }

        let updateFavourite = () => {
            Inertia.put(`/edit/${favId.value}`, {
                'name' : fav.value
            })
            isEditing.value = false
            fav.value = ""
        }

        return{
            fav, saveFavourite,editFavourite,deleteFavourite,isEditing,updateFavourite
        }

    },
}
</script>

<style >
    .container {
        max-width: 960px;
        text-align: center;
        margin: 0 auto;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .header {
        width: 100%;
        text-align: center;
        margin:  auto;
    }
    .field {
        padding: 4px 10px;
        margin: 6px auto;
        text-align: center;
    }
    .input {
        margin: 6px 10px;
    }
    .display {
        width: 1;
    }
    .add {
        color: white;
        background-color: violet;
        text-decoration: none;
        border-color: violet;
        cursor: pointer;
    }
    .update {
        color: white;
        background-color: blue;
        text-decoration: none;
        border-color: blue;
        cursor: pointer;
    }
    h1 {
        padding-top: 40px;
    }
    button {
        background-color: violet;
        color: white;
        border: none;
        height: 24px;
        cursor:pointer;
        margin:0 10px;
       
    }
    ul{
        border: 1px solid;
        border-radius: 20px;
    }

    li {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: initial;
        margin: 3px;
    }
    span {
        color: red;
        font: 10px sans-serif;
    }
</style>