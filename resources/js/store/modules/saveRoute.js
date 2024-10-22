const state = {
    previousRoute: '',
    typeRoute: '',
};

const mutations = {
    setPreviousRoute(state, route) {
        state.previousRoute = route;
    },
    setRouteType(state, type) {
        state.typeRoute = type;
    },
    resetRouteType(state) {
        state.previousRoute = ''; // Сбросьте значение typeRoute
    },
};

const actions = {
    saveRoute({ commit }, route, type) {
        commit('setPreviousRoute', route);
        commit('setRouteType', type);

    },
    clearRouteType({ commit }) {
        commit('resetRouteType'); // Вызовите мутацию для сброса
    },
};

const getters = {
    getPreviousRoute: (state) => state.previousRoute,
    getRouteType: (state) => state.typeRoute,
};

export default {
    state,
    mutations,
    actions,
    getters,
};

