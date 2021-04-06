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
                    {{ activiteit.datum }}
                </td>
                <td>
                    {{ activiteit.tijd }}
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
                    <a href="#" v-if="activiteit.mogelijkOmInTeSchrijven">
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
                    {{ activiteit.datum }}
                </td>
                <td>
                    {{ activiteit.tijd }}
                </td>

                <td>
                    {{ activiteit.soort.naam }}
                </td>
                <td>
                    &euro;{{ activiteit.soort.prijs }}
                </td>
                <td title="schrijf in voor activiteit">
                    <a href="#">
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
        axios.get('/api/user/activiteiten').then((res) => {
            this.ingeschrevenActiviteiten = res.data.ingeschrevenActiviteiten;
            this.beschikbareActiviteiten = res.data.beschikbareActiviteiten;
            this.totaal = res.data.totaal;
        })
    }
}
</script>

<style scoped>

</style>