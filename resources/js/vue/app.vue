<template>
    <div style="margin-left: 150px;" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="todoListContainer">
                    <div class="heading">
                        <h2 id="title">Listas</h2>
                        <add-item-form-lista v-on:reloadlist="getListas()" />
                    </div>
                    <list-view-lista
                    :listas="listas"
                    v-on:reloadlist="getListas()"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="todoListContainer">
                    <div class="heading">
                        <h2 id="title">{{ lista_selecionada.name }}</h2>
                        <add-item-form v-on:reloadlist="getItems()" />
                    </div>
                    <list-view
                    :items="items"
                    v-on:reloadlist="getItems()"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import addItemFormLista from './addItemFormLista'
import listViewLista from './listViewLista'
import addItemForm from './addItemForm'
import listView from './listView'
export default {
    components: {
        addItemForm,
        listView,
        addItemFormLista,
        listViewLista
    },
    data: function(){
        return {
            listas: [],
            items: [],
            lista_selecionada: {
                id: 0,
                name: ''
            }
        }
    },
    methods: {
        getListas () {
            axios.get('api/lista')
            .then(response => {
                this.listas = response.data
            })
            .catch( error => {
                console.log(error);
            })
        },
        getItems () {
            axios.get('api/items/' + this.lista_selecionada.id)
            .then(response => {
                this.items = response.data
            })
            .catch( error => {
                console.log(error);
            })
        },
        getListaSelecionada ($id = '') {
            if ($id == '') return '';
            console.log('this.lista_selecionada.id', this.lista_selecionada.id);
            console.log('$id', $id);
            this.lista_selecionada = {id: $id};
            axios.get('api/lista/' + $id)
            .then(response => {
                this.lista_selecionada = response.data;
                document.getElementById('list_id').value = this.lista_selecionada.id;
                this.getItems();
            })
            .catch( error => {
                console.log(error);
            })
        }
    },
    created(){
        this.getListas();
        this.getListaSelecionada(1);
        eventBus.$on('getListaSelecionada', ($id) => {
            this.getListaSelecionada($id);
        })
    }
}
</script>

<style scoped>
.todoListContainer{
    width: 350px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;
}

.heading{
    background: #e6e6e6;
    padding: 10px;
}

#title{
    text-align:center;
}
</style>
