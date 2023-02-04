<template>
    <div>
        <div v-for="(lista,index) in listas" :key="index">
            <list-item-lista
                :lista="lista"
                class="item"
                v-on:itemchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import listItemLista from "./listItemLista";
export default {
    props: ['listas'],
    components : {
        listItemLista
    }
}
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
