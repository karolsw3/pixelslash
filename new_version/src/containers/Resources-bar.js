import React from 'react';
import { connect } from 'react-redux';
import ResourcesBar from '../components/Resources-bar';

const ResourceBarContainer = state => (<ResourcesBar resources={state.data} />);
const mapStateToProps = state => ({ data: [...state.resources.data] });

export default connect(mapStateToProps)(ResourceBarContainer);
