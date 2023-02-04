<template>
    <div class="addItem">
        <input type="text" v-model="lista.name"/>
        <font-awesome-icon
        icon="plus-square"
        @click="addItem()"
        :class="[lista.name  ? 'active' : 'inactive','plus']"
        />
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            lista :{
                name: ""
            }
        }
    },methods: {
        selecionarLista($id){
            eventBus.$emit('getListaSelecionada', $id);
        },
        addItem(){
            if(this.lista.name == ''){
                return;
            }
            axios.post('api/lista/store', {
                lista: this.lista
            })
            .then( responce => {
                if (responce.status == 201){
                    // document.getElementById('list_id').value = responce.data.id;
                    this.lista.name = "";
                    this.selecionarLista(responce.data.id);
                    this.$emit('reloadlist');
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style  scoped>
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}

input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding:  5px;
    margin-right: 10px;
    width: 100%;
}
.plus {
    font-size: 20px;
}
.active{
    color: #00CE25;
}
.inactive{
    color: #999999;
}
</style>
