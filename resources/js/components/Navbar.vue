<template lang="">
    <div v-bind:class="{'navbar-container': showMenu == false, 'navbar-container show': showMenu == true}">
        <div class="navbar-wrapper">
            <div class="logo">
                <h2>Logo</h2>
            </div>
            <div class="menu">
                <div class="top">
                    <ul>
                        <li class="active">
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'home']"
                            />Accueil
                        </li>
                        <li>
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'search']"
                            />Recherche d'emplois
                        </li>
                        <li>
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'building']"
                            />Avis sur les entreprises
                        </li>
                        <li>
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'calculator']"
                            />Estimation de salaire
                        </li>
                    </ul>
                </div>
                <div class="bottom">
                    <!-- If user not logged in -->
                    <!-- <ul>
                        <li>
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'user-plus']"
                            />Inscription
                        </li>
                        <li>
                            <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'arrow-right-to-bracket']"
                            />Connexion
                        </li>
                    </ul> -->
                    <!-- If user logged in -->
                    <div class="user-box">
                        <div class="user-picture">

                        </div>
                        <div class="user-infos">
                            <span class="display-name">Nom Prénom</span>
                            <span>Poste</span>
                        </div>
                        <div class="user-more">
                             <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'ellipsis-v']"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu-button" v-on:click="showMenu = !showMenu">
            <div class="open" v-bind:style="{opacity: showMenu ? 0 : 1}">
                <font-awesome-icon
                    class="icon"
                    :icon="['fas', 'bars']"
                />
            </div>
            <div class="close" v-bind:style="{opacity: showMenu ? 1 : 0}">
                <font-awesome-icon
                    class="icon"
                    :icon="['fas', 'xmark']"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            showMenu: false
        }
    },
};
</script>

<style lang="scss">

.navbar-container {
    background-color: #f8f8fc;
    height: 100vh;
    width: 25vw;
    color: black;

    .mobile-menu-button {
        position: fixed;
        width: 2.5rem;
        height: 2.5rem;
        top: 1rem;
        left: 1rem;
        font-size: 2.5rem;
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 11;
        color: #505DF1;

        .open, .close {
            position: absolute;
            transition: 0.25s all;
        }
    }

    .navbar-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        height: 100%;
        padding: 1rem 2vw;

        .logo {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;

            h2 {
                text-align: center;
                font-size: 2.5rem;
            }
        }

        .menu {
            width: 100%;
            height: 100%;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: flex-start;

            .top, .bottom {
                width: 100%;
            }

            ul {
                list-style: none;
                margin-block-start: 0;
                margin-block-end: 0;
                padding-inline-start: 0;
                font-size: 1rem;
            }

            li {
                color: #4d484e;
                margin: 3vh 0;
                display: flex;
                align-items: center;
                transition: 0.5s all;

                .icon {
                    margin: 0 1rem;
                    font-size: 1.25rem;
                }

                &.active {
                    color: #505DF1;
                    font-weight: 700;
                }
            }

            .user-box {
                width: 100%;
                height: 100px;
                border: 2px solid #dbdbdb;
                border-radius: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem;
                position: relative;

                .user-picture {
                    width: 33%;
                    min-width: 25px;
                    max-width: 60px;
                    aspect-ratio: 1/1;
                    border: 1px solid black;
                    border-radius: 50%;
                }

                .user-infos {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-content: center;
                    width: 100%;
                    height: 100%;
                    margin: 0 1rem;

                    span {
                        color: #505DF1;
                    }

                    .display-name {
                        font-weight: 700;
                        color: #1421b5;
                    }
                }
            }

            .user-more {
                cursor: pointer;
                position: absolute;
                border-radius: 50%;
                top: 1rem;
                right: 1rem;
                background-color: #A4A4AB;
                width: 2vw;
                height: 2vw;
                max-width: 25px;
                max-height: 25px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 0.8rem;
            }
        }
    }
}


@media screen and (max-width: 1024px) {
    .navbar-container {
        position: fixed;
        z-index: 10;
        left: -180%;
        width: auto;
        overflow: hidden;
        transition: 0.5s all;

        .mobile-menu-button {
            display: flex;
            opacity: 1;
        }

        .navbar-wrapper {
            opacity: 0;
        }

        &.show {
            left: 0;

            .navbar-wrapper {
                opacity: 1;
            }
        }
    }
}
</style>
