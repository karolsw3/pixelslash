export default function data(state = {
  lvl: 0,
  exp: 0,
  maxexp: 0,
  energy: 0,
  maxenergy: 0,
  atk: 0,
  def: 0,
  hp: 0,
  golden_coins: 0,
  silver_coins: 0,
}, action) {
  switch (action.type) {
    case 'FETCH_STATS':
      return { ...state, ...action.payload };
    default:
      return state;
  }
}
