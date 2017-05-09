import React from 'react';
import PropTypes from 'prop-types';

const App = props => (
  <div>
    <main>
      <div>
        {props.children}
      </div>
    </main>
  </div>
);

App.propTypes = {
  children: PropTypes.node.isRequired,
};

export default App;
