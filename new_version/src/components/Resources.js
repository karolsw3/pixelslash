import React from 'react';
import PropTypes from 'prop-types';
import styles from './Resources.scss';

const Resource = ({ value, alt, src, size }) => (
  <div className={styles.Resources}>
    <div>{value}</div>
    <img alt={alt} src={src} className={`${styles.icon} ${styles[`icon_${size}`]}`} />
  </div>
);

Resource.defaultProps = {
  size: 'normal',
  alt: '',
  value: 0,
};
Resource.propTypes = {
  value: PropTypes.number,
  alt: PropTypes.string,
  src: PropTypes.string.isRequired,
  size: PropTypes.string,
};

export default Resource;
