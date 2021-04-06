<template>
    <section>
        <table v-if="activiteiten" class="table" style="table-layout: fixed">
            <caption>
                Dit zijn alle activiteiten van het kartcentrum
            </caption>
            <thead>
            <tr>
                <td>datum</td>
                <td>tijd</td>
                <td>soort activiteit</td>
                <td>deelnemers</td>
                <td>plaatsen</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="activiteit in activiteiten">
                <td>
                    {{ activiteit.datumFormatted }}
                </td>
                <td>
                    {{ activiteit.tijdFormatted }}
                </td>

                <td>
                    {{ activiteit.soort.naam }}
                </td>
                <td>
                    {{ activiteit.users.length }}
                </td>
                <td>
                    {{ activiteit.limiet }}
                </td>
                <td title="details">
                    <router-link :to="{name:'MedewerkerActiviteitenDetail', params: {id: activiteit.id}}">
                        <a class="glyphicon glyphicon-search" style="color:red"></a>
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
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ActiviteitOverzicht",
    store: store,
    created() {
        this.loadData();
    },
    methods: {
        ...mapActions({
            loadData: 'activiteiten/loadData'
        }),
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