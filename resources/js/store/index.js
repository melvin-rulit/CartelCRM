import { createStore } from 'vuex';
import saveRoute from './modules/saveRoute';

const store = createStore({
    modules: {
        saveRoute,
    },
});

export default store;

