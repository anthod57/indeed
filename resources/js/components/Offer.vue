<template lang="">
    <div class="offer">
        <div class="wrapper">
            <div class="company-infos">
                <div class="company-picture"></div>
                <div class="infos">
                    <h2>Company name</h2>
                    <h3>Job name</h3>
                    <div class="row">
                        <span>Location</span>
                        <span>Views</span>
                    </div>
                    <div class="row">
                        <span>Location</span>
                        <span>Views</span>
                    </div>
                </div>
            </div>

            <div class="offer-infos">
                <span class="team">Team</span>
                <h3>Team Name</h3>
                <span class="salary"><b>SALARY</b> / year</span>
            </div>
        </div>

        <div class="offer-more">
            <font-awesome-icon
                class="icon"
                :icon="['fas', 'ellipsis-v']"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "Offer",
};
</script>

<style lang="scss" scoped>
.offer {
    max-width: 800px;
    height: 200px;
    background-color: #f8f8fc;
    border-radius: 20px;
    margin: auto;
    padding: 1.5rem;
    border: 2px solid transparent;
    transition: all 0.25s ease-in-out;
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
            border: 1px solid black;
            border-radius: 20px;
        }

        .company-infos {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1rem;

            .infos {
                color: #505df1;

                h2 {
                    color: #4d484e;
                }

                h3 {
                    font-weight: normal;
                }

                .row {
                    margin: 5px 0;
                    display: flex;
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
