import axios from 'axios'

export const GET_PORTO = ({ commit }) => {
  axios.get('porto_embarque/carregar')
    .then(response => {
      console.log(response)
      commit('SET_PORTO', response.data)
    })
}
export const ADD_PORTO = ({ commit }, payload) => {
  console.log(payload)
  axios.post('porto_embarque/create', payload)
    .then(response => {
      commit('ADD_PORTO', response.data)
    })
}
export const EDIT_ALIQUOT = ({ commit }, payload) => {
  axios.post('aliquot/update', payload)
    .then(response => {
      commit('EDIT_ALIQUOT', response.data)
    })
}
export const DELETE_ALIQUOT = ({ commit }, payload) => {
  axios.delete('aliquot/delete', { data: { id: payload } })
    .then(response => {
      commit('DELETE_ALIQUOT', response.data)
    })
}
