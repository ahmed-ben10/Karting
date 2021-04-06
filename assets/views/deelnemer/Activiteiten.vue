<template>
    <section>
        <table class="table" style="table-layout: fixed">
            <caption>
                Dit zijn alle beschikbare activiteiten
            </caption>
            <thead>
            <tr>
                <td>datum</td>
                <td>tijd</td>
                <td>soort activiteit</td>
                <td>prijs</td>
                <td>beschikbare plaatsen</td>
                <td>schrijf in</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="activiteit in beschikbareActiviteiten"
                v-bind:class="{'text-danger': !activiteit.mogelijkOmInTeSchrijven }">
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
                    &euro;{{ activiteit.soort.prijs }}
                </td>
                <td>
                    {{ activiteit.beschikbarePlaatsen }}
                </td>
                <td title="schrijf in voor activiteit">
                    <a @click="inschrijven(activiteit.id)" v-if="activiteit.mogelijkOmInTeSchrijven">
                        <span class="glyphicon glyphicon-plus" style="color:red"></span>
                    </a>
                    <span v-else>
                        N/A
                    </span>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table" style="table-layout: fixed">
            <caption>
                Dit zijn de door jou ingeschreven activiteiten
            </caption>
            <thead>
            <tr>
                <td>datum</td>
                <td>tijd</td>
                <td>soort activiteit</td>
                <td>prijs</td>
                <td>schrijf uit</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="activiteit in ingeschrevenActiviteiten">
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
                    &euro;{{ activiteit.soort.prijs }}
                </td>
                <td title="schrijf in voor activiteit">
                    <a @click="uitschrijven(activiteit.id)">
                        <span class="glyphicon glyphicon-minus" style="color:red"></span>
                    </a>
                </td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    Totaal prijs:
                </td>
                <td>
                    &euro;{{ totaal }}
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "Activiteiten",
    data: function () {
        return {
            totaal: 0,
            ingeschrevenActiviteiten: {},
            beschikbareActiviteiten: {}
        }
    },
    created() {
        this.fillData();
    },
    methods: {
        fillData() {
            axios.get('/api/user/activiteiten').then((res) => {
                this.ingeschrevenActiviteiten = res.data.ingeschrevenActiviteiten;
                this.beschikbareActiviteiten = res.data.beschikbareActiviteiten;
                this.totaal = res.data.totaal;
            })
        },
        inschrijven(id) {
            axios.get('/api/user/inschrijven/' + id).then((res) => {
                this.fillData();
            }).catch(error =>{
                console.error(error)
            });        },
        uitschrijven(id) {
            axios.get('/api/user/uitschrijven/' + id).then((res) => {
                this.fillData();
            }).catch(error =>{
                console.error(error)
            });
        }
    }
}
</script>

<style scoped>

</style>