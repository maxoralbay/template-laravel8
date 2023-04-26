import { createStore } from 'vuex';
import auth from 'Store/modules/auth.js';
import common from 'Store/modules/common.js';

export default createStore({
    modules: {
        auth,
        common
    }
})