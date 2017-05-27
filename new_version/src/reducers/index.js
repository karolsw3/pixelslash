import { combineReducers } from 'redux';
import resources from './resources';
import stats from './stats';

export default combineReducers({
  resources,
  stats,
});
