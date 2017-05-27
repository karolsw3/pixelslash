import { connect } from 'react-redux';
import Stats from '../components/Stats';

const mapStateToProps = state => ({ ...state.stats });
const mapDispatchToProps = dispatch => ({ onMount: () => {
  dispatch({
    type: 'FETCH_ASYNC_STATS',
  });
} });
export default connect(mapStateToProps, mapDispatchToProps)(Stats);
