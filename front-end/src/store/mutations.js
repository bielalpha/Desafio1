export const SET_PORTO = (state, porto) => {
  state.portosE = porto
}

export const ADD_PORTO = (state, newPorto) => {
  state.portosE = newPorto
}

export const EDIT_ALIQUOT = (state, editAliquot) => {
  state.aliquots.forEach(a => {
    if (a.id === editAliquot.id) {
      a = editAliquot
    }
  })
}

export const DELETE_ALIQUOT = (state, id) => {
  state.aliquots.splice(state.aliquots.indexOf(id), 1)
}
