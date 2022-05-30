<template lang="">
    <div v-bind:class="{ 'offer active': isActive, offer: !isActive }" v-bind:style="{ backgroundColor: isViewed ? '#e4e4e8' : '' }">
        <div class="wrapper">
            <div class="company-infos">
                <div class="company-picture">
                    <img ref="companyPicture" :src="'/images/default.png'" @error="$event.target.src = '/images/default.png'" />
                </div>
                <div class="infos">
                    <h2>{{ data.company }}</h2>
                    <h3>{{ data.title }}</h3>
                    <div class="row">
                        <span>
                            <font-awesome-icon class="icon" :icon="['fas', 'location-dot']" />
                            {{ data.location }}
                        </span>
                        <span>
                            <font-awesome-icon class="icon" :icon="['fas', 'eye']" />
                            {{ data.views }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="offer-infos">
                <span class="salary" v-if="data.salary > 0"
                    ><b>{{ data.salary }}€</b> / an</span
                >
            </div>
        </div>

        <div class="offer-more">
            <font-awesome-icon class="icon" :icon="['fas', 'ellipsis-v']" />
        </div>
    </div>
</template>

<script>
export default {
    name: "Offer",

    props: ["data", "isActive", "isViewed"],

    mounted() {
        this.$refs.companyPicture.src = `/storage/images/companies/${this.data.postedBy}.png`;
    },
};
</script>

<style lang="scss" scoped>
.offer {
    cursor: pointer;
    max-width: 800px;
    height: 200px;
    background-color: #f8f8fc;
    border-radius: 20px;
    margin: auto;
    padding: 1.5rem;
    border: 2px solid transparent;
    transition: all 0.15s ease-in-out;
    position: relative;
    margin: 1rem auto;

    &.active {
        border: 2px solid #505df1cc;
    }

    .wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        gap: 1rem;

        .company-picture {
            width: 33%;
            min-width: 25px;
            max-width: 100px;
            aspect-ratio: 1/1;
            border-radius: 20px;
            overflow: hidden;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

        .company-infos {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1rem;

            .infos {
                color: #5d618a;

                h2 {
                    color: #3b3b3b;
                }

                h3 {
                    font-weight: normal;
                }

                .row {
                    margin: 5px 0;
                    display: flex;
                    gap: 1rem;

                    span {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 4px;
                    }

                    svg {
                        font-size: 0.8rem;
                    }
                }
            }
        }

        .offer-infos {
            flex-shrink: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;

            h3 {
                font-weight: normal;
            }

            .team {
                font-size: 0.9rem;
                color: #a4a4ab;
            }

            .salary {
                margin: 1rem 0;
                color: #4d484e;
            }
        }
    }

    .offer-more {
        cursor: pointer;
        position: absolute;
        border-radius: 50%;
        top: 1rem;
        right: 1rem;
        background-color: #a4a4ab;
        width: 20px;
        height: 20px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.8rem;
    }

    @media screen and (max-width: 600px) {
        padding: 1rem;

        .wrapper {
            flex-direction: column;
            gap: 5px;

            .company-infos {
                .company-picture {
                    max-width: 50px;
                    max-height: 50px;
                }

                .infos {
                    h2 {
                        font-size: 1.25rem;
                    }

                    h3 {
                        font-size: 1.1rem;
                    }

                    .row {
                        margin: 0;
                    }
                }
            }

            .offer-infos {
                flex-shrink: 1;
                flex-direction: row;
                align-items: center;
                gap: 1rem;

                .salary {
                    flex-grow: 1;
                    text-align: right;
                }
            }
        }
    }

    @media screen and (max-width: 330px) {
        .wrapper {
            .company-infos {
                .company-picture {
                    display: none;
                }
            }
        }

        .offer-infos {
            font-size: 0.8rem;
        }
    }
}
</style>
