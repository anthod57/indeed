<template lang="">
    <section class="login-form">
        <h2>Connexion</h2>
        <Switch v-model="form.type" :leftValue="{ label: 'Utilisateur', value: 'user' }" :rightValue="{ label: 'Entreprise', value: 'company' }" />
        <div class="wrapper">
            <div class="column">
                <div class="input">
                    <label for="email">Adresse email:</label
                    ><input type="email" id="email" name="email" placeholder="Adresse email" required v-model="form.email" v-on:keyup.enter="handleLogin()" />
                </div>
                <div class="input">
                    <label for="password">Mot de passe:</label
                    ><input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mot de passe"
                        required
                        v-model="form.password"
                        v-on:keyup.enter="handleLogin()"
                    />
                </div>
                <span class="error" v-if="error">{{ error }}</span>
                <button v-on:click="handleLogin()">Se connecter</button>
            </div>
        </div>
    </section>
</template>

<script>
import Switch from "../components/Switch.vue";

export default {
    name: "LoginForm",
    components: {
        Switch,
    },

    data() {
        return {
            form: { email: null, password: null, type: null },
            error: "",
        };
    },

    mounted() {},

    methods: {
        handleLogin() {
            this.error = null;

            // Check if user credentials are correctly provided.
            if (!this.validateForm()) return;

            // Get the CSRF cookie which contains the xsrf-token which is needed for all POST requests related to users.
            axios
                .get("/sanctum/csrf-cookie")
                .then(() => {
                    // GET request done, we now have the required xsrf-token.
                    // Axios automatically manages the headers data for us, nothing more to do.

                    // Send login request.
                    return axios.post("/login", this.form);
                })
                .then((response) => {
                    // If no errors, we put the user object which contains public data in a Vuex state.
                    // Then redirect to the hompage.
                    window.auth_user = response.data;
                    this.$store.commit("setUser", response.data);
                    this.$router.push({ name: "Home" });
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
            // Check if the email address provided by user is not in a correct format.
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,9})+$/.test(this.form.email) == false) {
                this.error = "Veuillez entrer une adresse email valide.";
                return false;
            }

            // Check if the password provided by the user is empty.
            if (!this.form.password) {
                this.error = "Veuillez entrer un mot de passe.";
                return false;
            }

            return true;
        },
    },
};
</script>

<style lang="scss" scoped>
.login-form {
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

        .column {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            gap: 1rem;

            .input {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                gap: 0.5rem;

                input {
                    font-size: 1rem;
                    padding: 0.5rem 1rem;
                    width: 100%;
                    max-width: 300px;
                    border-radius: 20px;
                    box-shadow: 0px 2px 2px #00000080;
                }
            }
        }

        .error {
            color: red;
            font-size: 0.8rem;
        }
    }
}
</style>
