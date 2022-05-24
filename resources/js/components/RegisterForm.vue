<template lang="">
    <section class="register-form">
        <h2>Inscription</h2>
        <div class="wrapper">
            <div class="row">
                <div class="input">
                    <label for="email">Nom:</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Nom" required v-model="form.lastname" v-on:keyup.enter="handleRegister()" />
                </div>

                <div class="input">
                    <label for="email">Prénom:</label>
                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        placeholder="Prénom"
                        required
                        v-model="form.firstname"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="email">Adresse email:</label>
                    <input type="email" id="email" name="email" placeholder="Adresse email" required v-model="form.email" v-on:keyup.enter="handleRegister()" />
                </div>

                <div class="input">
                    <label for="password">Mot de passe:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Mot de passe"
                        required
                        v-model="form.password"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <span class="error" v-if="error">{{ error }}</span>
                <button v-on:click="handleRegister()">S'inscrire</button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "RegisterForm",

    data() {
        return {
            form: {
                lastname: null,
                firstname: null,
                email: null,
                password: null,
            },
            error: "",
        };
    },

    mounted() {},

    methods: {
        handleRegister() {
            this.error = null;

            // Check if user credentials are correctly provided.
            if (!this.validateForm()) return;

            // Get the CSRF cookie which contains the xsrf-token which is needed for all POST requests related to users.
            axios
                .get("/sanctum/csrf-cookie")
                .then(() => {
                    // GET request done, we now have the required xsrf-token.
                    // Axios automatically manages the headers data for us, nothing more to do.

                    // Send register request.
                    return axios.post("/register", this.form);
                })
                .then((response) => {
                    // Redirect to login page.
                    this.$router.push({ name: "Login" });
                })
                .catch((error) => {
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

            // Check if the password, firstname and lastname provided by the user are empty.
            if (!this.form.password) {
                this.error = "Veuillez entrer un mot de passe.";
                return false;
            }

            if (!this.form.firstname) {
                this.error = "Veuillez entrer un prénom.";
                return false;
            }

            if (!this.form.lastname) {
                this.error = "Veuillez entrer un nom.";
                return false;
            }

            return true;
        },
    },
};
</script>

<style lang="scss" scoped>
.register-form {
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
