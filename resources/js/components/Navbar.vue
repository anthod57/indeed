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

                        <div class="user-more" v-on:click="showMoreMenu = !showMoreMenu">
                             <font-awesome-icon
                                class="icon"
                                :icon="['fas', 'ellipsis-v']"
                            />
                        </div>

                        <div class="more-menu" v-bind:style="{transform: showMoreMenu ? 'scaleY(1)' : 'scaleY(0)'}">
                            <ul>
                                <li>Hey</li>
                                <li>Hey 2</li>
                                <li>Hey 3</li>
                            </ul>
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
            showMenu: false,
            showMoreMenu: false
        }
    },
};
</script>

<style lang="scss">

.navbar-container {
    background-color: #f8f8fc;
    height: 100%;
    width: 25vw;
    color: black;

    .mobile-menu-button {
        position: fixed;
        width: 50px;
        height: 50px;
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
                max-width: 400px;
                margin: auto;
                border: 2px solid #dbdbdb;
                border-radius: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem;
                position: relative;
                transition: all 0.5s ease-in-out;

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
                        color: #5D618A;
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
                top: 0.5rem;
                right: 0.5rem;
                background-color: #A4A4AB;
                width: 20px;
                height: 20px;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 0.8rem;
            }

            
            .more-menu {
                position: absolute;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f8f8fc;
                bottom: 100%;
                left: 5%;
                right: 5%;
                overflow: hidden;
                text-align: center;
                border: 2px solid #dbdbdb;
                border-bottom: 0px;
                border-radius: 10px 10px 0 0;
                transform-origin: bottom;
                transition: all 0.5s ease-in-out;
                z-index: 20;
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
