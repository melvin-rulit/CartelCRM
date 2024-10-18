const state = {
    previousRoute: '',
};

const mutations = {
    setPreviousRoute(state, route) {
        state.previousRoute = route;
    },
};

const actions = {
    saveRoute({ commit }, route) {
        commit('setPreviousRoute', route);
    },
};

const getters = {
    getPreviousRoute: (state) => state.previousRoute,
};

export default {
    state,
    mutations,
    actions,
    getters,
};

