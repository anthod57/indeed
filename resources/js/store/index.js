import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    state () {
        return {
            currentSearchInput: '',
            viewedOffers: []
        }
    },
    mutations: {
      setCurrentSearchInput(state, payload){
          state.currentSearchInput = payload;
      },

      addViewedOffer(state, payload){
          state.viewedOffers.push(payload)
      }
    },
    getters: {
        getCurrentSearchInput: state => state.currentSearchInput,
        getViewedOffers: state => state.viewedOffers
    },
    plugins: [createPersistedState({
        storage: window.sessionStorage,
    })],
  })

  
export default store;