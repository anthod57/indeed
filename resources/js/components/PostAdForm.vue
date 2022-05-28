<template lang="">
    <section class="postad-form">
        <h2>Publier une annonce</h2>
        <div class="wrapper">
            <form action="" name="postad" id="postad">
                <div class="input">
                    <label for="title">Titre:</label
                    ><input type="text" id="title" name="title" placeholder="Titre" required v-model="form.title" v-on:keyup.enter="handleLogin()" />
                </div>

                <div class="input">
                    <label for="description">Description:</label
                    ><textarea rows="10" type="text" id="description" name="description" placeholder="Description" required v-model="form.description" />
                </div>

                <div class="input">
                    <label for="location">Emplacement:</label
                    ><input
                        type="text"
                        id="location"
                        name="location"
                        placeholder="Ville, code postal"
                        required
                        v-model="form.location"
                        v-on:keyup.enter="handlePost()"
                    />
                </div>

                <div class="row">
                    <div class="input">
                        <label for="salary">Salaire (brut/an):</label
                        ><input
                            type="number"
                            step="500"
                            min="0"
                            id="salary"
                            name="salary"
                            placeholder="Vide ou 0 si indéfini"
                            required
                            v-model="form.salary"
                            v-on:keyup.enter="handlePost()"
                        />
                    </div>

                    <div class="select">
                        <label for="type">Type:</label>
                        <v-select
                            :searchable="false"
                            v-model="form.type"
                            :reduce="(option) => option.id"
                            id="type"
                            name="type"
                            :options="[
                                { label: 'CDI', id: 0 },
                                { label: 'CDD', id: 1 },
                                { label: 'Alternance', id: 2 },
                                { label: 'Stage', id: 3 },
                            ]"
                        ></v-select>
                    </div>
                </div>

                <span class="error" v-if="error">{{ error }}</span>
                <button type="button" v-on:click="handlePost()">Se connecter</button>
            </form>
        </div>
    </section>
</template>

<script>
export default {
    name: "PostAdForm",

    data() {
        return {
            form: { title: null, company: null, description: null, location: null, type: null, salary: null, postedBy: null, views: 0 },
            error: "",
        };
    },

    computed: {
        user() {
            return this.$store.getters.getUser;
        },
    },

    mounted() {
        this.form.postedBy = this.user.id;
        this.form.company = this.user.name;
    },

    methods: {
        handlePost() {
            this.error = null;

            // Check if user credentials are correctly provided.
            if (!this.validateForm()) return;

            // Get the CSRF cookie which contains the xsrf-token which is needed for all POST requests related to users.
            axios
                .get("/sanctum/csrf-cookie")
                .then(() => {
                    // GET request done, we now have the required xsrf-token.
                    // Axios automatically manages the headers data for us, nothing more to do.

                    // Send post request.
                    return axios.post("/api/offers", { offer: this.form });
                })
                .then((response) => {
                    // If no errors, we redirect user to the offer page.

                    this.$router.push({ name: "Offer", params: { offer: response.data.id } });
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        this.error = "Email ou mot de passe incorrect.";
                        return;
                    }

                    this.error = "Une erreur inconnue est survenue.";
                    console.log(error.response);
                });
        },

        validateForm() {
            if (!this.form.title) {
                this.error = "Veuillez entrer un titre.";
                return false;
            }

            if (!this.form.description) {
                this.error = "Veuillez entrer une description.";
                return false;
            }

            if (!this.form.location) {
                this.error = "Veuillez entrer un emplacement.";
                return false;
            }

            if (!this.form.type) {
                this.error = "Veuillez choisir un type.";
                return false;
            }

            return true;
        },
    },
};
</script>

<style lang="scss" scoped>
.postad-form {
    width: 100%;
    max-width: 800px;

    h2 {
        text-align: center;
        font-weight: 600;
        font-size: 2rem;
    }

    .wrapper {
        margin: 1rem 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 600px;
            gap: 1rem;
        }

        .select {
            text-align: center;
            gap: 0.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        input {
            max-width: 600px;
        }

        .error {
            color: red;
            font-size: 0.8rem;
        }
    }
}
</style>
