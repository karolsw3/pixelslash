import React from 'react';
import PropTypes from 'prop-types';
import styles from './Progress-bar.scss';

const Progressbar = ({ progress, type, children }) => {
  if (progress < 0 || progress > 100) {
    throw Error(`Invalid progress value(${progress}) it should be from 0 to 100!`);
  }
  return (
    <div className={styles.Progressbar}>
      {children}
      <div className={styles.bar}>
        <div
          className={`${styles.fill} ${styles[`fill_${type}`]}`}
          style={{ width: `${progress}%` }}
        />
      </div>
    </div>
  );
};


Progressbar.propTypes = {
  type: PropTypes.string.isRequired,
  children: PropTypes.node.isRequired,
  progress: PropTypes.number.isRequired,
};

export default Progressbar;
