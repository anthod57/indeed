<template lang="">
    <section class="register-form">
        <h2>Inscription</h2>
        <Switch
            v-model="type"
            :defaultSide="$route.params.defaultType === 'company' ? 1 : -1"
            :leftValue="{ label: 'Utilisateur', value: 'user' }"
            :rightValue="{ label: 'Entreprise', value: 'company' }"
        />
        <div v-bind:class="{ 'wrapper user': type === 'user', 'wrapper company': type === 'company' }">
            <form action="" name="userRegister" id="userRegister" class="user">
                <div class="input">
                    <label for="userLastname">Nom:</label>
                    <input
                        type="text"
                        id="userLastname"
                        name="userLastname"
                        placeholder="Nom"
                        required
                        v-model="userForm.lastname"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="userFirstname">Prénom:</label>
                    <input
                        type="text"
                        id="userFirstname"
                        name="userFirstname"
                        placeholder="Prénom"
                        required
                        v-model="userForm.firstname"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="userEmail">Adresse email:</label>
                    <input
                        type="email"
                        id="userEmail"
                        name="userEmail"
                        placeholder="Adresse email"
                        required
                        v-model="userForm.email"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="userPassword">Mot de passe:</label>
                    <input
                        type="password"
                        id="userPassword"
                        name="userPassword"
                        placeholder="Mot de passe"
                        required
                        v-model="userForm.password"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <span class="error" v-if="error">{{ error }}</span>
                <button type="button" v-on:click="handleRegister()">S'inscrire</button>
            </form>

            <form action="" name="companyRegister" id="companyRegister" class="company">
                <div class="input">
                    <label for="companyName">Nom:</label>
                    <input
                        type="text"
                        id="companyName"
                        name="companyName"
                        placeholder="Nom"
                        required
                        v-model="companyForm.name"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="companyEmail">Adresse email:</label>
                    <input
                        type="email"
                        id="companyEmail"
                        name="companyEmail"
                        placeholder="Adresse email"
                        required
                        v-model="companyForm.email"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <div class="input">
                    <label for="companyPassword">Mot de passe:</label>
                    <input
                        type="password"
                        id="companyPassword"
                        name="companyPassword"
                        placeholder="Mot de passe"
                        required
                        v-model="companyForm.password"
                        v-on:keyup.enter="handleRegister()"
                    />
                </div>

                <span class="error" v-if="error">{{ error }}</span>
                <button v-on:click="handleRegister()">S'inscrire</button>
            </form>
        </div>
    </section>
</template>

<script>
import Switch from "../components/Switch.vue";

export default {
    name: "RegisterForm",

    components: {
        Switch,
    },

    data() {
        return {
            userForm: {
                lastname: null,
                firstname: null,
                email: null,
                password: null,
                type: "user",
            },

            companyForm: {
                name: null,
                email: null,
                password: null,
                type: "company",
            },

            error: "",

            type: "",
        };
    },

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
                    return axios.post("/register", this.type === "user" ? this.userForm : this.companyForm);
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
            if (this.type === "user") {
                // Check if the email address provided by user is not in a correct format.
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,9})+$/.test(this.userForm.email) == false) {
                    this.error = "Veuillez entrer une adresse email valide.";
                    return false;
                }

                // Check if the password, firstname and lastname provided by the user are empty.
                if (!this.userForm.password) {
                    this.error = "Veuillez entrer un mot de passe.";
                    return false;
                }

                if (!this.userForm.firstname) {
                    this.error = "Veuillez entrer un prénom.";
                    return false;
                }

                if (!this.userForm.lastname) {
                    this.error = "Veuillez entrer un nom.";
                    return false;
                }
            }

            if (this.type === "company") {
                // Check if the email address provided by user is not in a correct format.
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,9})+$/.test(this.companyForm.email) == false) {
                    this.error = "Veuillez entrer une adresse email valide.";
                    return false;
                }

                // Check if the password, firstname and lastname provided by the user are empty.
                if (!this.companyForm.password) {
                    this.error = "Veuillez entrer un mot de passe.";
                    return false;
                }

                if (!this.companyForm.name) {
                    this.error = "Veuillez entrer un nom d'entreprise.";
                    return false;
                }
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
        position: relative;

        .error {
            color: red;
            font-size: 0.8rem;
        }

        form {
            transition: 0.5s all;
        }

        &.user {
            .user {
                transform: translate(0, 0);
            }

            .company {
                transform: translate(100vw, 0);
                position: absolute;
            }
        }

        &.company {
            .user {
                transform: translate(-100vw, 0);
                position: absolute;
            }

            .company {
                transform: translate(0, 0);
            }
        }
    }
}
</style>
