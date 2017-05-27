import React from 'react';
import ResourcesBar from '../containers/Resources-bar';
import Stats from '../containers/Stats';

export default class extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      time: 0,
    };
  }
  componentDidMount() {
    this.setTime();
  }
  setTime() {
    if (this.state.energy > this.state.maxenergy) {
      this.setState({ time: 300 });
      this.tick();
    }
  }
  tick() {
    const time = 1000;
    const iteration = 1;
    const delay = time * iteration;
    if (this.state.time >= 0) {
      setTimeout(() => {
        this.setState({ time: this.state.time - iteration });
        this.tick();
      }, delay);
    }
  }
  render() {
    return (
      <div>
        <ResourcesBar />
        <Stats />
      </div>
    );
  }
}
