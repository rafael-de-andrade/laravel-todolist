<template>
    <div class="item">
       <input
       type="checkbox"
       @change="updateCheck()"
       v-model="lista.completed"
       />
       <a class="link_lista" @click="selecionarLista(lista.id)">
       <span :class="[lista.completed ? 'completed' : '','itemText']">
           {{ lista.name }}
       </span>
       </a>
       <button @click="removeItem()" class="trashcan">
           <font-awesome-icon icon="trash" />
       </button>
    </div>
</template>

<script>
export default {
    props: ['lista'],
    methods: {
        selecionarLista($id){
            eventBus.$emit('getListaSelecionada', $id);
        },
        updateCheck(){
            axios.put('api/lista/' + this.lista.id, {
                lista: this.lista
            })
            .then(responce =>{
                if( responce.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removeItem() {
            axios.delete('api/lista/' + this.lista.id)
            .then(responce => {
                if (responce.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style  scoped>
.link_lista{
    width: 100%
}
.completed{
    text-decoration: line-through;
    color: #999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item{
    display:flex;
    justify-content: center;
    align-items: center;
}
.trashcan{
    background: #e6e6e6;
    border:none;
    color: #ff0000;
    outline: none;
}
</style>
