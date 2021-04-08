<template>
    <section>
        <table v-if="activiteiten" class="table" style="table-layout: fixed">
            <caption>
                Dit zijn alle activiteiten van het kartcentrum
            </caption>
            <thead>
            <tr>
                <td>naam</td>
                <td>beschrijving</td>
                <td>prijs</td>
                <td>tijdsduur</td>
                <td>minimum leeftijd</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="activiteit in activiteiten">
                <td>
                    {{ activiteit.naam }}
                </td>
                <td>
                    {{ activiteit.beschrijving }}
                </td>

                <td>
                    {{ activiteit.prijs }}
                </td>
                <td>
                    {{ activiteit.tijdsduur }}
                </td>
                <td>
                    {{ activiteit.minLeeftijd }}
                </td>
                <td title="details">
                    <router-link :to="{name:'MedewerkerActiviteitenEdit', params: {id: activiteit.id}}">
                        <a class="glyphicon glyphicon-pencil" style="color:red"></a>
                    </router-link>
                </td>
                <td title="details">
                    <a @click="deleteActiviteit(activiteit.id)" class="glyphicon glyphicon-minus" style="color:red"></a>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <router-link :to="{name: 'MedewerkerActiviteitenAdd'}">
                        <span class="glyphicon glyphicon-plus" style="color:red"></span>
                    </router-link>
                </td>
            </tr>
            </tbody>
        </table>
        <p v-else>Geen activiteiten gevonden</p>
    </section>
</template>

<script>
import axios from "axios";
import store from "../../../store/store";
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "SoortActiviteitOverzicht",
    store: store,
    created() {
        this.loadData();
    },
    methods: {
        ...mapActions({
            loadData: 'activiteiten/loadData',
            remove: 'activiteiten/delete'
        }),
        deleteActiviteit(id) {
            this.remove(id).then(res => {
                this.$notify({group: 'message', text: res.data.title, type: 'success'})
                this.loadData();
            }).catch(error => {
                console.error(error)
            });
        }
    },
    computed: {
        ...mapGetters({
            activiteiten: 'activiteiten/getActiviteiten'
        })
    }
}
</script>

<style scoped>

</style>