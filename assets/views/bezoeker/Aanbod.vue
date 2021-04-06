<template>
    <section>
        <article>
            <h3>Er zijn {{ soortActiviteiten.length }} soorten activiteiten </h3>
            <ul class="list-group">
                <table class="table" style="table-layout: fixed">
                    <caption>
                        Dit zijn alle beschikbare activiteiten
                    </caption>
                    <thead>
                    <tr>
                        <td>Naam</td>
                        <td>Beschrijving</td>
                        <td>Prijs</td>
                        <td>Tijdsduur</td>
                        <td>Minimum leeftijd</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="activiteit in soortActiviteiten">
                        <td>
                            {{ activiteit.naam }}
                        </td>
                        <td>
                            {{ activiteit.beschrijving }}
                        </td>

                        <td>
                            &euro;{{ activiteit.prijs }}
                        </td>
                        <td>
                            {{ activiteit.tijdsduur }} min
                        </td>
                        <td>
                            {{ activiteit.minLeeftijd }} min
                        </td>
                    </tr>
                    </tbody>
                </table>
            </ul>
            <p>
                Let op, voor het karten zijn dichte schoenen verplicht.
                Karten met een korte broek is niet toegestaan. Wij hebben overalls ter beschikking,
                maar probeer indien mogelijk een lange broek aan te doen of mee te nemen.
            </p>
        </article>
        <figure>
            <img class="img-responsive center-block" style="width:30%" :src="host + 'build/img/kart.jpg'" alt="kart"/>
        </figure>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "Aanbod",
    data: function () {
        return {
            soortActiviteiten: []
        }
    },
    computed: {
        host() {
            return window.location.origin.concat('/');
        }
    },
    created() {
        axios.get('/api/soort_activiteit').then((res) => {
            this.soortActiviteiten = res.data;
        }).catch(error => {
            console.error(error)
        })
    }
}
</script>

<style scoped>

</style>