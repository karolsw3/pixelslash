import { put, all, call, takeEvery } from 'redux-saga/effects';
import { fetchStats } from './services';

export function* fetchStatsSaga() {
  const payload = yield call(fetchStats);
  yield put({
    type: 'FETCH_STATS',
    payload,
  });
}

function* fetchStatsWatch() {
  yield takeEvery('FETCH_ASYNC_STATS', fetchStatsSaga);
}

export default function* rootSaga() {
  yield all([
    fetchStatsWatch(),
  ]);
}
