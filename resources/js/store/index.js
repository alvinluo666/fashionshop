import state from './state'
import mutations from './mutations'
import getters from './getters'
import actions from './actions'


const storeData ={
    state:state,
    getters:getters,
    mutations:mutations,
    actions:actions
}

export default storeData;