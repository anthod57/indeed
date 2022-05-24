import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    state () {
        return {
            currentSearchInput: '',
            viewedOffers: [],
            user: null
        }
    },

    mutations: {
      setCurrentSearchInput(state, payload){
          state.currentSearchInput = payload;
      },

      addViewedOffer(state, payload){
          state.viewedOffers.push(payload)
      },

      setUser(state, payload){
          state.user = payload;
      }
    },

    getters: {
        getCurrentSearchInput: state => state.currentSearchInput,
        getViewedOffers: state => state.viewedOffers,
        getUser: state => state.user
    },
    
    plugins: [createPersistedState({
        storage: window.sessionStorage,
    })],
  })

  
export default store;