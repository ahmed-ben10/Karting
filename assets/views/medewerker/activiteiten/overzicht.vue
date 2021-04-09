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
import store from "../../../store/store";
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "ActiviteitOverzicht",
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