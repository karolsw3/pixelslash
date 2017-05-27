import React from 'react';
import PropTypes from 'prop-types';
import Resources from './Resources';
import styles from './Resources-bar.scss';

const ResourcesBar = ({ resources }) => {
  if (!(resources && resources.length)) {
    return (<div>No resources</div>);
  }
  return (
    <div className={styles.ResourcesBar}>
      {resources.map((item, key) => (
        <Resources
          key={key}
          alt={item.alt}
          src={item.src}
          value={item.value}
          size={item.size}
        />
      ))}
    </div>
  );
};

ResourcesBar.propTypes = {
  resources: PropTypes.arrayOf(PropTypes.object).isRequired,
};

export default ResourcesBar;
