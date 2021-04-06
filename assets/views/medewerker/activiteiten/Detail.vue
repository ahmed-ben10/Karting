<template>
    <section v-if="Object.entries(activiteit).length">
        <table class="table table-striped" style="table-layout: fixed">
            <caption>Activiteit</caption>
            <tr>
                <td>soort</td>
                <td class="text-primary">{{ activiteit.soort.naam }}</td>
            </tr>
            <tr>
                <td>datum:</td>
                <td>{{ activiteit.datumFormatted }}</td>
            </tr>
            <tr>
                <td>tijd:</td>
                <td>{{ activiteit.tijdFormatted }}</td>
            </tr>


        </table>
        <table v-if="deelnemers.length" class="table table-striped" style="table-layout: fixed">
            <caption>Dit zijn de deelnemers</caption>
            <thead>
            <tr>
                <td>naam</td>
                <td>adres</td>
                <td>postcode</td>
                <td>woonplaats</td>
                <td>email</td>
                <td>telefoon</td>
            </tr>
            </thead>
            <tbody>

            <tr v-for="deelnemer in deelnemers">

                <td>{{ deelnemer.naam }}</td>
                <td> {{ deelnemer.adres }}</td>
                <td> {{ deelnemer.postcode }}</td>
                <td>{{ deelnemer.woonplaats }}</td>
                <td>{{ deelnemer.email }}</td>
                <td>{{ deelnemer.telefoon }}</td>

            </tr>
            </tbody>
        </table>
        <p v-else> geen deelnemers </p>
        <br/>
    </section>
</template>

<script>
import axios from "axios";
import store from "../../../store/store";

export default {
    name: "Detail",
    store: store,
    data: function () {
        return {
            activiteit: {},
            deelnemers: []
        }
    },
    created() {
        this.fillData();
    },
    methods: {
        fillData() {
            const id = this.$route.params.id
            axios.get('/api/admin/activiteiten/' + id).then((res) => {
                this.activiteit = res.data.activiteit;
                this.deelnemers = res.data.deelnemers;
            })
        }
    }
}
</script>

<style scoped>

</style>