import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import logger from 'redux-logger';
import { createStore, applyMiddleware } from 'redux';
import createSagaMiddleware from 'redux-saga';
import App from './components/App';
import reducer from './reducers/index';
import mySaga from './sagas';

const middleware = process.env.DEVELOPMENT ? logger : undefined;
const sagaMiddleware = createSagaMiddleware();
const store = createStore(
  reducer,
  applyMiddleware(sagaMiddleware, middleware),
);
sagaMiddleware.run(mySaga);

window.addEventListener('load', () => {
  ReactDOM.render(<Provider store={store}><App /></Provider>, document.getElementById('new-player'));
});
