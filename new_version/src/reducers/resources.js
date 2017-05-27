export default function data(state = { data: [] }, action) {
  switch (action.type) {
    case 'UPDATE_RESOURCES':
      return { ...state, data: [...action.payload] };
    default:
      return state;
  }
}
